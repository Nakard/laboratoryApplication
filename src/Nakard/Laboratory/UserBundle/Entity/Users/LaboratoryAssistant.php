<?php
/**
 * LaboratoryAssistant.php
 *
 * Creation date: 2014-07-01
 * Creation time: 21:43
 *
 * @author Arkadiusz Moskwa <a.moskwa@gmail.com>
 */

namespace Nakard\Laboratory\UserBundle\Entity\Users;

use Doctrine\Common\Collections\ArrayCollection;
use Nakard\Laboratory\TestBundle\Entity\Tests\Test;

/**
 * Class LaboratoryAssistant
 * @package Nakard\Laboratory\UserBundle\Entity\Users
 */
class LaboratoryAssistant extends User
{
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $assignedTests;

    /**
     * Constructs Laboratory Assistant
     */
    public function __construct()
    {
        $this->assignedTests = new ArrayCollection();
        parent::__construct();
    }

    /**
     * @return ArrayCollection
     */
    public function getAssignedTests()
    {
        return $this->assignedTests;
    }

    /**
     * @param   Test                $test
     * @return  LaboratoryAssistant
     */
    public function addAssignedTest(Test $test)
    {
        $this->assignedTests[] = $test;

        return $this;
    }

    /**
     * Sets a collection of tests as assigned
     *
     * @param ArrayCollection $tests
     */
    public function setAssignedTests(ArrayCollection $tests)
    {
        $this->assignedTests = $tests;
    }

    /**
     * @inheritdoc
     */
    public function getTypeName()
    {
        return 'Laboratory Assistant';
    }
}
