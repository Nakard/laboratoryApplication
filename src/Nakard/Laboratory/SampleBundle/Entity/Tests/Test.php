<?php

namespace Nakard\Laboratory\SampleBundle\Entity\Tests;

use Doctrine\Common\Collections\ArrayCollection;
use Nakard\Laboratory\UserBundle\Entity\Users\Doctor;
use Nakard\Laboratory\UserBundle\Entity\Users\Patient;
use Nakard\Laboratory\UserBundle\Entity\Users\LaboratoryAssistant;

/**
 * Class Test
 *
 * @package Nakard\Laboratory\SampleBundle\Entity\Tests
 */
class Test
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
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
     * @var ArrayCollection
     */
    protected $samples;

    /**
     * Constructs a test
     */
    public function __construct()
    {
        $this->samples = new ArrayCollection();
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
     * Set type
     *
     * @param string $type
     * @return Test
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
     * Set value
     *
     * @param string $value
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
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set scheduler
     *
     * @param string $scheduler
     * @return Test
     */
    public function setScheduler($scheduler)
    {
        $this->scheduler = $scheduler;

        return $this;
    }

    /**
     * Get scheduler
     *
     * @return string 
     */
    public function getScheduler()
    {
        return $this->scheduler;
    }

    /**
     * Set patient
     *
     * @param string $patient
     * @return Test
     */
    public function setPatient($patient)
    {
        $this->patient = $patient;

        return $this;
    }

    /**
     * Get patient
     *
     * @return string 
     */
    public function getPatient()
    {
        return $this->patient;
    }

    /**
     * Set labAssistant
     *
     * @param string $labAssistant
     * @return Test
     */
    public function setLabAssistant($labAssistant)
    {
        $this->labAssistant = $labAssistant;

        return $this;
    }

    /**
     * Get labAssistant
     *
     * @return string 
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
    public function setRegisterDate($registerDate)
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
    public function setConductDate($conductDate)
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
     * @param  ArrayCollection $samples
     * @return Test
     */
    public function setSamples($samples)
    {
        $this->samples = $samples;

        return $this;
    }

    /**
     * Adds sample to the test
     *
     * @param $sample
     */
    public function addSample($sample)
    {
        $this->samples[] = $sample;
    }

    /**
     * Get samples
     *
     * @return array 
     */
    public function getSamples()
    {
        return $this->samples;
    }
}
