<?php
/**
 * UserTypeChooseFormType.php
 *
 * Creation date: 2014-07-06
 * Creation time: 14:23
 *
 * @author Arkadiusz Moskwa <a.moskwa@gmail.com>
 */

namespace Nakard\Laboratory\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class UserTypeChooseFormType
 *
 * @package Nakard\Laboratory\UserBundle\Form\Type
 */
class UserTypeChooseFormType extends AbstractType
{
    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', 'choice', [
                'choices'       =>  [
                    'admin'     =>  'System Administrator',
                    'doctor'    =>  'Doctor',
                    'assistant' =>  'Laboratory Assistant',
                    'patient'   =>  'Patient',
                ],
                'attr'          =>  ['id' => 'select'],
                'empty_value'   =>  'Choose user type',
        ])
            ->add('next step', 'submit')
            ->setMethod('POST')
        ;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'nakard_laboratory_UserBundle_choose_user_type';
    }
}
