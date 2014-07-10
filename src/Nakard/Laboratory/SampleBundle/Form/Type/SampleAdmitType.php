<?php
/**
 * SampleAdmitType.php
 *
 * Creation date: 2014-07-10
 * Creation time: 13:05
 *
 * @author Arkadiusz Moskwa <a.moskwa@gmail.com>
 */

namespace Nakard\Laboratory\SampleBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class SampleAdmitType
 *
 * @package Nakard\Laboratory\SampleBundle\Form\Type
 */
class SampleAdmitType extends AbstractType
{
    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('patient', 'entity', [
                'class'     =>  'Nakard\Laboratory\UserBundle\Entity\Users\Patient',
            ])
            ->add('sampleType', 'entity', [
                'class'     =>  'Nakard\Laboratory\SampleBundle\Entity\Samples\SampleType',
                'property'  =>  'name',
            ])
            ->add('save', 'submit')
        ;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'nakard_laboratory_sampleBundle_admit';
    }
}
