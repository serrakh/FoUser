<?php
// src/AppBundle/Entity/User.php

namespace Rdv\FrontEndBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="usertype", type="string")
 * @ORM\DiscriminatorMap({"patient" = "Patient", "opticien" = "Opticien" , "professionnel" = "Professionnel"})
 * @ORM\Table(name="utilisateur")
 */
abstract class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

}