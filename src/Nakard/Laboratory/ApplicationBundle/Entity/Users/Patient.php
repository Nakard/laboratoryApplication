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

} 