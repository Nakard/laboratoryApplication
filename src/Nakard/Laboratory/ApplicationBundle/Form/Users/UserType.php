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
            ->add('name')
            ->add('surname')
            ->add('login')
            ->add('password')
            ->add('email')
            ->add('pesel')
            ->add('registerDate')
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
