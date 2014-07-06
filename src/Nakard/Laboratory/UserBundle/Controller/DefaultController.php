<?php
/**
 * DefaultController.php
 *
 * Creation date: 2014-07-06
 * Creation time: 18:13
 *
 * @author Arkadiusz Moskwa <a.moskwa@gmail.com>
 */

namespace Nakard\Laboratory\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class DefaultController
 *
 * @package Nakard\Laboratory\UserBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('NakardLaboratoryUserBundle:Default:index.html.twig');
    }
}
