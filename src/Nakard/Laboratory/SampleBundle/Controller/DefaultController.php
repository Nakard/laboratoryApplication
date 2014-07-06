<?php

namespace Nakard\Laboratory\SampleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('NakardLaboratorySampleBundle:Default:index.html.twig', array('name' => $name));
    }
}
