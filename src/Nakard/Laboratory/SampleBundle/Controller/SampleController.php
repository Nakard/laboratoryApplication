<?php
/**
 * SampleController.php
 *
 * Creation date: 2014-07-10
 * Creation time: 10:59
 *
 * @author Arkadiusz Moskwa <a.moskwa@gmail.com>
 */

namespace Nakard\Laboratory\SampleBundle\Controller;

use Nakard\Laboratory\SampleBundle\Form\Type\SampleAdmitType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class SampleController
 *
 * @package Nakard\Laboratory\SampleBundle\Controller
 */
class SampleController extends Controller
{
    /**
     * List all samples
     *
     * @param int $page
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($page)
    {
        $repository = $this->getDoctrine()->getRepository('Nakard\Laboratory\SampleBundle\Entity\Samples\Sample');

        $tests = $repository->findAll();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($tests, $page, 10);

        return $this->render(
            'NakardLaboratorySampleBundle:Sample:index.html.twig',
            ['pagination' =>  $pagination]
        );
    }

    /**
     * Admits a sample
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function admitAction(Request $request)
    {
        $form = $this->createForm(new SampleAdmitType());

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $service = $this->get('nakard_laboratory_sample.admition_service');
            $data = $form->getData();
            $patient = $data['patient'];
            $sampleType = $data['sampleType'];
            $service->admitSample($patient, $sampleType);
            return $this->redirect($this->generateUrl('nakard_laboratory_sample_browse'));
        }

        return $this->render(
            'NakardLaboratorySampleBundle:Sample:admit.html.twig',
            ['form' => $form->createView()]
        );
    }
}
