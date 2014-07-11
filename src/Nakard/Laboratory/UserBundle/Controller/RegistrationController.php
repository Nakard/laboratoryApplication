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

use Nakard\Laboratory\UserBundle\Form\Type\UserTypeChooseFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Class RegistrationController
 * @package Nakard\Laboratory\UserBundle\Controller
 */
class RegistrationController extends Controller
{
    /**
     * Adds a user of selected type, only for admins
     *
     * @param Request   $request
     * @param string    $type
     *
     * @return null|\Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response|void
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function addAction(Request $request, $type)
    {
        if (empty($type)) {
            $form = $this->createForm(new UserTypeChooseFormType());
            return $this->render(
                'NakardLaboratoryUserBundle:Registration:type_choose.html.twig',
                ['form' => $form->createView()]
            );
        }
        $formFactory = $this->get('fos_user.registration.form.factory');
        $userResolver = $this->get('nakard_laboratory_application.user_resolver');
        $userManager = $this->get('fos_user.user_manager');
        $dispatcher = $this->get('event_dispatcher');

        $user = $userResolver->createProperUser($type);
        $user->setEnabled(true);

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $form = $formFactory->createForm();
        $form->setData($user);

        if ('POST' === $request->getMethod()) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $event = new FormEvent($form, $request);
                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);
                $user->addRespectiveRoles($type);
                $userManager->updateUser($user);

                if (null === $response = $event->getResponse()) {
                    $url = $this->get('router')->generate('fos_user_registration_confirmed');
                    $response = new RedirectResponse($url);
                }

/*                $dispatcher->dispatch(
                    FOSUserEvents::REGISTRATION_COMPLETED,
                    new FilterUserResponseEvent($user, $request, $response)
                );*/

                return $response;
            }
        }
        return $this->render(
            'NakardLaboratoryUserBundle:Registration:register.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * Notifies user that the account has been confirmed
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     */
    public function confirmedAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        return $this->render('NakardLaboratoryUserBundle:Registration:confirmed.html.twig', ['user' => $user]);
    }
}
