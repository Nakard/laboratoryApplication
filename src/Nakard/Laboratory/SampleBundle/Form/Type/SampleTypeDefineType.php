<?php
/**
 * SampleTypeDefineType.php
 *
 * Creation date: 2014-07-08
 * Creation time: 19:46
 *
 * @author Arkadiusz Moskwa <a.moskwa@gmail.com>
 */

namespace Nakard\Laboratory\SampleBundle\Form\Type;

use Nakard\Laboratory\TestBundle\Entity\Tests\TestTypeRepository;
use Nakard\Laboratory\SampleBundle\Entity\Samples\SampleType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class SampleTypeDefineType
 *
 * @package Nakard\Laboratory\SampleBundle\Form\Type
 */
class SampleTypeDefineType extends AbstractType
{
    /**
     * @var SampleType
     */
    protected $sampleType;

    /**
     * @param SampleType $sampleType
     */
    public function __construct(SampleType $sampleType = null)
    {
        $this->sampleType = $sampleType;
    }

    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text')
            ->add('description', 'textarea')
            ->add('testTypes', 'entity', [
                'class'         =>  'NakardLaboratoryTestBundle:Tests\TestType',
                'property'      =>  'name',
                'query_builder' =>  function (TestTypeRepository $er) {
                    return $er->findWithoutDefinedSampleType($this->sampleType);
                },
                'multiple'      =>  true,
                'expanded'      =>  true
            ])
            ->add('save', 'submit')
        ;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'nakard_laboratory_testBundle_sample_type_define';
    }
}
