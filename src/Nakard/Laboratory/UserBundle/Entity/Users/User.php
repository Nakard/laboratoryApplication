<?php

namespace Nakard\Laboratory\UserBundle\Entity\Users;

use FOS\UserBundle\Model\User as BaseUser;

/**
 * Class User
 * @package Nakard\Laboratory\UserBundle\Entity\Users
 */
class User extends BaseUser
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $firstName;

    /**
     * @var string
     */
    protected $lastName;

    /**
     * @var string
     */
    protected $pesel;

    /**
     * @var \DateTime
     */
    protected $registeredAt;

    /**
     * @var string
     */
    protected $type;

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
     * Set name
     *
     * @param   string $name
     * @return  User
     */
    public function setFirstName($name)
    {
        $this->firstName = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set surname
     *
     * @param   string $surname
     * @return  User
     */
    public function setLastName($surname)
    {
        $this->lastName = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Returns credentials of an user
     *
     * @return string
     */
    public function getCredentials()
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    /**
     * Set Pesel
     *
     * @param   string $pesel
     * @return  User
     */
    public function setPesel($pesel)
    {
        $this->pesel = $pesel;

        return $this;
    }

    /**
     * Get Pesel
     *
     * @return string 
     */
    public function getPesel()
    {
        return $this->pesel;
    }

    /**
     * Set registerDate
     *
     * @param   \DateTime $registerDate
     * @return  User
     */
    public function setRegisteredAt($registerDate)
    {
        $this->registeredAt = $registerDate;

        return $this;
    }

    /**
     * Get registerDate
     *
     * @return \DateTime 
     */
    public function getRegisteredAt()
    {
        return $this->registeredAt;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Gets Type name of User
     *
     * @return string
     */
    public function getTypeName()
    {
        return 'User';
    }

    /**
     * @return array
     */
    public static function getTypes()
    {
        return [
            'admin',
            'doctor',
            'patient',
            'assistant',
        ];
    }

    /**
     * Checks if pesel is valid
     * @return  bool
     */
    public function isValidPesel()
    {
        $pesel = $this->getPesel();
        if (!preg_match('/^[0-9]{11}$/', $pesel)) {
            return false;
        }

        $arrSteps = [1, 3, 7, 9, 1, 3, 7, 9, 1, 3];
        $intSum = 0;
        for ($i = 0; $i < 10; $i++) {
            $intSum += $arrSteps[$i] * $pesel[$i];
        }
        $int = 10 - $intSum % 10;
        $intControlNr = ($int == 10) ? 0 : $int;
        if ($intControlNr == $pesel[10]) {
            return true;
        }
        return false;
    }

    /**
     * Sets registered at for the moment of registration success
     */
    public function setRegisterDate()
    {
        $this->setRegisteredAt(new \DateTime());
    }


    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getCredentials();
    }
}
