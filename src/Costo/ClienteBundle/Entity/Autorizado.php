<?php

namespace Costo\ClienteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Autorizado
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Costo\ClienteBundle\Entity\AutorizadoRepository")
 */
class Autorizado
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
     * @ORM\Column(name="nombre", type="string", length=120)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="ci", type="string", length=11)
     */
    private $ci;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion", type="text")
     */
    private $observacion;
    
    /**
    * @ORM\ManyToOne(targetEntity="Costo\UsersBundle\Entity\Area", inversedBy="autorizados")
    * @ORM\JoinColumn(name="area_id", referencedColumnName="id")
    */
    protected $area;


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
     * @return Autorizado
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
     * Set ci
     *
     * @param string $ci
     * @return Autorizado
     */
    public function setCi($ci)
    {
        $this->ci = $ci;

        return $this;
    }

    /**
     * Get ci
     *
     * @return string 
     */
    public function getCi()
    {
        return $this->ci;
    }

    /**
     * Set observacion
     *
     * @param string $observacion
     * @return Autorizado
     */
    public function setObservacion($observacion)
    {
        $this->observacion = $observacion;

        return $this;
    }

    /**
     * Get observacion
     *
     * @return string 
     */
    public function getObservacion()
    {
        return $this->observacion;
    }
    
    /**
     * @ORM\ManyToOne(targetEntity="Ficha", inversedBy="autorizados")
     * @ORM\JoinColumn(name="ficha_id", referencedColumnName="id")
     * @return integer
     */
    private $ficha;

    /**
     * Set ficha
     *
     * @param \Costo\ClienteBundle\Entity\Ficha $ficha
     * @return Autorizado
     */
    public function setFicha(\Costo\ClienteBundle\Entity\Ficha $ficha = null)
    {
        $this->ficha = $ficha;

        return $this;
    }

    /**
     * Get ficha
     *
     * @return \Costo\ClienteBundle\Entity\Ficha 
     */
    public function getFicha()
    {
        return $this->ficha;
    }
    
    public function __toString() {
        return $this->nombre;
    }


    /**
     * Set area
     *
     * @param \Costo\UsersBundle\Entity\Area $area
     * @return Autorizado
     */
    public function setArea(\Costo\UsersBundle\Entity\Area $area = null)
    {
        $this->area = $area;

        return $this;
    }

    /**
     * Get area
     *
     * @return \Costo\UsersBundle\Entity\Area 
     */
    public function getArea()
    {
        return $this->area;
    }
}
