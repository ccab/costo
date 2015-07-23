<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Provincia
 *
 * @ORM\Table()
 * @ORM\Entity
 * 
 * Listado de Provincias:
    Pinar del Río
    Artemisa
    La Habana
    Mayabeque
    Matanzas
    Cienfuegos
    Villa Clara
    Sancti Spíritus
    Ciego de Ávila
    Camagüey
    Las Tunas
    Granma
    Holguín
    Santiago de Cuba
    Guantánamo
 */
class Provincia {

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
     * @ORM\Column(name="nombre", type="string", length=100)
     */
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity="ContratoDieta", mappedBy="provincia")
     */
    private $contratoDietas;

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
     *
     * @return Provincia
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
     * Constructor
     */
    public function __construct() {
        $this->dietas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add dieta
     *
     * @param \AppBundle\Entity\Dieta $dieta
     *
     * @return Provincia
     */
    public function addDieta(\AppBundle\Entity\Dieta $dieta) {
        $this->dietas[] = $dieta;

        return $this;
    }

    /**
     * Remove dieta
     *
     * @param \AppBundle\Entity\Dieta $dieta
     */
    public function removeDieta(\AppBundle\Entity\Dieta $dieta) {
        $this->dietas->removeElement($dieta);
    }

    /**
     * Get dietas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDietas() {
        return $this->dietas;
    }

    public function __toString() {
        return $this->nombre;
    }


    /**
     * Add contratoDieta
     *
     * @param \AppBundle\Entity\ContratoDieta $contratoDieta
     *
     * @return Provincia
     */
    public function addContratoDieta(\AppBundle\Entity\ContratoDieta $contratoDieta)
    {
        $this->contratoDietas[] = $contratoDieta;

        return $this;
    }

    /**
     * Remove contratoDieta
     *
     * @param \AppBundle\Entity\ContratoDieta $contratoDieta
     */
    public function removeContratoDieta(\AppBundle\Entity\ContratoDieta $contratoDieta)
    {
        $this->contratoDietas->removeElement($contratoDieta);
    }

    /**
     * Get contratoDietas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContratoDietas()
    {
        return $this->contratoDietas;
    }
}
