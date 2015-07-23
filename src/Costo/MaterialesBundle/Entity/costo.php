<?php

namespace Costo\MaterialesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="costo")
 * @ORM\Entity(repositoryClass="Costo\MaterialesBundle\Entity\costoRepository")}
 */
class costo {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="decimal", name="valor", precision=0, scale=2 )
     */
    protected $valor;

    /**
     * @ORM\ManyToOne(targetEntity="moneda", inversedBy="costos")
     * @ORM\JoinColumn(name="moneda_id", referencedColumnName="id")
     */
    protected $moneda; 

        /**
     * @ORM\ManyToOne(targetEntity="material", inversedBy="costos")
     * @ORM\JoinColumn(name="material_id", referencedColumnName="id")
     */
    protected $material;

   
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
     * Set valor
     *
     * @param string $valor
     * @return costo
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return string 
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set moneda
     *
     * @param \Costo\MaterialesBundle\Entity\moneda $moneda
     * @return costo
     */
    public function setMoneda(\Costo\MaterialesBundle\Entity\moneda $moneda = null)
    {
        $this->moneda = $moneda;

        return $this;
    }

    /**
     * Get moneda
     *
     * @return \Costo\MaterialesBundle\Entity\moneda 
     */
    public function getMoneda()
    {
        return $this->moneda;
    }

    /**
     * Set material
     *
     * @param \Costo\MaterialesBundle\Entity\material $material
     * @return costo
     */
    public function setMaterial(\Costo\MaterialesBundle\Entity\material $material = null)
    {
        $this->material = $material;

        return $this;
    }

    /**
     * Get material
     *
     * @return \Costo\MaterialesBundle\Entity\material 
     */
    public function getMaterial()
    {
        return $this->material;
    }
}
