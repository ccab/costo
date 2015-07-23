<?php

namespace Costo\OfertaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SitioMaterial
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class SitioMaterial {

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
     * @ORM\ManyToOne(targetEntity="Sitio", inversedBy="sitio_materiales")
     * @ORM\JoinColumn(name="sitio_id", referencedColumnName="id")
     */
    private $sitio;

    /**
     * @ORM\ManyToOne(targetEntity="Costo\MaterialesBundle\Entity\material", inversedBy="sitio_material")
     * @ORM\JoinColumn(name="material_id", referencedColumnName="id")
     */
    protected $material;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }


    /**
     * Set sitio
     *
     * @param \Costo\OfertaBundle\Entity\Sitio $sitio
     * @return SitioMaterial
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
     * Set material
     *
     * @param \Costo\MaterialesBundle\Entity\material $material
     * @return SitioMaterial
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

    /**
     * Set valor
     *
     * @param integer $valor
     * @return SitioMaterial
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
