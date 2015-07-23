<?php

namespace Costo\MaterialesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="moneda")
 * @ORM\Entity(repositoryClass="Costo\MaterialesBundle\Entity\monedaRepository")}
 */
class moneda {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", name="nombre_moneda")
     */
    protected $nombre_moneda;

    /**
     * @ORM\Column(type="string", name="abreviatura", length=10, nullable=false, unique=true)
     */
    protected $abreviatura;

    /**
     * @ORM\OneToMany(targetEntity="precio", mappedBy="moneda")
     */
    protected $precios;

    /**
     * @ORM\OneToMany(targetEntity="costo", mappedBy="moneda")
     */
    protected $costos;
    
    /**
     * @ORM\OneToMany(targetEntity="Costo\ClienteBundle\Entity\Cuenta", mappedBy="moneda")
     */
    protected $cuentas;



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
     * Set nombre_moneda
     *
     * @param string $nombreMoneda
     * @return moneda
     */
    public function setNombreMoneda($nombreMoneda)
    {
        $this->nombre_moneda = $nombreMoneda;

        return $this;
    }

    /**
     * Get nombre_moneda
     *
     * @return string 
     */
    public function getNombreMoneda()
    {
        return $this->nombre_moneda;
    }

    /**
     * Set abreviatura
     *
     * @param string $abreviatura
     * @return moneda
     */
    public function setAbreviatura($abreviatura)
    {
        $this->abreviatura = $abreviatura;

        return $this;
    }

    /**
     * Get abreviatura
     *
     * @return string 
     */
    public function getAbreviatura()
    {
        return $this->abreviatura;
    }

    /**
     * Add precios
     *
     * @param \Costo\MaterialesBundle\Entity\precio $precios
     * @return moneda
     */
    public function addPrecio(\Costo\MaterialesBundle\Entity\precio $precios)
    {
        $this->precios[] = $precios;

        return $this;
    }

    /**
     * Remove precios
     *
     * @param \Costo\MaterialesBundle\Entity\precio $precios
     */
    public function removePrecio(\Costo\MaterialesBundle\Entity\precio $precios)
    {
        $this->precios->removeElement($precios);
    }

    /**
     * Get precios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPrecios()
    {
        return $this->precios;
    }

    /**
     * Add costos
     *
     * @param \Costo\MaterialesBundle\Entity\costo $costos
     * @return moneda
     */
    public function addCosto(\Costo\MaterialesBundle\Entity\costo $costos)
    {
        $this->costos[] = $costos;

        return $this;
    }

    /**
     * Remove costos
     *
     * @param \Costo\MaterialesBundle\Entity\costo $costos
     */
    public function removeCosto(\Costo\MaterialesBundle\Entity\costo $costos)
    {
        $this->costos->removeElement($costos);
    }

    /**
     * Get costos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCostos()
    {
        return $this->costos;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->precios = new \Doctrine\Common\Collections\ArrayCollection();
        $this->costos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cuentas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add cuentas
     *
     * @param \Costo\ClienteBundle\Entity\Cuenta $cuentas
     * @return moneda
     */
    public function addCuenta(\Costo\ClienteBundle\Entity\Cuenta $cuentas)
    {
        $this->cuentas[] = $cuentas;

        return $this;
    }

    /**
     * Remove cuentas
     *
     * @param \Costo\ClienteBundle\Entity\Cuenta $cuentas
     */
    public function removeCuenta(\Costo\ClienteBundle\Entity\Cuenta $cuentas)
    {
        $this->cuentas->removeElement($cuentas);
    }

    /**
     * Get cuentas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCuentas()
    {
        return $this->cuentas;
    }
    
    public function __toString() {
        return $this->abreviatura;
    }
}
