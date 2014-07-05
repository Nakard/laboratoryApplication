<?php
/**
 * RegistrationController.php
 *
 * Creation date: 2014-07-05
 * Creation time: 10:49
 *
 * @author Arkadiusz Moskwa <a.moskwa@gmail.com>
 */

namespace Nakard\Laboratory\UserBundle\Controller;

use Nakard\Laboratory\UserBundle\Entity\Users\User;
use Nakard\Laboratory\UserBundle\Form\Users\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class RegistrationController
 * @package Nakard\Laboratory\UserBundle\Controller
 */
class RegistrationController extends BaseController
{
    public function registerAction()
    {
        $form = $this->container->get('fos_user.registration.form');
        $formHandler = $this->container->get('fos_user.registration.form.handler');
        $confirmationEnabled = $this->container->getParameter('fos_user.registration.confirmation.enabled');

        $process = $formHandler->process($confirmationEnabled);
        if ($process) {
            $user = $form->getData();

            $this->container->get('logger')->info(
                sprintf('New user registration: %s', $user)
            );

            if ($confirmationEnabled) {
                $this->container->get('session')->set('fos_user_send_confirmation_email/email', $user->getEmail());
                $route = 'fos_user_registration_check_email';
            } else {
                $this->authenticateUser($user);
                $route = 'fos_user_registration_confirmed';
            }

            $this->setFlash('fos_user_success', 'registration.flash.user_created');
            $url = $this->container->get('router')->generate($route);

            return new RedirectResponse($url);
        }

        return $this->container->get('templating')->renderResponse('FOSUserBundle:Registration:register.html.'.$this->getEngine(), array(
            'form' => $form->createView(),
        ));
    }

    public function indexAction()
    {
        $users = $this->getDoctrine()->getRepository('Nakard\Laboratory\UserBundle\Entity\Users\User')->findAll();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($users, $this->get('request')->query->get('page', 1), 10);

        return $this->render('NakardLaboratoryUserBundle:User:index.html.twig', array (
            'pagination' =>  $pagination
        ));
    }

    public function addAction(Request $request)
    {
        $userManagement = $this->get('nakard_laboratory_application.user_management');
        $form = $this->createForm(new UserType());
        $type = $request->request->get('nakard_laboratory_UserBundle_users_user')['type'];
        $user = $userManagement->createProperUser($type);
        $form->setData($user);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $flash = $this->get('braincrafted_bootstrap.flash');

            $user->setRegisterDate(new \DateTime());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $flash->success('User ' . $user->getCredentials(). ' succesfully registered');

            return $this->redirect($this->generateUrl('nakard_laboratory_application_users_index'));
        }

        return $this->render('NakardLaboratoryUserBundle:User:add.html.twig', array(
            'form'  =>  $form->createView()
        ));
    }

} 