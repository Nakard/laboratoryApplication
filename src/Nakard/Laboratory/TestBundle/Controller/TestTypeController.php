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

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class TestTypeController
 *
 * @package Nakard\Laboratory\TestBundle\Controller
 */
class TestTypeController extends Controller
{
    public function indexAction($page)
    {
        $repository = $this->getDoctrine()->getRepository('Nakard\Laboratory\TestBundle\Entity\Tests\TestType');

        $testTypes = $repository->findAll();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($testTypes, $page, 10);

        return $this->render('NakardLaboratoryTestBundle:TestType:index.html.twig', ['pagination' =>  $pagination]);
    }
}
