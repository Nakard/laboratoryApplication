<?php

namespace Nakard\Laboratory\TestBundle\Entity\Tests;

use Nakard\Laboratory\UserBundle\Entity\Users\Doctor;
use Nakard\Laboratory\UserBundle\Entity\Users\Patient;
use Nakard\Laboratory\UserBundle\Entity\Users\LaboratoryAssistant;
use Nakard\Laboratory\SampleBundle\Entity\Samples\Sample;

/**
 * Class Test
 *
 * @package Nakard\Laboratory\TestBundle\Entity\Tests
 */
class Test
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var TestType
     */
    protected $testType;

    /**
     * @var float
     */
    protected $value;

    /**
     * @var Doctor
     */
    protected $scheduler;

    /**
     * @var Patient
     */
    protected $patient;

    /**
     * @var LaboratoryAssistant
     */
    protected $labAssistant;

    /**
     * @var \DateTime
     */
    protected $registerDate;

    /**
     * @var \DateTime
     */
    protected $conductDate;

    /**
     * @var Sample
     */
    protected $sample;

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
     * Set type
     *
     * @param   TestType $type
     * @return  Test
     */
    public function setTestType(TestType $type)
    {
        $this->testType = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return TestType
     */
    public function getTestType()
    {
        return $this->testType;
    }

    /**
     * Set value
     *
     * @param float $value
     * @return Test
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set scheduler
     *
     * @param Doctor $scheduler
     * @return Test
     */
    public function setScheduler(Doctor $scheduler)
    {
        $this->scheduler = $scheduler;

        return $this;
    }

    /**
     * Get scheduler
     *
     * @return Doctor
     */
    public function getScheduler()
    {
        return $this->scheduler;
    }

    /**
     * Set patient
     *
     * @param Patient $patient
     * @return Test
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
     * Set labAssistant
     *
     * @param LaboratoryAssistant $labAssistant
     * @return Test
     */
    public function setLabAssistant(LaboratoryAssistant $labAssistant)
    {
        $this->labAssistant = $labAssistant;

        return $this;
    }

    /**
     * Get labAssistant
     *
     * @return LaboratoryAssistant
     */
    public function getLabAssistant()
    {
        return $this->labAssistant;
    }

    /**
     * Set registerDate
     *
     * @param \DateTime $registerDate
     * @return Test
     */
    public function setRegisterDate(\DateTime $registerDate)
    {
        $this->registerDate = $registerDate;

        return $this;
    }

    /**
     * Get registerDate
     *
     * @return \DateTime 
     */
    public function getRegisterDate()
    {
        return $this->registerDate;
    }

    /**
     * Set conductDate
     *
     * @param \DateTime $conductDate
     * @return Test
     */
    public function setConductDate(\DateTime $conductDate)
    {
        $this->conductDate = $conductDate;

        return $this;
    }

    /**
     * Get conductDate
     *
     * @return \DateTime 
     */
    public function getConductDate()
    {
        return $this->conductDate;
    }

    /**
     * Set samples
     *
     * @param  Sample $sample
     *
     * @return Test
     */
    public function setSample(Sample $sample)
    {
        $this->sample = $sample;

        return $this;
    }

    /**
     * Get samples
     *
     * @return Sample
     */
    public function getSample()
    {
        return $this->sample;
    }

    /**
     * Sets up register date during creation
     */
    public function setUpRegisterDate()
    {
        $this->setRegisterDate(new \DateTime());
    }
}
