<?php

namespace Nakard\Laboratory\TestBundle\Entity\Tests;

use Doctrine\ORM\EntityRepository;
use Nakard\Laboratory\SampleBundle\Entity\Samples\SampleType;
use Nakard\Laboratory\UserBundle\Entity\Users\LaboratoryAssistant;
use Nakard\Laboratory\UserBundle\Entity\Users\Patient;

/**
 * Class TestRepository
 * @package Nakard\Laboratory\TestBundle\Entity\Tests
 */
class TestRepository extends EntityRepository
{
    /**
     * Finds tests without assigned sample of specific type
     *
     * @param Patient    $patient
     * @param SampleType $sampleType
     *
     * @return mixed
     */
    public function findWithoutSamplesForSpecificPatientAndSampleType(Patient $patient, SampleType $sampleType)
    {
        $query = $this->getEntityManager()->createQueryBuilder();
        $query
            ->select('t')
            ->from('Nakard\Laboratory\TestBundle\Entity\Tests\Test', 't')
            ->leftJoin('Nakard\Laboratory\TestBundle\Entity\Tests\TestType', 'tt', 'WITH', 't.testType = tt')
            ->where('t.sample IS NULL')
            ->andWhere('t.patient = :patient')
            ->andWhere('tt.sampleType = :sampleType')
            ->setParameter('sampleType', $sampleType)
            ->setParameter('patient', $patient)
        ;

        return $query->getQuery()->execute();
    }

    /**
     * Finds yet unconducted tests
     *
     * @param LaboratoryAssistant $assistant
     *
     * @return mixed
     */
    public function findUnconducted(LaboratoryAssistant $assistant = null)
    {
        $query = $this->getEntityManager()->createQueryBuilder();
        $query
            ->select('t')
            ->from('NakardLaboratoryTestBundle:Tests\Test', 't')
            ->where('t.conductDate IS NULL');
        if (!is_null($assistant)) {
            $query
                ->andWhere('t.labAssistant = :assistant')
                ->setParameter('assistant', $assistant);
        }

        return $query->getQuery()->execute();
    }

    /**
     * Finds all tests for TestController index action
     *
     * @return mixed
     */
    public function findAllForIndexAction()
    {
        $query = $this->getEntityManager()->createQueryBuilder();
        $query
            ->select('t', 'p', 's', 'c', 'tt')
            ->from('NakardLaboratoryTestBundle:Tests\Test', 't')
            ->leftJoin('t.patient', 'p')
            ->leftJoin('t.scheduler', 's')
            ->leftJoin('t.labAssistant', 'c')
            ->leftJoin('t.testType', 'tt')
        ;

        return $query->getQuery()->execute();
    }
}
