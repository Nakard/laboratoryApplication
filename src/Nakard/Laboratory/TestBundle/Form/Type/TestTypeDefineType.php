<?php
/**
 * TestTypeDefineType.php
 *
 * Creation date: 2014-07-06
 * Creation time: 19:54
 *
 * @author Arkadiusz Moskwa <a.moskwa@gmail.com>
 */

namespace Nakard\Laboratory\TestBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class TestTypeDefineType
 *
 * @package Nakard\Laboratory\TestBundle\Form\Type
 */
class TestTypeDefineType extends AbstractType
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
        return 'nakard_laboratory_testBundle_test_type_define';
    }
}
