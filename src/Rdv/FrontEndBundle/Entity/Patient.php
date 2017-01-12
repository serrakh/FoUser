<?php

namespace Rdv\FrontEndBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Patient
 *
 * @ORM\Table(name="patient")
 * @ORM\Entity(repositoryClass="Rdv\FrontEndBundle\Repository\PatientRepository")
 */
class Patient extends User
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @var string
     * @ORM\Column(name="nom" , type="string")
     * @Assert\NotBlank()
     */
    protected $nom;

    /**
     * @var string
     * @ORM\Column(name="prenom" , type="string")
     * @Assert\NotBlank()
     */
    protected $prenom;

    /**
     * @var \Date
     * @ORM\Column(name="dateNaissance" , type="date")
     */
    protected $dateNaissance;


    /**
     * @var string
     * @ORM\Column(name="civilisation" , type="string")
     * @Assert\NotBlank()
     */
    protected $civilisation;

    /**
     * @var string
     * @ORM\Column(name="telephone" , type="string")
     * @Assert\Regex(pattern="/^^(0)[0-9]{9}$/", message="Numéro de téléphone non valide")
     * @Assert\NotBlank()
     */
    protected $telephone;

    /**
     * Patient constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     *
     * @return Patient
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Patient
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Patient
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set civilisation
     *
     * @param string $civilisation
     *
     * @return Patient
     */
    public function setCivilisation($civilisation)
    {
        $this->civilisation = $civilisation;

        return $this;
    }

    /**
     * Get civilisation
     *
     * @return string
     */
    public function getCivilisation()
    {
        return $this->civilisation;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return Patient
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }
}
