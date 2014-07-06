<?php

namespace Nakard\Laboratory\SampleBundle\Entity\Tests;

use Doctrine\Common\Collections\ArrayCollection;
use Nakard\Laboratory\UserBundle\Entity\Users\Patient;

/**
 * Class Sample
 * @package Nakard\Laboratory\SampleBundle\Entity\Tests
 */
class Sample
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var \DateTime
     */
    protected $admittedAt;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var Patient
     */
    protected $patient;

    /**
     * @var ArrayCollection
     */
    protected $tests;

    /**
     * Constructs a sample
     */
    public function __construct()
    {
        $this->tests = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set admittedAt
     *
     * @param \DateTime $admittedAt
     * @return Sample
     */
    public function setAdmittedAt($admittedAt)
    {
        $this->admittedAt = $admittedAt;

        return $this;
    }

    /**
     * Get admittedAt
     *
     * @return \DateTime 
     */
    public function getAdmittedAt()
    {
        return $this->admittedAt;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Sample
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set patient
     *
     * @param   Patient $patient
     * @return  Sample
     */
    public function setPatient(Patient $patient)
    {
        $this->patient = $patient;

        return $this;
    }

    /**
     * Get patient
     *
     * @return Patient
     */
    public function getPatient()
    {
        return $this->patient;
    }

    /**
     * @param   Test    $test
     * @return  Sample
     */
    public function addTest(Test $test)
    {
        $this->tests[] = $test;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getTests()
    {
        return $this->tests;
    }
}
