<?php
/**
 * RegistrationFormType.php
 *
 * Creation date: 2014-07-05
 * Creation time: 20:54
 *
 * @author Arkadiusz Moskwa <a.moskwa@gmail.com>
 */

namespace Nakard\Laboratory\UserBundle\Form\Type;

use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class RegistrationFormType
 * @package Nakard\Laboratory\UserBundle\Form\Type
 */
class RegistrationFormType extends BaseType
{
    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pesel', 'text', ['label' => 'PESEL', 'translation_domain' => 'FOSUserBundle'])
            ->add('firstName', 'text', ['label' => 'First Name', 'translation_domain' => 'FOSUserBundle'])
            ->add('lastName', 'text', ['label' => 'Last Name', 'translation_domain' => 'FOSUserBundle'])
            ->add('username', null, ['label' => 'Username', 'translation_domain' => 'FOSUserBundle'])
            ->add('email', 'email', ['label' => 'Email', 'translation_domain' => 'FOSUserBundle'])
            ->add('plainPassword', 'repeated', [
                'type' => 'password',
                'options' => ['translation_domain' => 'FOSUserBundle'],
                'first_options' => ['label' => 'Password'],
                'second_options' => ['label' => 'Re-type password'],
                'invalid_message' => 'Passwords don\'t match',
            ])
            ->add('save', 'submit')
        ;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'nakard_laboratory_user_registration';
    }
}
