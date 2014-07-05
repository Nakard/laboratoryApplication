<?php
/**
 * UserController.php
 *
 * Creation date: 2014-07-05
 * Creation time: 10:49
 *
 * @author Arkadiusz Moskwa <a.moskwa@gmail.com>
 */

namespace Nakard\Laboratory\ApplicationBundle\Controller;

use Nakard\Laboratory\ApplicationBundle\Entity\Users\User;
use Nakard\Laboratory\ApplicationBundle\Form\Users\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class UserController
 * @package Nakard\Laboratory\ApplicationBundle\Controller
 */
class UserController extends Controller
{

    public function indexAction($page)
    {
        $users = $this->getDoctrine()->getRepository('Nakard\Laboratory\ApplicationBundle\Entity\Users\User')->findAll();

        return $this->render('NakardLaboratoryApplicationBundle:User:index.html.twig', array (
            'users' =>  $users
        ));
    }

    public function addAction()
    {
        $user = new User();
        $form = $this->createForm(new UserType(), $user);
        return $this->render('NakardLaboratoryApplicationBundle:User:add.html.twig', array(
            'form'  =>  $form->createView()
        ));
    }

} 