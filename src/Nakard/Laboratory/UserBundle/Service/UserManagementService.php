<?php
/**
 * UserManagementService.php
 *
 * Creation date: 2014-07-05
 * Creation time: 16:50
 *
 * @author Arkadiusz Moskwa <a.moskwa@gmail.com>
 */

namespace Nakard\Laboratory\UserBundle\Service;

use Nakard\Laboratory\UserBundle\Entity\Users\Administrator;
use Nakard\Laboratory\UserBundle\Entity\Users\Doctor;
use Nakard\Laboratory\UserBundle\Entity\Users\LaboratoryAssistant;
use Nakard\Laboratory\UserBundle\Entity\Users\Patient;
use Nakard\Laboratory\UserBundle\Entity\Users\User;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;

/**
 * Class UserManagementService
 * @package Nakard\Laboratory\UserBundle\Service
 */
class UserManagementService
{
    /**
     * Creates proper class user based on type
     * @param   string|null $type
     * @return  Administrator|Doctor|LaboratoryAssistant|Patient|User
     * @throws  InvalidArgumentException
     */
    public function createProperUser($type = null)
    {
        switch($type) {
            case 'admin':
                return new Administrator();
                break;
            case 'assistant':
                return new LaboratoryAssistant();
                break;
            case 'doctor':
                return new Doctor();
                break;
            case 'patient':
                return new Patient();
                break;
            default:
                return new User();
                break;
        }
    }
} 