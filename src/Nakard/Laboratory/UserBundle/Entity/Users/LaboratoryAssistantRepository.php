<?php
/**
 * LaboratoryAssistantRepository.php
 *
 * Creation date: 2014-07-01
 * Creation time: 21:43
 *
 * @author Arkadiusz Moskwa <a.moskwa@gmail.com>
 */

namespace Nakard\Laboratory\UserBundle\Entity\Users;

/**
 * Class LaboratoryAssistantRepository
 * @package Nakard\Laboratory\UserBundle\Entity\Users
 */
class LaboratoryAssistantRepository extends UserRepository
{
    /**
     * Finds assistant that has least tests assigned
     *
     * @return mixed
     */
    public function findAssistantWithLeastTestAssigned()
    {
        $query = $this->getEntityManager()->createQueryBuilder();
        $query
            ->select('a as assistant', 'count(a) as c')
            ->from('NakardLaboratoryUserBundle:Users\LaboratoryAssistant', 'a')
            ->leftJoin('a.assignedTests', 't')
            ->orderBy('c', 'asc')
            ->groupBy('a.id')
            ->setMaxResults(1)
        ;

        return $query->getQuery()->getResult()[0]['assistant'];
    }
}
