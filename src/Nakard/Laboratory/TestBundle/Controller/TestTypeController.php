<?php
/**
 * TestTypeControlle.php
 *
 * Creation date: 2014-07-06
 * Creation time: 18:36
 *
 * @author Arkadiusz Moskwa <a.moskwa@gmail.com>
 */

namespace Nakard\Laboratory\TestBundle\Controller;

use Nakard\Laboratory\TestBundle\Entity\Tests\TestType;
use Nakard\Laboratory\TestBundle\Form\Type\TestTypeDefineType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class TestTypeController
 *
 * @package Nakard\Laboratory\TestBundle\Controller
 */
class TestTypeController extends Controller
{
    /**
     * List all types
     *
     * @param $page
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($page)
    {
        $repository = $this->getDoctrine()->getRepository('Nakard\Laboratory\TestBundle\Entity\Tests\TestType');

        $testTypes = $repository->findAll();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($testTypes, $page, 10);

        return $this->render('NakardLaboratoryTestBundle:TestType:index.html.twig', ['pagination' =>  $pagination]);
    }

    /**
     * Defines a new test type
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function defineAction(Request $request)
    {
        $type = new TestType();

        $form = $this->createForm(new TestTypeDefineType(), $type);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $flash = $this->get('braincrafted_bootstrap.flash');
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($type);
            $manager->flush();
            $flash->success('Type successfully created');
            return $this->redirect($this->generateUrl('nakard_laboratory_test_type_browse'));
        }

        return $this->render(
            'NakardLaboratoryTestBundle:TestType:define.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * Edits a test type
     *
     * @param Request $request
     * @param int     $typeId
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, $typeId)
    {
        $repository = $this->getDoctrine()->getRepository('Nakard\Laboratory\TestBundle\Entity\Tests\TestType');
        $type = $repository->find($typeId);

        $form = $this->createForm(new TestTypeDefineType(), $type);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $flash = $this->get('braincrafted_bootstrap.flash');
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($type);
            $manager->flush();
            $flash->success('Type successfully edited');
            return $this->redirect($this->generateUrl('nakard_laboratory_test_type_browse'));
        }

        return $this->render(
            'NakardLaboratoryTestBundle:TestType:define.html.twig',
            ['form' => $form->createView()]
        );
    }
}
