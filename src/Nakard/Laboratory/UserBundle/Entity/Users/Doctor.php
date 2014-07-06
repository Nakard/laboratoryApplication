<?php
/**
 * Doctor.php
 *
 * Creation date: 2014-07-01
 * Creation time: 21:42
 *
 * @author Arkadiusz Moskwa <a.moskwa@gmail.com>
 */

namespace Nakard\Laboratory\UserBundle\Entity\Users;

use Doctrine\Common\Collections\ArrayCollection;
use Nakard\Laboratory\TestBundle\Entity\Tests\Test;

/**
 * Class Doctor
 * @package Nakard\Laboratory\UserBundle\Entity\Users
 */
class Doctor extends User
{
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $scheduledTests;

    /**
     * Constructs a Doctor
     */
    public function __construct()
    {
        $this->scheduledTests = new ArrayCollection();
        parent::__construct();
    }

    /**
     * @return ArrayCollection
     */
    public function getScheduledTests()
    {
        return $this->scheduledTests;
    }

    /**
     * @param   Test    $test
     * @return  Doctor
     */
    public function scheduleTest(Test $test)
    {
        $this->scheduledTests[] = $test;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getTypeName()
    {
        return 'Doctor';
    }
}
