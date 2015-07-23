<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContratoDieta
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ContratoDieta
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
     * @ORM\ManyToOne(targetEntity="Dieta", inversedBy="contratoDietas")
     */
    protected $dieta;
    
    /**
     * @ORM\ManyToOne(targetEntity="Provincia", inversedBy="contratoDietas")
     */
    private $provincia;
    
    /**
     * @var string
     *
     * @ORM\Column(name="contrato", type="string", length=255, nullable=true)
     */
    private $contrato;

    /**
     * @var string
     *
     * @ORM\Column(name="proyecto", type="string", length=255, nullable=true)
     */
    private $proyecto;

    /**
     * @var integer
     *
     * @ORM\Column(name="dias", type="integer")
     */
    private $dias;


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
     * Set contrato
     *
     * @param string $contrato
     *
     * @return ContratoDieta
     */
    public function setContrato($contrato)
    {
        $this->contrato = $contrato;

        return $this;
    }

    /**
     * Get contrato
     *
     * @return string
     */
    public function getContrato()
    {
        return $this->contrato;
    }

    /**
     * Set proyecto
     *
     * @param string $proyecto
     *
     * @return ContratoDieta
     */
    public function setProyecto($proyecto)
    {
        $this->proyecto = $proyecto;

        return $this;
    }

    /**
     * Get proyecto
     *
     * @return string
     */
    public function getProyecto()
    {
        return $this->proyecto;
    }

    /**
     * Set dias
     *
     * @param integer $dias
     *
     * @return ContratoDieta
     */
    public function setDias($dias)
    {
        $this->dias = $dias;

        return $this;
    }

    /**
     * Get dias
     *
     * @return integer
     */
    public function getDias()
    {
        return $this->dias;
    }
    
    public function __toString() {
        return $this->contrato;
    }

    /**
     * Set dieta
     *
     * @param \AppBundle\Entity\Dieta $dieta
     *
     * @return ContratoDieta
     */
    public function setDieta(\AppBundle\Entity\Dieta $dieta = null)
    {
        $this->dieta = $dieta;

        return $this;
    }

    /**
     * Get dieta
     *
     * @return \AppBundle\Entity\Dieta
     */
    public function getDieta()
    {
        return $this->dieta;
    }

    /**
     * Set provincia
     *
     * @param \AppBundle\Entity\Provincia $provincia
     *
     * @return ContratoDieta
     */
    public function setProvincia(\AppBundle\Entity\Provincia $provincia = null)
    {
        $this->provincia = $provincia;

        return $this;
    }

    /**
     * Get provincia
     *
     * @return \AppBundle\Entity\Provincia
     */
    public function getProvincia()
    {
        return $this->provincia;
    }

    public function __clone(){
        if ($this->id) {
            $this->id = null;
            //$this->dieta = clone $this->dieta;
        }
    }
}
