<?php
/**
 * Doctor.php
 *
 * Creation date: 2014-07-01
 * Creation time: 21:42
 *
 * @author Arkadiusz Moskwa <a.moskwa@gmail.com>
 */

namespace Nakard\Laboratory\ApplicationBundle\Entity\Users;

use Doctrine\Common\Collections\ArrayCollection;
use Nakard\Laboratory\ApplicationBundle\Entity\Tests\Test;

/**
 * Class Doctor
 * @package Nakard\Laboratory\ApplicationBundle\Entity\Users
 */
class Doctor extends User{

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $scheduledTests;

    public function __construct()
    {
        $this->scheduledTests = new ArrayCollection();
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

} 