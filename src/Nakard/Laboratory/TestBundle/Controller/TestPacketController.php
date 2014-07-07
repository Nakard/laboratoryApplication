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

use Nakard\Laboratory\TestBundle\Entity\Tests\TestPacket;
use Nakard\Laboratory\TestBundle\Form\Type\TestPacketAssignType;
use Nakard\Laboratory\TestBundle\Form\Type\TestPacketDefineType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class TestPacketController
 *
 * @package Nakard\Laboratory\TestBundle\Controller
 */
class TestPacketController extends Controller
{
    /**
     * List all packets
     *
     * @param $page
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($page)
    {
        $repository = $this->getDoctrine()->getRepository('Nakard\Laboratory\TestBundle\Entity\Tests\TestPacket');

        $packets = $repository->findAll();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($packets, $page, 10);

        return $this->render('NakardLaboratoryTestBundle:TestPacket:index.html.twig', ['pagination' =>  $pagination]);
    }

    /**
     * Action for defining new test packet
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function defineAction(Request $request)
    {
        $packet = new TestPacket();

        $form = $this->createForm(new TestPacketDefineType(), $packet);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $flash = $this->get('braincrafted_bootstrap.flash');
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($packet);
            $manager->flush();
            $flash->success('Packet successfully created');
            return $this->redirect($this->generateUrl('nakard_laboratory_test_packet_browse'));
        }

        return $this->render(
            'NakardLaboratoryTestBundle:TestPacket:define.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * Assign types for specified test packet
     *
     * @param Request $request
     * @param int     $packetId
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function assignAction(Request $request, $packetId)
    {
        $repository = $this->getDoctrine()->getRepository('Nakard\Laboratory\TestBundle\Entity\Tests\TestPacket');
        $packet = $repository->find($packetId);

        $form = $this->createForm(new TestPacketAssignType(), $packet);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $flash = $this->get('braincrafted_bootstrap.flash');
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($packet);
            $manager->flush();
            $flash->success('Types successfully assigned to packet');
            return $this->redirect($this->generateUrl('nakard_laboratory_test_packet_browse'));
        }

        return $this->render(
            'NakardLaboratoryTestBundle:TestPacket:assign.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * @param Request $request
     * @param int     $packetId
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, $packetId)
    {
        $repository = $this->getDoctrine()->getRepository('Nakard\Laboratory\TestBundle\Entity\Tests\TestPacket');
        $packet = $repository->find($packetId);

        $form = $this->createForm(new TestPacketDefineType, $packet);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $flash = $this->get('braincrafted_bootstrap.flash');
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($packet);
            $manager->flush();
            $flash->success('Packet succesfully edited');
            return $this->redirect($this->generateUrl('nakard_laboratory_test_packet_browse'));
        }

        return $this->render(
            'NakardLaboratoryTestBundle:TestPacket:define.html.twig',
            ['form' => $form->createView()]
        );
    }
}
