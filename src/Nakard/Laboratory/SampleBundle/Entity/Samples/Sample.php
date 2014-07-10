<?php

namespace Nakard\Laboratory\SampleBundle\Entity\Samples;

use Doctrine\Common\Collections\ArrayCollection;
use Nakard\Laboratory\UserBundle\Entity\Users\Patient;
use Nakard\Laboratory\TestBundle\Entity\Tests\Test;

/**
 * Class Sample
 * @package Nakard\Laboratory\SampleBundle\Entity\Samples
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
     * @var SampleType
     */
    protected $sampleType;

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
     * @param  SampleType $type
     * @return Sample
     */
    public function setSampleType($type)
    {
        $this->sampleType = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return SampleType
     */
    public function getSampleType()
    {
        return $this->sampleType;
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

    /**
     * Sets up admition date during sample admition
     */
    public function setUpAdmitionDate()
    {
        $this->setAdmittedAt(new \DateTime());
    }
}
