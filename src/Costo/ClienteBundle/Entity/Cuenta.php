<?php

namespace Costo\ClienteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cuenta
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Costo\ClienteBundle\Entity\CuentaRepository")
 */
class Cuenta
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
     * @ORM\Column(name="numero", type="string", length=20)
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="banco", type="string", length=120)
     */
    private $banco;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="text")
     */
    private $direccion;


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
     * Set numero
     *
     * @param string $numero
     * @return Cuenta
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set banco
     *
     * @param string $banco
     * @return Cuenta
     */
    public function setBanco($banco)
    {
        $this->banco = $banco;

        return $this;
    }

    /**
     * Get banco
     *
     * @return string 
     */
    public function getBanco()
    {
        return $this->banco;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Cuenta
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }
    
    /**
     * @ORM\ManyToOne(targetEntity="Ficha", inversedBy="cuentas")
     * @ORM\JoinColumn(name="ficha_id", referencedColumnName="id")
     * @return integer
     */
    private $ficha;
    
    /**
     * @ORM\ManyToOne(targetEntity="Costo\MaterialesBundle\Entity\moneda", inversedBy="cuentas")
     * @ORM\JoinColumn(name="moneda_id", referencedColumnName="id")
     */
    protected $moneda; 

    /**
     * Set ficha
     *
     * @param \Costo\ClienteBundle\Entity\Ficha $ficha
     * @return Cuenta
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
     * Set moneda
     *
     * @param \Costo\MaterialesBundle\Entity\moneda $moneda
     * @return Cuenta
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
}
