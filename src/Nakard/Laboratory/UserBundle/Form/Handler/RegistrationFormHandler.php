<?php
/**
 * RegistrationFormHandler.php
 *
 * Creation date: 2014-07-05
 * Creation time: 21:37
 *
 * @author Arkadiusz Moskwa <a.moskwa@gmail.com>
 */

namespace Nakard\Laboratory\UserBundle\Form\Handler;

use FOS\UserBundle\Form\Handler\RegistrationFormHandler as BaseHandler;
use FOS\UserBundle\Model\UserInterface;

/**
 * Class RegistrationFormHandler
 * @package Nakard\Laboratory\UserBundle\Form\Handler
 */
class RegistrationFormHandler extends BaseHandler
{
    /**
     * @param UserInterface $user
     * @param bool $confirmation
     */
    protected function onSuccess(UserInterface $user, $confirmation)
    {
        parent::onSuccess($user, $confirmation);
    }
}
