<?php
/**
 * TestPacket.php
 *
 * Creation date: 2014-07-06
 * Creation time: 17:36
 *
 * @author Arkadiusz Moskwa <a.moskwa@gmail.com>
 */

namespace Nakard\Laboratory\TestBundle\Entity\Tests;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class TestPacket
 *
 * @package Nakard\Laboratory\TestBundle\Entity\Tests
 */
class TestPacket
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
     * Creates new test packet
     */
    public function __construct()
    {
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
     * @param TestType $testType
     */
    public function addTestType(TestType $testType)
    {
        $this->testTypes[] = $testType;
    }

    /**
     * @return ArrayCollection
     */
    public function getTestTypes()
    {
        return $this->testTypes;
    }

    /**
     * Sets up register date during creation
     */
    public function setUpRegisterDate()
    {
        $this->setCreatedAt(new \DateTime());
    }
}
