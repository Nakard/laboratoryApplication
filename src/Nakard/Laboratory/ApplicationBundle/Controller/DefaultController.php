<?php

namespace Nakard\Laboratory\ApplicationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('NakardLaboratoryApplicationBundle:Default:index.html.twig', array('name' => $name));
    }
}