<?php

namespace Costo\OfertaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OfertaProceso
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Costo\OfertaBundle\Entity\OfertaProcesoRepository")
 */
class OfertaProceso
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
     * @var boolean
     *
     * @ORM\Column(name="principal", type="boolean")
     */
    private $principal;
    
    /**
     * @ORM\ManyToOne(targetEntity="Oferta", inversedBy="oferta_procesos")
     * @ORM\JoinColumn(name="oferta_id", referencedColumnName="id")
     */
    private $oferta;
    
    /**
     * @ORM\ManyToOne(targetEntity="Costo\ServicioBundle\Entity\Proceso", inversedBy="oferta_proceso")
     * @ORM\JoinColumn(name="proceso_id", referencedColumnName="id")
     */
    private $proceso;


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
     * Set principal
     *
     * @param boolean $principal
     * @return OfertaProceso
     */
    public function setPrincipal($principal)
    {
        $this->principal = $principal;

        return $this;
    }

    /**
     * Get principal
     *
     * @return boolean 
     */
    public function getPrincipal()
    {
        return $this->principal;
    }

    /**
     * Set oferta
     *
     * @param \Costo\OfertaBundle\Entity\Oferta $oferta
     * @return OfertaProceso
     */
    public function setOferta(\Costo\OfertaBundle\Entity\Oferta $oferta = null)
    {
        $this->oferta = $oferta;

        return $this;
    }

    /**
     * Get oferta
     *
     * @return \Costo\OfertaBundle\Entity\Oferta 
     */
    public function getOferta()
    {
        return $this->oferta;
    }

    /**
     * Set proceso
     *
     * @param \Costo\ServicioBundle\Entity\Proceso $proceso
     * @return OfertaProceso
     */
    public function setProceso(\Costo\ServicioBundle\Entity\Proceso $proceso = null)
    {
        $this->proceso = $proceso;

        return $this;
    }

    /**
     * Get proceso
     *
     * @return \Costo\ServicioBundle\Entity\Proceso 
     */
    public function getProceso()
    {
        return $this->proceso;
    }
}
