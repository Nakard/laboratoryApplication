<?php

namespace Nakard\Laboratory\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class DefaultController
 * @package Nakard\Laboratory\UserBundle\Controller
 */
class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('NakardLaboratoryUserBundle:Default:index.html.twig', array('name' => $name));
    }
}
