<?php

namespace Nakard\Laboratory\TestBundle\Entity\Tests;

use Doctrine\ORM\EntityRepository;
use Proxies\__CG__\Nakard\Laboratory\SampleBundle\Entity\Samples\SampleType;

/**
 * Class TestRepository
 * @package Nakard\Laboratory\TestBundle\Entity\Tests
 */
class TestRepository extends EntityRepository
{
    /**
     * Finds tests without assigned sample of specific type
     *
     * @param SampleType $sampleType
     *
     * @return mixed
     */
    public function findWithoutSamplesForSpecificSampleType(SampleType $sampleType)
    {
        $query = $this->getEntityManager()->createQueryBuilder();
        $query
            ->select('t')
            ->from('Nakard\Laboratory\TestBundle:Tests\Test', 't')
            ->leftJoin('Nakard\Laboratory\TestBundle:Tests\TestType', 'tt')
            ->where('t.sample IS NULL')
            ->andWhere('tt.sampleType = :sampleType')
            ->setParameter('sampleType', $sampleType)
        ;

        return $query->getQuery()->execute();
    }
}
