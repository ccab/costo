<?php

namespace Costo\ServicioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proceso
 *
 * @ORM\Table(name="procesos")
 * @ORM\Entity(repositoryClass="Costo\ServicioBundle\Entity\ProcesoRepository")
 */
class Proceso
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
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=50)
     */
    private $nombre;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="numero", type="integer", length=3)
     */
    private $numero;
    
    /**
    * @ORM\OneToMany(targetEntity="Servicio", mappedBy="proceso")
    */
    private $servicios;
    
    /**
     * @ORM\OneToMany(targetEntity="Costo\OfertaBundle\Entity\OfertaProceso", mappedBy="proceso")
     */
    private $oferta_proceso;


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
     * @return Proceso
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


    /**
     * Add servicios
     *
     * @param \Costo\ServicioBundle\Entity\Servicio $servicios
     * @return Proceso
     */
    public function addServicio(\Costo\ServicioBundle\Entity\Servicio $servicios)
    {
        $this->servicios[] = $servicios;

        return $this;
    }

    /**
     * Remove servicios
     *
     * @param \Costo\ServicioBundle\Entity\Servicio $servicios
     */
    public function removeServicio(\Costo\ServicioBundle\Entity\Servicio $servicios)
    {
        $this->servicios->removeElement($servicios);
    }

    /**
     * Get servicios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getServicios()
    {
        return $this->servicios;
    }

    /**
     * Add oferta_proceso
     *
     * @param \Costo\OfertaBundle\Entity\OfertaProceso $ofertaProceso
     * @return Proceso
     */
    public function addOfertaProceso(\Costo\OfertaBundle\Entity\OfertaProceso $ofertaProceso)
    {
        $this->oferta_proceso[] = $ofertaProceso;

        return $this;
    }

    /**
     * Remove oferta_proceso
     *
     * @param \Costo\OfertaBundle\Entity\OfertaProceso $ofertaProceso
     */
    public function removeOfertaProceso(\Costo\OfertaBundle\Entity\OfertaProceso $ofertaProceso)
    {
        $this->oferta_proceso->removeElement($ofertaProceso);
    }

    /**
     * Get oferta_proceso
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOfertaProceso()
    {
        return $this->oferta_proceso;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->servicios = new \Doctrine\Common\Collections\ArrayCollection();
        $this->oferta_proceso = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set numero
     *
     * @param integer $numero
     * @return Proceso
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return integer 
     */
    public function getNumero()
    {
        return $this->numero;
    }
    
    public function __toString() {
        return $this->nombre;
    }
}
