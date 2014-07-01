<?php
/**
 * LaboratoryAssistant.php
 *
 * Creation date: 2014-07-01
 * Creation time: 21:43
 *
 * @author Arkadiusz Moskwa <a.moskwa@gmail.com>
 */

namespace Nakard\Laboratory\ApplicationBundle\Entity\Users;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class LaboratoryAssistant
 * @package Nakard\Laboratory\ApplicationBundle\Entity\Users
 */
class LaboratoryAssistant extends User{

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $assignedTests;

    public function __construct()
    {
        $this->assignedTests = new ArrayCollection();
    }

} 