<?php
/**
 * TestPerformType.php
 *
 * Creation date: 2014-07-10
 * Creation time: 18:24
 *
 * @author Arkadiusz Moskwa <a.moskwa@gmail.com>
 */

namespace Nakard\Laboratory\TestBundle\Form\Type;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class TestPerformType
 *
 * @package Nakard\Laboratory\TestBundle\Form\Type
 */
class TestPerformType extends AbstractType
{
    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('assignedTests', 'collection', ['type' => new TestType()])
            ->add('save', 'submit')
        ;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'nakard_laboratory_testBundle_test_perform';
    }
}
