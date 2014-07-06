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

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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

    public function scheduleAction()
    {

    }
}
