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
            ])
            ->add('save', 'submit')
        ;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'nakard_laboratory_testBundle_packet_schedule';
    }
}
