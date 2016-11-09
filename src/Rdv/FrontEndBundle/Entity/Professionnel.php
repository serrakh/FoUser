<?php

namespace Rdv\FrontEndBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Professionnel
 *
 * @ORM\Table(name="professionnel")
 * @ORM\Entity(repositoryClass="Rdv\FrontEndBundle\Repository\ProfessionnelRepository")
 */
class Professionnel extends User
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
     *
     * @ORM\Column(name="nomCommercial", type="string", length=255)
     */
    private $nomCommercial;

    /**
     * Professionnel constructor.
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
     * Set nomCommercial
     *
     * @param string $nomCommercial
     *
     * @return Professionnel
     */
    public function setNomCommercial($nomCommercial)
    {
        $this->nomCommercial = $nomCommercial;

        return $this;
    }

    /**
     * Get nomCommercial
     *
     * @return string
     */
    public function getNomCommercial()
    {
        return $this->nomCommercial;
    }
}

