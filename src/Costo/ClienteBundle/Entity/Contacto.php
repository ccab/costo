<?php

namespace Costo\ClienteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contacto
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Costo\ClienteBundle\Entity\ContactoRepository")
 */
class Contacto
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
     * @ORM\Column(name="telefono", type="string", length=60)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="nacionalidad", type="string", length=100)
     */
    private $nacionalidad;

    /**
     * @var string
     *
     * @ORM\Column(name="pasaporte", type="string", length=15)
     */
    private $pasaporte;

    /**
     * @var string
     *
     * @ORM\Column(name="web", type="string", length=255)
     */
    private $web;

    /**
    * @ORM\ManyToOne(targetEntity="Costo\UsersBundle\Entity\Area", inversedBy="contactos")
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
     * @return Contacto
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
     * @return Contacto
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
     * Set telefono
     *
     * @param string $telefono
     * @return Contacto
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Contacto
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set nacionalidad
     *
     * @param string $nacionalidad
     * @return Contacto
     */
    public function setNacionalidad($nacionalidad)
    {
        $this->nacionalidad = $nacionalidad;

        return $this;
    }

    /**
     * Get nacionalidad
     *
     * @return string 
     */
    public function getNacionalidad()
    {
        return $this->nacionalidad;
    }

    /**
     * Set pasaporte
     *
     * @param string $pasaporte
     * @return Contacto
     */
    public function setPasaporte($pasaporte)
    {
        $this->pasaporte = $pasaporte;

        return $this;
    }

    /**
     * Get pasaporte
     *
     * @return string 
     */
    public function getPasaporte()
    {
        return $this->pasaporte;
    }

    /**
     * Set web
     *
     * @param string $web
     * @return Contacto
     */
    public function setWeb($web)
    {
        $this->web = $web;

        return $this;
    }

    /**
     * Get web
     *
     * @return string 
     */
    public function getWeb()
    {
        return $this->web;
    }

        
    /**
     * @ORM\ManyToOne(targetEntity="Ficha", inversedBy="contactos")
     * @ORM\JoinColumn(name="ficha_id", referencedColumnName="id")
     * @return integer
     */
    private $ficha;
    

    /**
     * Set ficha
     *
     * @param \Costo\ClienteBundle\Entity\Ficha $ficha
     * @return Contacto
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

    /**
     * Set area
     *
     * @param \Costo\UsersBundle\Entity\Area $area
     * @return Contacto
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
