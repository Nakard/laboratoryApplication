<?php
/**
 * TestPacketController.php
 *
 * Creation date: 2014-07-06
 * Creation time: 19:00
 *
 * @author Arkadiusz Moskwa <a.moskwa@gmail.com>
 */

namespace Nakard\Laboratory\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class TestPacketController
 *
 * @package Nakard\Laboratory\TestBundle\Controller
 */
class TestPacketController extends Controller
{
    public function indexAction($page)
    {
        $repository = $this->getDoctrine()->getRepository('Nakard\Laboratory\TestBundle\Entity\Tests\TestPacket');

        $packets = $repository->findAll();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($packets, $page, 10);

        return $this->render('NakardLaboratoryTestBundle:TestPacket:index.html.twig', ['pagination' =>  $pagination]);
    }
}