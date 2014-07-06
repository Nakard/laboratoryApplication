<?php
/**
 * TestPacketDefineType.php
 *
 * Creation date: 2014-07-06
 * Creation time: 19:06
 *
 * @author Arkadiusz Moskwa <a.moskwa@gmail.com>
 */

namespace Nakard\Laboratory\TestBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class TestPacketDefineType
 *
 * @package Nakard\Laboratory\TestBundle\Form\Type
 */
class TestPacketDefineType extends AbstractType
{
    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text')
            ->add('description', 'textarea')
            ->add('save', 'submit')
        ;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'nakard_laboratory_TestBundle_test_packet_define';
    }
}
