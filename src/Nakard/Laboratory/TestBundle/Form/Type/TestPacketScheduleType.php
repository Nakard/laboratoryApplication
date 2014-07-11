<?php
/**
 * TestPacketScheduleType.php
 *
 * Creation date: 2014-07-07
 * Creation time: 19:56
 *
 * @author Arkadiusz Moskwa <a.moskwa@gmail.com>
 */

namespace Nakard\Laboratory\TestBundle\Form\Type;

use Nakard\Laboratory\UserBundle\Entity\Users\Administrator;
use Nakard\Laboratory\UserBundle\Entity\Users\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class TestPacketScheduleType
 *
 * @package Nakard\Laboratory\TestBundle\Form\Type
 */
class TestPacketScheduleType extends AbstractType
{
    /**
     * Sets the active user
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('packet', 'entity', [
                'class'     =>  'NakardLaboratoryTestBundle:Tests\TestPacket',
                'property'  =>  'name'
            ])
            ->add('patient', 'entity', [
                'class'     =>  'NakardLaboratoryUserBundle:Users\Patient',
            ]);
        if ($this->user instanceof Administrator) {
            $builder->add('doctor', 'entity', [
                'class'     =>  'NakardLaboratoryUserBundle:Users\Doctor',
            ]);
        }
        $builder->add('save', 'submit');
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'nakard_laboratory_testBundle_packet_schedule';
    }
}
