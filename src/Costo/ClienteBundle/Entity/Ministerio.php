<?php

namespace Costo\ClienteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ministerio
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Ministerio {

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
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=60)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="text")
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="ministro", type="string", length=120)
     */
    private $ministro;

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
     * @return Ministerio
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
     * Set telefono
     *
     * @param string $telefono
     * @return Ministerio
     */
    public function setTelefono($telefono) {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono() {
        return $this->telefono;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Ministerio
     */
    public function setDireccion($direccion) {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion() {
        return $this->direccion;
    }

    /**
     * Set ministro
     *
     * @param string $ministro
     * @return Ministerio
     */
    public function setMinistro($ministro) {
        $this->ministro = $ministro;

        return $this;
    }

    /**
     * Get ministro
     *
     * @return string 
     */
    public function getMinistro() {
        return $this->ministro;
    }

    /**
     * @ORM\OneToMany(targetEntity="Ficha", mappedBy="ministerio")
     */
    private $fichas;

    public function __construct() {
        $this->fichas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add fichas
     *
     * @param \Costo\ClienteBundle\Entity\Ficha $fichas
     * @return Ministerio
     */
    public function addFicha(\Costo\ClienteBundle\Entity\Ficha $fichas) {
        $this->fichas[] = $fichas;

        return $this;
    }

    /**
     * Remove fichas
     *
     * @param \Costo\ClienteBundle\Entity\Ficha $fichas
     */
    public function removeFicha(\Costo\ClienteBundle\Entity\Ficha $fichas) {
        $this->fichas->removeElement($fichas);
    }

    /**
     * Get fichas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFichas() {
        return $this->fichas;
    }

    public function __toString() {
        return $this->nombre;
    }

}
