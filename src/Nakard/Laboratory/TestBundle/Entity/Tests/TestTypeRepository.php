<?php
/**
 * TestTypeRepository.php
 *
 * Creation date: 2014-07-06
 * Creation time: 17:37
 *
 * @author Arkadiusz Moskwa <a.moskwa@gmail.com>
 */

namespace Nakard\Laboratory\TestBundle\Entity\Tests;

use Doctrine\ORM\EntityRepository;
use Nakard\Laboratory\SampleBundle\Entity\Samples\SampleType;

/**
 * Class TestTypeRepository
 *
 * @package Nakard\Laboratory\TestBundle\Entity\Tests
 */
class TestTypeRepository extends EntityRepository
{
    /**
     * Finds types without assigned sample types
     *
     * @param SampleType $sampleType
     *
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function findWithoutDefinedSampleType(SampleType $sampleType = null)
    {
        $query = $this->getEntityManager()->createQueryBuilder();
        $query
            ->select('tt')
            ->from('Nakard\Laboratory\TestBundle\Entity\Tests\TestType', 'tt')
            ->where('tt.sampleType IS NULL');
        if (!is_null($sampleType)) {
            $query
                ->orWhere('tt.sampleType = :sampleType')
                ->setParameter('sampleType', $sampleType);
        }
        return $query;
    }
}
