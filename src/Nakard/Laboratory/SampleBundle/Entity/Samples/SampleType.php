<?php
/**
 * SampleType.php
 *
 * Creation date: 2014-07-08
 * Creation time: 19:00
 *
 * @author Arkadiusz Moskwa <a.moskwa@gmail.com>
 */

namespace Nakard\Laboratory\SampleBundle\Entity\Samples;

use Doctrine\Common\Collections\ArrayCollection;
use Nakard\Laboratory\TestBundle\Entity\Tests\TestType;

/**
 * Class SampleType
 *
 * @package Nakard\Laboratory\SampleBundle\Entity\Samples
 */
class SampleType
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
    protected $testTypes;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $samples;

    /**
     * Creates new sample type
     */
    public function __construct()
    {
        $this->samples = new ArrayCollection();
        $this->testTypes = new ArrayCollection();
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
     * @param \Nakard\Laboratory\TestBundle\Entity\Tests\TestType $testType
     */
    public function addTestType(TestType $testType)
    {
        $this->testTypes[] = $testType;
    }

    /**
     * @param TestType $testType
     */
    public function removeTestType(TestType $testType)
    {
        $this->testTypes->removeElement($testType);
    }

    /**
     * @return ArrayCollection
     */
    public function getTestTypes()
    {
        return $this->testTypes;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt)
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
     * Sets up creation date
     */
    public function setUpCreationDate()
    {
        $this->setCreatedAt(new \DateTime());
    }

    /**
     * @return ArrayCollection
     */
    public function getSamples()
    {
        return $this->samples;
    }

    /**
     * @param Sample $sample
     */
    public function addSample(Sample $sample)
    {
        $this->samples[] = $sample;
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
}
