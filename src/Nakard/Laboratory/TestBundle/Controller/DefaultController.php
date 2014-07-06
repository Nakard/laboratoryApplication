<?php

namespace Nakard\Laboratory\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('NakardLaboratoryTestBundle:Default:index.html.twig', array('name' => $name));
    }
}
