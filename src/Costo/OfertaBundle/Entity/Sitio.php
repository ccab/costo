<?php

namespace Costo\OfertaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sitio
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Costo\OfertaBundle\Entity\SitioRepository")
 */
class Sitio {

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
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\ManyToOne(targetEntity="Oferta", inversedBy="sitios")
     * @ORM\JoinColumn(name="oferta_id", referencedColumnName="id")
     */
    private $oferta;

    /**
     * @ORM\OneToMany(targetEntity="SitioMaterial", mappedBy="sitio", cascade={"remove"})
     */
    private $sitio_materiales;

    /**
     * @ORM\OneToMany(targetEntity="SitioServicio", mappedBy="sitio", cascade={"remove"})
     */
    private $sitio_servicios;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Sitio
     */
    public function setNombre($nombre) {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * Set oferta
     *
     * @param \Costo\OfertaBundle\Entity\Oferta $oferta
     * @return Sitio
     */
    public function setOferta(\Costo\OfertaBundle\Entity\Oferta $oferta = null) {
        $this->oferta = $oferta;

        return $this;
    }

    /**
     * Get oferta
     *
     * @return \Costo\OfertaBundle\Entity\Oferta 
     */
    public function getOferta() {
        return $this->oferta;
    }

    
    /**
     * Add sitio_materiales
     *
     * @param \Costo\OfertaBundle\Entity\SitioMaterial $sitioMateriales
     * @return Sitio
     */
    public function addSitioMateriale(\Costo\OfertaBundle\Entity\SitioMaterial $sitioMateriales)
    {
        $this->sitio_materiales[] = $sitioMateriales;

        return $this;
    }

    /**
     * Remove sitio_materiales
     *
     * @param \Costo\OfertaBundle\Entity\SitioMaterial $sitioMateriales
     */
    public function removeSitioMateriale(\Costo\OfertaBundle\Entity\SitioMaterial $sitioMateriales)
    {
        $this->sitio_materiales->removeElement($sitioMateriales);
    }

    /**
     * Get sitio_materiales
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSitioMateriales()
    {
        return $this->sitio_materiales;
    }

    /**
     * Add sitio_servicios
     *
     * @param \Costo\OfertaBundle\Entity\SitioServicio $sitioServicios
     * @return Sitio
     */
    public function addSitioServicio(\Costo\OfertaBundle\Entity\SitioServicio $sitioServicios)
    {
        $this->sitio_servicios[] = $sitioServicios;

        return $this;
    }

    /**
     * Remove sitio_servicios
     *
     * @param \Costo\OfertaBundle\Entity\SitioServicio $sitioServicios
     */
    public function removeSitioServicio(\Costo\OfertaBundle\Entity\SitioServicio $sitioServicios)
    {
        $this->sitio_servicios->removeElement($sitioServicios);
    }

    /**
     * Get sitio_servicios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSitioServicios()
    {
        return $this->sitio_servicios;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sitio_materiales = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sitio_servicios = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    public function __toString() {
        return $this->nombre;
    }

}
