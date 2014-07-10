<?php
/**
 * SampleAdmitionService.php
 *
 * Creation date: 2014-07-10
 * Creation time: 14:06
 *
 * @author Arkadiusz Moskwa <a.moskwa@gmail.com>
 */

namespace Nakard\Laboratory\SampleBundle\Service;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Nakard\Laboratory\SampleBundle\Entity\Samples\Sample;
use Nakard\Laboratory\SampleBundle\Entity\Samples\SampleType;
use Nakard\Laboratory\UserBundle\Entity\Users\Patient;
use Nakard\Laboratory\TestBundle\Entity\Tests\TestRepository;
use Nakard\Laboratory\TestBundle\Entity\Tests\Test;

/**
 * Class SampleAdmitionService
 *
 * @package Nakard\Laboratory\SampleBundle\Service
 */
class SampleAdmitionService
{
    protected $doctrine;

    /**
     * Sets up connection with doctrine
     *
     * @param Registry $doctrine
     */
    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * Admits a sample for specific patient of specific type
     *
     * @param Patient    $patient
     * @param SampleType $sampleType
     */
    public function admitSample(Patient $patient, SampleType $sampleType)
    {
        $manager = $this->doctrine->getManager();
        $sample = new Sample();
        $sample->setPatient($patient)->setSampleType($sampleType);
        $patient->addSample($sample);
        /** @var TestRepository $repository */
        $repository = $this->doctrine->getRepository('Nakard\Laboratory\TestBundle\Entity\Tests\Test');
        $tests = $repository->findWithoutSamplesForSpecificPatientAndSampleType($patient, $sampleType);
        /** @var Test $test */
        foreach ($tests as $test) {
            $test->setSample($sample);
            $sample->addTest($test);
            $manager->persist($test);
        }
        $manager->persist($sample);
        $manager->persist($patient);
        $manager->flush();
    }
}
