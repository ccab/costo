<?php

namespace Costo\OfertaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SitioServicio
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class SitioServicio
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
     * @var integer
     *
     * @ORM\Column(name="valor", type="integer")
     */
    private $valor;

    /**
     * @ORM\ManyToOne(targetEntity="Sitio", inversedBy="sitio_servicios")
     * @ORM\JoinColumn(name="sitio_id", referencedColumnName="id")
     */
    private $sitio;
    
    /**
     * @ORM\ManyToOne(targetEntity="Costo\ServicioBundle\Entity\Servicio", inversedBy="sitio_servicio")
     * @ORM\JoinColumn(name="servicio_id", referencedColumnName="id")
     */
    protected $servicio;
    
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
     * Set sitio
     *
     * @param \Costo\OfertaBundle\Entity\Sitio $sitio
     * @return SitioServicio
     */
    public function setSitio(\Costo\OfertaBundle\Entity\Sitio $sitio = null)
    {
        $this->sitio = $sitio;

        return $this;
    }

    /**
     * Get sitio
     *
     * @return \Costo\OfertaBundle\Entity\Sitio 
     */
    public function getSitio()
    {
        return $this->sitio;
    }

    /**
     * Set servicio
     *
     * @param \Costo\ServicioBundle\Entity\Servicio $servicio
     * @return SitioServicio
     */
    public function setServicio(\Costo\ServicioBundle\Entity\Servicio $servicio = null)
    {
        $this->servicio = $servicio;

        return $this;
    }

    /**
     * Get servicio
     *
     * @return \Costo\ServicioBundle\Entity\Servicio 
     */
    public function getServicio()
    {
        return $this->servicio;
    }

    /**
     * Set valor
     *
     * @param integer $valor
     * @return SitioServicio
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return integer 
     */
    public function getValor()
    {
        return $this->valor;
    }
}
