<?php

namespace Nakard\Laboratory\UserBundle\Entity\Users;

use FOS\UserBundle\Entity\User as BaseUser;

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
    protected $name;

    /**
     * @var string
     */
    protected $surname;

    /**
     * @var string
     */
    protected $login;

    /**
     * @var string
     */
    protected $pesel;

    /**
     * @var \DateTime
     */
    protected $registerDate;

    /**
     * @var string
     */
    protected $type;

    public function __construct()
    {
        parent::__construct();
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
     * Set name
     *
     * @param   string $name
     * @return  User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set surname
     *
     * @param   string $surname
     * @return  User
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Returns credentials of an user
     *
     * @return string
     */
    public function getCredentials()
    {
        return $this->name . ' ' . $this->surname;
    }

    /**
     * Set login
     *
     * @param   string $login
     * @return  User
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string 
     */
    public function getLogin()
    {
        return $this->login;
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
        return array(
            'admin',
            'doctor',
            'patient',
            'assistant',
        );
    }

    /**
     * Checks if pesel is valid
     * @return  bool
     */
    public function isValidPesel()
    {
        $pesel = $this->getPesel();
        if (!preg_match('/^[0-9]{11}$/',$pesel))
        {
            return false;
        }

        $arrSteps = array(1, 3, 7, 9, 1, 3, 7, 9, 1, 3);
        $intSum = 0;
        for ($i = 0; $i < 10; $i++)
        {
            $intSum += $arrSteps[$i] * $pesel[$i];
        }
        $int = 10 - $intSum % 10;
        $intControlNr = ($int == 10) ? 0 : $int;
        if ($intControlNr == $pesel[10])
        {
            return true;
        }
        return false;
    }
}
