<?php
/**
 * TestPacketAssignType.php
 *
 * Creation date: 2014-07-06
 * Creation time: 20:41
 *
 * @author Arkadiusz Moskwa <a.moskwa@gmail.com>
 */

namespace Nakard\Laboratory\TestBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class TestPacketAssignType
 *
 * @package Nakard\Laboratory\TestBundle\Form\Type
 */
class TestPacketAssignType extends AbstractType
{
    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('testTypes', 'entity', [
                'class'     =>  'NakardLaboratoryTestBundle:Tests\TestType',
                'property'  =>  'name',
                'multiple'  =>  true,
                'expanded'  =>  true
            ])
            ->add('save', 'submit');
        ;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'nakard_laboratory_testBundle_packet_assign';
    }
}
