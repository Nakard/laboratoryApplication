<?php
/**
 * TestPerformPatientSelectType.php
 *
 * Creation date: 2014-07-10
 * Creation time: 15:59
 *
 * @author Arkadiusz Moskwa <a.moskwa@gmail.com>
 */

namespace Nakard\Laboratory\TestBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class TestPerformPatientSelectType
 *
 * @package Nakard\Laboratory\TestBundle\Form\Type
 */
class TestPerformPatientSelectType extends AbstractType
{
    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('assistant', 'entity', [
                'class'         =>  'NakardLaboratoryUserBundle:Users\LaboratoryAssistant',
                'empty_value'   =>  'Choose an assistant'
            ])
            ->add('next step', 'submit');
        ;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'nakard_laboratory_testBundle_perform_assistant_select';
    }
}
