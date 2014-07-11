<?php
/**
 * TestController.php
 *
 * Creation date: 2014-07-06
 * Creation time: 17:15
 *
 * @author Arkadiusz Moskwa <a.moskwa@gmail.com>
 */

namespace Nakard\Laboratory\TestBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Nakard\Laboratory\TestBundle\Entity\Tests\Test;
use Nakard\Laboratory\TestBundle\Form\Type\TestPacketScheduleType;
use Nakard\Laboratory\TestBundle\Form\Type\TestPerformPatientSelectType;
use Nakard\Laboratory\TestBundle\Form\Type\TestPerformType;
use Nakard\Laboratory\UserBundle\Entity\Users\Administrator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Nakard\Laboratory\UserBundle\Entity\Users\Patient;
use Nakard\Laboratory\TestBundle\Entity\Tests\TestPacket;
use Nakard\Laboratory\TestBundle\Entity\Tests\TestType;

/**
 * Class TestController
 *
 * @package Nakard\Laboratory\TestBundle\Controller
 */
class TestController extends Controller
{
    /**
     * Lists all tests
     *
     * @param $page
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($page)
    {
        $repository = $this->getDoctrine()->getRepository('Nakard\Laboratory\TestBundle\Entity\Tests\Test');

        $tests = $repository->findAllForIndexAction();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($tests, $page, 10);

        return $this->render('NakardLaboratoryTestBundle:Test:index.html.twig', ['pagination' =>  $pagination]);
    }

    /**
     * Schedules new test packet for patient
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     * @Security("has_role('ROLE_DOCTOR')")
     */
    public function scheduleAction(Request $request)
    {
        $form = $this->createForm(new TestPacketScheduleType($this->getUser()));

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            /** @var \Nakard\Laboratory\UserBundle\Entity\Users\LaboratoryAssistantRepository $repository */
            $repository = $this->getDoctrine()->getRepository('NakardLaboratoryUserBundle:Users\LaboratoryAssistant');
            $assistant = $repository->findAssistantWithLeastTestAssigned();
            $data = $form->getData();
            /** @var TestPacket $packet */
            $packet = $data['packet'];
            /** @var Patient $patient */
            $patient = $data['patient'];
            $doctor = $this->getDoctorForSchedule($form);
            $testTypes = $packet->getTestTypes();
            /** @var TestType $type */
            $manager = $this->getDoctrine()->getManager();
            foreach ($testTypes as $type) {
                $test = new Test();
                $test->setScheduler($doctor);
                $test->setTestType($type);
                $test->setPatient($patient);
                $test->setLabAssistant($assistant);
                $manager->persist($test);
            }
            $manager->flush();
            $flash = $this->get('braincrafted_bootstrap.flash');
            $flash->success('Packet succesfully scheduled');
            return $this->redirect($this->generateUrl('nakard_laboratory_test_browse'));
        }

        return $this->render(
            'NakardLaboratoryTestBundle:Test:schedule.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * Performs tests assigned to selected assistant
     *
     * @param Request $request
     * @param int     $assistantId
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function performAction(Request $request, $assistantId)
    {
        if (0 === $assistantId) {
            $form = $this->createForm(new TestPerformPatientSelectType());
            return $this->render(
                'NakardLaboratoryTestBundle:Test:assistant_select.html.twig',
                ['form' => $form->createView()]
            );
        }
        $assistant = $this
            ->getDoctrine()
            ->getRepository('Nakard\Laboratory\UserBundle\Entity\Users\LaboratoryAssistant')
            ->find($assistantId);
        $repository = $this->getDoctrine()->getRepository('Nakard\Laboratory\TestBundle\Entity\Tests\Test');
        $toConductTests = new ArrayCollection($repository->findUnconducted($assistant));
        $testsIds = array_map(function (Test $elem) {
            return $elem->getId();
        }, $toConductTests->toArray());
        $assistant->setAssignedTests($toConductTests);
        $form = $this->createForm(
            new TestPerformType(),
            $assistant
        );

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $manager = $this->getDoctrine()->getManager();
            /** @var Test $test */
            foreach ($toConductTests as $test) {
                $test->setConductDate(new \DateTime());
                $manager->persist($test);
            }
            $manager->flush();
            return $this->redirect($this->generateUrl('nakard_laboratory_test_browse'));
        }

        return $this->render(
            'NakardLaboratoryTestBundle:Test:perform.html.twig',
            ['form' => $form->createView(), 'testsIds' => $testsIds]
        );
    }

    /**
     * Gets proper doctor assignment depending on logged user
     *
     * @param Form $form
     *
     * @return mixed
     */
    protected function getDoctorForSchedule(Form $form)
    {
        $user = $this->getUser();
        // only docs and admins can schedule,  so if it isn't an admin it surely is a doc
        if (!$user instanceof Administrator) {
            return $user;
        }

        return $form->get('doctor')->getData();
    }
}
