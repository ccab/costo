<?php

namespace Costo\ClienteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Directivo
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Costo\ClienteBundle\Entity\DirectivoRepository")
 */
class Directivo
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
     * @ORM\Column(name="telefono", type="string", length=60)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=50)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;


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
     * @return Directivo
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
     * Set tipo
     *
     * @param string $tipo
     * @return Directivo
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
     * Set email
     *
     * @param string $email
     * @return Directivo
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
     * @ORM\ManyToOne(targetEntity="Ficha", inversedBy="directivos")
     * @ORM\JoinColumn(name="ficha_id", referencedColumnName="id")
     * @return integer
     */
    private $ficha;

    /**
     * Set ficha
     *
     * @param \Costo\ClienteBundle\Entity\Ficha $ficha
     * @return Directivo
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
     * Set telefono
     *
     * @param string $telefono
     * @return Directivo
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
}
