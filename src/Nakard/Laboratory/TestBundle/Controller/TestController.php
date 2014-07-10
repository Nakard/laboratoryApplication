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

use Nakard\Laboratory\TestBundle\Entity\Tests\Test;
use Nakard\Laboratory\TestBundle\Form\Type\TestPacketScheduleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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

        $tests = $repository->findAll();

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
     */
    public function scheduleAction(Request $request)
    {
        $form = $this->createForm(new TestPacketScheduleType());

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
            $testTypes = $packet->getTestTypes();
            /** @var TestType $type */
            $manager = $this->getDoctrine()->getManager();
            foreach ($testTypes as $type) {
                $test = new Test();
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
}
