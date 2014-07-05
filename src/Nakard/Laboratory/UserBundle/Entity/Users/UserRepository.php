<?php

namespace Nakard\Laboratory\UserBundle\Entity\Users;

use Doctrine\ORM\EntityRepository;

/**
 * Class UserRepository
 * @package Nakard\Laboratory\UserBundle\Entity\Users
 */
class UserRepository extends EntityRepository
{
    /**
     * Checks if passed login and email combination are unique among all users, used for UniqueEntity Constraint
     *
     * @param   array $parameters
     * @return  mixed
     */
    public function checkUniqueLoginMailCombination(array $parameters)
    {
        $login = $parameters['login'];
        $email = $parameters['email'];

        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb
            ->select('u')
            ->from('Nakard\Laboratory\UserBundle\Entity\Users\User', 'u')
            ->where('u.login = :login')
            ->andWhere('u.email = :email')
            ->setMaxResults(1)
            ->setParameter('login', $login, \PDO::PARAM_STR)
            ->setParameter('email', $email, \PDO::PARAM_STR)
        ;

        return $qb->getQuery()->execute();
    }

    /**
     * Checks if passed PESEL is unique among all users, used for UniqueEntity Constraint
     *
     * @param   array $parameters
     * @return  mixed
     */
    public function checkUniquePesel(array $parameters)
    {
        $pesel = $parameters['pesel'];

        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb
            ->select('u')
            ->from('Nakard\Laboratory\UserBundle\Entity\Users\User', 'u')
            ->where('u.pesel = :pesel')
            ->setMaxResults(1)
            ->setParameter('pesel', $pesel, \PDO::PARAM_STR)
        ;

        return $qb->getQuery()->execute();
    }
}