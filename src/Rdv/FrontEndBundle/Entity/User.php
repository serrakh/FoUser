<?php
// src/AppBundle/Entity/User.php

namespace Rdv\FrontEndBundle\Entity;


use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Mapping\ClassMetadata;

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


    public function setEmail($email)
    {

        parent::setEmail($email);
        $this->setUsername($email);
        return $this;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {

        $metadata->addPropertyConstraint('email', new Email());
        $metadata->addPropertyConstraint('email', new NotBlank());
        $metadata->addPropertyConstraint('plainPassword', new NotBlank());
        $metadata->addPropertyConstraint('plainPassword', new Length( array( 'min' => 5) ));
    }
}
