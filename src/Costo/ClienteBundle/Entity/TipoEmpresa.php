<?php

namespace Costo\ClienteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TipoEmpresa
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class TipoEmpresa
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
     * @ORM\Column(name="tipo", type="string", length=60)
     */
    private $tipo;


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
     * Set tipo
     *
     * @param string $tipo
     * @return TipoEmpresa
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string 
     */
    public function getTipo()
    {
        return $this->tipo;
    }
    
    /**
     * @ORM\OneToMany(targetEntity="Ficha", mappedBy="tipoempresa")
     */
    private $fichas;
    
    public function __construct()
    {
        $this->fichas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add fichas
     *
     * @param \Costo\ClienteBundle\Entity\Ficha $fichas
     * @return TipoEmpresa
     */
    public function addFicha(\Costo\ClienteBundle\Entity\Ficha $fichas)
    {
        $this->fichas[] = $fichas;

        return $this;
    }

    /**
     * Remove fichas
     *
     * @param \Costo\ClienteBundle\Entity\Ficha $fichas
     */
    public function removeFicha(\Costo\ClienteBundle\Entity\Ficha $fichas)
    {
        $this->fichas->removeElement($fichas);
    }

    /**
     * Get fichas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFichas()
    {
        return $this->fichas;
    }
    
        public function __toString() {
        return $this->tipo;
    }
}
