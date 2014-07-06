<?php
/**
 * UserController.php
 *
 * Creation date: 2014-07-05
 * Creation time: 21:47
 *
 * @author Arkadiusz Moskwa <a.moskwa@gmail.com>
 */

namespace Nakard\Laboratory\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Nakard\Laboratory\UserBundle\Form\Users\UserType;

/**
 * Class UserController
 * @package Nakard\Laboratory\UserBundle\Controller
 */
class UserController extends Controller
{
    /**
     * Lists all users
     *
     * @param   Request $request
     * @return  Response
     */
    public function indexAction(Request $request)
    {
        $users = $this->getDoctrine()->getRepository('Nakard\Laboratory\UserBundle\Entity\Users\User')->findAll();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($users, $request->query->get('page', 1), 10);

        return $this->render('NakardLaboratoryUserBundle:User:index.html.twig', ['pagination' =>  $pagination]);
    }
}
