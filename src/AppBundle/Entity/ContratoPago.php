<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContratoPago
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ContratoPago
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\OneToMany(targetEntity="Dieta", mappedBy="contratoPago")
     */
    protected $dietas;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="impEntregadoDesayunoCUP", type="float")
     */
    private $impEntregadoDesayunoCUP;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="impEntregadoDesayunoCUC", type="float")
     */
    private $impEntregadoDesayunoCUC;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="$impEntregadoAlmuerzoCUP", type="float")
     */
    private $impEntregadoAlmuerzoCUP;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="$impEntregadoAlmuerzoCUC", type="float")
     */
    private $impEntregadoAlmuerzoCUC;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="$impEntregadoComidaCUP", type="float")
     */
    private $impEntregadoComidaCUP;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="$impEntregadoComidaCUC", type="float")
     */
    private $impEntregadoComidaCUC;


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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return ContratoPago
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    
    public function __toString() {
        return $this->nombre;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->dietas = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set impEntregadoDesayunoCUP
     *
     * @param float $impEntregadoDesayunoCUP
     *
     * @return ContratoPago
     */
    public function setImpEntregadoDesayunoCUP($impEntregadoDesayunoCUP)
    {
        $this->impEntregadoDesayunoCUP = $impEntregadoDesayunoCUP;

        return $this;
    }

    /**
     * Get impEntregadoDesayunoCUP
     *
     * @return float
     */
    public function getImpEntregadoDesayunoCUP()
    {
        return $this->impEntregadoDesayunoCUP;
    }

    /**
     * Set impEntregadoDesayunoCUC
     *
     * @param float $impEntregadoDesayunoCUC
     *
     * @return ContratoPago
     */
    public function setImpEntregadoDesayunoCUC($impEntregadoDesayunoCUC)
    {
        $this->impEntregadoDesayunoCUC = $impEntregadoDesayunoCUC;

        return $this;
    }

    /**
     * Get impEntregadoDesayunoCUC
     *
     * @return float
     */
    public function getImpEntregadoDesayunoCUC()
    {
        return $this->impEntregadoDesayunoCUC;
    }

    /**
     * Set impEntregadoAlmuerzoCUP
     *
     * @param float $impEntregadoAlmuerzoCUP
     *
     * @return ContratoPago
     */
    public function setImpEntregadoAlmuerzoCUP($impEntregadoAlmuerzoCUP)
    {
        $this->impEntregadoAlmuerzoCUP = $impEntregadoAlmuerzoCUP;

        return $this;
    }

    /**
     * Get impEntregadoAlmuerzoCUP
     *
     * @return float
     */
    public function getImpEntregadoAlmuerzoCUP()
    {
        return $this->impEntregadoAlmuerzoCUP;
    }

    /**
     * Set impEntregadoAlmuerzoCUC
     *
     * @param float $impEntregadoAlmuerzoCUC
     *
     * @return ContratoPago
     */
    public function setImpEntregadoAlmuerzoCUC($impEntregadoAlmuerzoCUC)
    {
        $this->impEntregadoAlmuerzoCUC = $impEntregadoAlmuerzoCUC;

        return $this;
    }

    /**
     * Get impEntregadoAlmuerzoCUC
     *
     * @return float
     */
    public function getImpEntregadoAlmuerzoCUC()
    {
        return $this->impEntregadoAlmuerzoCUC;
    }

    /**
     * Set impEntregadoComidaCUP
     *
     * @param float $impEntregadoComidaCUP
     *
     * @return ContratoPago
     */
    public function setImpEntregadoComidaCUP($impEntregadoComidaCUP)
    {
        $this->impEntregadoComidaCUP = $impEntregadoComidaCUP;

        return $this;
    }

    /**
     * Get impEntregadoComidaCUP
     *
     * @return float
     */
    public function getImpEntregadoComidaCUP()
    {
        return $this->impEntregadoComidaCUP;
    }

    /**
     * Set impEntregadoComidaCUC
     *
     * @param float $impEntregadoComidaCUC
     *
     * @return ContratoPago
     */
    public function setImpEntregadoComidaCUC($impEntregadoComidaCUC)
    {
        $this->impEntregadoComidaCUC = $impEntregadoComidaCUC;

        return $this;
    }

    /**
     * Get impEntregadoComidaCUC
     *
     * @return float
     */
    public function getImpEntregadoComidaCUC()
    {
        return $this->impEntregadoComidaCUC;
    }

    /**
     * Add dieta
     *
     * @param \AppBundle\Entity\Dieta $dieta
     *
     * @return ContratoPago
     */
    public function addDieta(\AppBundle\Entity\Dieta $dieta)
    {
        $this->dietas[] = $dieta;

        return $this;
    }

    /**
     * Remove dieta
     *
     * @param \AppBundle\Entity\Dieta $dieta
     */
    public function removeDieta(\AppBundle\Entity\Dieta $dieta)
    {
        $this->dietas->removeElement($dieta);
    }

    /**
     * Get dietas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDietas()
    {
        return $this->dietas;
    }
}
