<?php
/**
 * Administrator.php
 *
 * Creation date: 2014-07-01
 * Creation time: 21:42
 *
 * @author Arkadiusz Moskwa <a.moskwa@gmail.com>
 */

namespace Nakard\Laboratory\UserBundle\Entity\Users;

/**
 * Class Administrator
 * @package Nakard\Laboratory\UserBundle\Entity\Users
 */
class Administrator extends User
{
    /**
     * @inheritdoc
     */
    public function getTypeName()
    {
        return 'Administrator';
    }
}
