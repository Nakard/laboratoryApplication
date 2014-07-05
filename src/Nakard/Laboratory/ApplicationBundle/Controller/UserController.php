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
use Symfony\Component\HttpFoundation\Request;

/**
 * Class UserController
 * @package Nakard\Laboratory\ApplicationBundle\Controller
 */
class UserController extends Controller
{

    public function indexAction()
    {
        $users = $this->getDoctrine()->getRepository('Nakard\Laboratory\ApplicationBundle\Entity\Users\User')->findAll();

        return $this->render('NakardLaboratoryApplicationBundle:User:index.html.twig', array (
            'users' =>  $users
        ));
    }

    public function addAction(Request $request)
    {
        $userManagement = $this->get('nakard_laboratory_application.user_management');
        $form = $this->createForm(new UserType());
        $type = $request->request->get('nakard_laboratory_applicationbundle_users_user')['type'];
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

        return $this->render('NakardLaboratoryApplicationBundle:User:add.html.twig', array(
            'form'  =>  $form->createView()
        ));
    }

} 