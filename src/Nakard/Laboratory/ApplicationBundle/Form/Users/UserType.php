<?php

namespace Nakard\Laboratory\ApplicationBundle\Form\Users;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text')
            ->add('surname', 'text')
            ->add('login', 'text')
            ->add('password', 'repeated', array(
                'type'              =>  'password',
                'invalid_message'   =>  'The password fields must match.',
                'options'           =>  array('attr' => array('class' => 'password-field')),
                'required'          =>  true,
                'first_options'     =>  array('label' => 'Password'),
                'second_options'    =>  array('label' => 'Re-type password')
            ))
            ->add('email', 'email')
            ->add('pesel', 'number')
            ->add('type', 'choice', array(
                'choices'   =>  array(
                    'doctor'    =>  'Doctor',
                    'assistant' =>  'Laboratory Assistant',
                    'patient'   =>  'Patient',
                    'admin'     =>  'System Administrator'
                )
            ))
            ->add('save', 'submit')
            ->setMethod('POST')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Nakard\Laboratory\ApplicationBundle\Entity\Users\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'nakard_laboratory_applicationbundle_users_user';
    }
}
