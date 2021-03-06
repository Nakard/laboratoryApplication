<?php
/**
 * TestType.php
 *
 * Creation date: 2014-07-06
 * Creation time: 17:37
 *
 * @author Arkadiusz Moskwa <a.moskwa@gmail.com>
 */

namespace Nakard\Laboratory\TestBundle\Entity\Tests;

use Doctrine\Common\Collections\ArrayCollection;
use Nakard\Laboratory\SampleBundle\Entity\Samples\SampleType;

/**
 * Class TestType
 *
 * @package Nakard\Laboratory\TestBundle\Entity\Tests
 */
class TestType
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $packets;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $tests;

    /**
     * @var SampleType
     */
    protected $sampleType;

    /**
     * Creates new test type
     */
    public function __construct()
    {
        $this->tests = new ArrayCollection();
        $this->packets = new ArrayCollection();
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \Nakard\Laboratory\TestBundle\Entity\Tests\TestPacket $packet
     */
    public function addPacket(TestPacket $packet)
    {
        $this->packets[] = $packet;
    }

    /**
     * @return \Nakard\Laboratory\TestBundle\Entity\Tests\TestPacket
     */
    public function getPackets()
    {
        return $this->packets;
    }

    /**
     * @param Test $test
     */
    public function addTest(Test $test)
    {
        $this->tests[] = $test;
    }

    /**
     * @return ArrayCollection
     */
    public function getTests()
    {
        return $this->tests;
    }

    /**
     * Sets up correct date during creation
     */
    public function setUpRegisterDate()
    {
        $this->setCreatedAt(new \DateTime());
    }

    /**
     * @param \Nakard\Laboratory\SampleBundle\Entity\Samples\SampleType $sampleType
     */
    public function setSampleType(SampleType $sampleType)
    {
        $this->sampleType = $sampleType;
    }

    /**
     * @return \Nakard\Laboratory\SampleBundle\Entity\Samples\SampleType
     */
    public function getSampleType()
    {
        return $this->sampleType;
    }

    /**
     * Sets sample type to null
     */
    public function removeSampleType()
    {
        $this->sampleType = null;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
}
