<?php
/**
 * SampleTypeController.php
 *
 * Creation date: 2014-07-08
 * Creation time: 19:33
 *
 * @author Arkadiusz Moskwa <a.moskwa@gmail.com>
 */

namespace Nakard\Laboratory\SampleBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Nakard\Laboratory\SampleBundle\Entity\Samples\SampleType;
use Nakard\Laboratory\SampleBundle\Form\Type\SampleTypeDefineType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Nakard\Laboratory\TestBundle\Entity\Tests\TestType;

/**
 * Class SampleTypeController
 *
 * @package Nakard\Laboratory\SampleBundle\Controller
 */
class SampleTypeController extends Controller
{
    /**
     * Lists all defined sample types
     *
     * @param $page
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($page)
    {
        $repository = $this->getDoctrine()->getRepository('Nakard\Laboratory\SampleBundle\Entity\Samples\SampleType');

        $tests = $repository->findAll();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($tests, $page, 10);

        return $this->render(
            'NakardLaboratorySampleBundle:SampleType:index.html.twig',
            ['pagination' =>  $pagination]
        );
    }

    /**
     * Define new sample type
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function defineAction(Request $request)
    {
        $sampleType = new SampleType();
        $flash = $this->get('braincrafted_bootstrap.flash');
        $form = $this->createForm(new SampleTypeDefineType(), $sampleType);

        if ($form->get('testTypes')->isEmpty()) {
            $flash->alert('There are no available test types to define a new sample type');
            return $this->redirect($this->generateUrl('nakard_laboratory_sample_type_browse'));
        }

        $form->handleRequest($request);

        if ($form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($sampleType);
            /** @var TestType $testType */
            foreach ($sampleType->getTestTypes() as $testType) {
                $testType->setSampleType($sampleType);
                $manager->persist($testType);
            }
            $manager->flush();
            $flash->success('Sample type successfully defined');
            return $this->redirect($this->generateUrl('nakard_laboratory_sample_type_browse'));
        }

        return $this->render(
            'NakardLaboratorySampleBundle:SampleType:define.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * Edits sample type
     *
     * @param Request $request
     * @param int     $sampleTypeId
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, $sampleTypeId)
    {
        $repository = $this->getDoctrine()->getRepository('NakardLaboratorySampleBundle:Samples\SampleType');
        $manager = $this->getDoctrine()->getManager();
        /** @var SampleType $sampleType */
        $sampleType = $repository->find($sampleTypeId);
        $form = $this->createForm(new SampleTypeDefineType($sampleType), $sampleType);
        /** @var TestType $testType */
        //making test types available for eventual removal
        foreach ($sampleType->getTestTypes() as $testType) {
            $sampleType->removeTestType($testType);
            $testType->removeSampleType();
        }
        $form->handleRequest($request);

        if ($form->isValid()) {
            $manager->persist($sampleType);
            foreach ($sampleType->getTestTypes() as $testType) {
                $testType->setSampleType($sampleType);
                $manager->persist($testType);
            }
            $manager->flush();
            $flash = $this->get('braincrafted_bootstrap.flash');
            $flash->success('Sample type successfully edited');
            return $this->redirect($this->generateUrl('nakard_laboratory_sample_type_browse'));
        }

        return $this->render(
            'NakardLaboratorySampleBundle:SampleType:define.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * Removes selected sample type
     *
     * @param $sampleTypeId
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeAction($sampleTypeId)
    {
        $repository = $this->getDoctrine()->getRepository('NakardLaboratorySampleBundle:Samples\SampleType');
        $sampleType = $repository->find($sampleTypeId);
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($sampleType);
        $manager->flush();
        $flash = $this->get('braincrafted_bootstrap.flash');
        $flash->success('Successfully removed ' . $sampleType->getName() . ' sample type');
        return $this->redirect($this->generateUrl('nakard_laboratory_sample_type_browse'));
    }
}
