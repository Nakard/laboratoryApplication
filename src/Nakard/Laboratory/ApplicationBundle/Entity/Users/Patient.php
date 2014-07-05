<?php
/**
 * Patient.php
 *
 * Creation date: 2014-07-01
 * Creation time: 20:16
 *
 * @author Arkadiusz Moskwa <a.moskwa@gmail.com>
 */

namespace Nakard\Laboratory\ApplicationBundle\Entity\Users;
use Doctrine\Common\Collections\ArrayCollection;
use Nakard\Laboratory\ApplicationBundle\Entity\Tests\Sample;
use Nakard\Laboratory\ApplicationBundle\Entity\Tests\Test;

/**
 * Class Patient
 * @package Nakard\Laboratory\ApplicationBundle\Entity\Users
 */
class Patient extends User {

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $tests;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $samples;

    public function __construct()
    {
        $this->tests = new ArrayCollection();
        $this->samples = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getTests()
    {
        return $this->tests;
    }

    /**
     * @param   Test        $test
     * @return  Patient
     */
    public function addTest(Test $test)
    {
        $this->tests[] = $test;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getSamples()
    {
        return $this->samples;
    }

    /**
     * @param   Sample    $sample
     * @return  Patient
     */
    public function addSample(Sample $sample)
    {
        $this->samples[] = $sample;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getTypeName()
    {
        return 'Patient';
    }

} 