<?php

namespace Costo\ClienteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ficha
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Costo\ClienteBundle\Entity\FichaRepository")
 */
class Ficha
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
     * @ORM\Column(name="direccion", type="text")
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="reeup", type="string", length=14)
     */
    private $reeup;

    /**
     * @var string
     *
     * @ORM\Column(name="nit", type="string", length=14)
     */
    private $nit;

    /**
     * @var string
     *
     * @ORM\Column(name="reg_comercial", type="string", length=14, nullable=true)
     */
    private $regComercial;

    /**
     * @var string
     *
     * @ORM\Column(name="reg_mercantil", type="string", length=20, nullable=true)
     */
    private $regMercantil;

    /**
     * @var string
     *
     * @ORM\Column(name="lic_divisas", type="string", length=20, nullable=true)
     */
    private $licDivisas;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_elabora", type="string", length=120, nullable=true)
     */
    private $nombreElabora;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_elaboracion", type="date", nullable=true)
     */
    private $fechaElaboracion;

    /**
     * @var string
     *
     * @ORM\Column(name="cargo", type="string", length=255, nullable=true)
     */
    private $cargo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="date", nullable=true)
     */
    private $fechaCreacion;
    
    /**
     * @ORM\OneToMany(targetEntity="Costo\OfertaBundle\Entity\Oferta", mappedBy="ficha_cliente")
     */
    private $ofertas;


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
     * @return Ficha
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
     * Set direccion
     *
     * @param string $direccion
     * @return Ficha
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
     * Set reeup
     *
     * @param string $reeup
     * @return Ficha
     */
    public function setReeup($reeup)
    {
        $this->reeup = $reeup;

        return $this;
    }

    /**
     * Get reeup
     *
     * @return string 
     */
    public function getReeup()
    {
        return $this->reeup;
    }

    /**
     * Set nit
     *
     * @param string $nit
     * @return Ficha
     */
    public function setNit($nit)
    {
        $this->nit = $nit;

        return $this;
    }

    /**
     * Get nit
     *
     * @return string 
     */
    public function getNit()
    {
        return $this->nit;
    }

    /**
     * Set regComercial
     *
     * @param string $regComercial
     * @return Ficha
     */
    public function setRegComercial($regComercial)
    {
        $this->regComercial = $regComercial;

        return $this;
    }

    /**
     * Get regComercial
     *
     * @return string 
     */
    public function getRegComercial()
    {
        return $this->regComercial;
    }

    /**
     * Set regMercantil
     *
     * @param string $regMercantil
     * @return Ficha
     */
    public function setRegMercantil($regMercantil)
    {
        $this->regMercantil = $regMercantil;

        return $this;
    }

    /**
     * Get regMercantil
     *
     * @return string 
     */
    public function getRegMercantil()
    {
        return $this->regMercantil;
    }

    /**
     * Set licDivisas
     *
     * @param string $licDivisas
     * @return Ficha
     */
    public function setLicDivisas($licDivisas)
    {
        $this->licDivisas = $licDivisas;

        return $this;
    }

    /**
     * Get licDivisas
     *
     * @return string 
     */
    public function getLicDivisas()
    {
        return $this->licDivisas;
    }

    /**
     * Set nombreElabora
     *
     * @param string $nombreElabora
     * @return Ficha
     */
    public function setNombreElabora($nombreElabora)
    {
        $this->nombreElabora = $nombreElabora;

        return $this;
    }

    /**
     * Get nombreElabora
     *
     * @return string 
     */
    public function getNombreElabora()
    {
        return $this->nombreElabora;
    }

    /**
     * Set fechaElaboracion
     *
     * @param \DateTime $fechaElaboracion
     * @return Ficha
     */
    public function setFechaElaboracion($fechaElaboracion)
    {
        $this->fechaElaboracion = $fechaElaboracion;

        return $this;
    }

    /**
     * Get fechaElaboracion
     *
     * @return \DateTime 
     */
    public function getFechaElaboracion()
    {
        return $this->fechaElaboracion;
    }

    /**
     * Set cargo
     *
     * @param string $cargo
     * @return Ficha
     */
    public function setCargo($cargo)
    {
        $this->cargo = $cargo;

        return $this;
    }

    /**
     * Get cargo
     *
     * @return string 
     */
    public function getCargo()
    {
        return $this->cargo;
    }
    
        /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return Ficha
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime 
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }
    
    /**
     * @ORM\OneToMany(targetEntity="Cuenta", mappedBy="ficha", cascade={"persist"})
     */
    private $cuentas;
    
    /**
     * @ORM\OneToMany(targetEntity="Contacto", mappedBy="ficha", cascade={"persist"})
     */
    private $contactos;
    
    /**
     * @ORM\OneToMany(targetEntity="Autorizado", mappedBy="ficha", cascade={"persist"})
     */
    private $autorizados;
    
    /**
     * @ORM\OneToMany(targetEntity="Directivo", mappedBy="ficha", cascade={"persist"})
     */
    private $directivos;
    
    /**
     * @ORM\OneToMany(targetEntity="Documento", mappedBy="ficha")
     */
    private $documentos;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="Ministerio", inversedBy="fichas")
     * @ORM\JoinColumn(name="ministerio_id", referencedColumnName="id")
     * @return integer
     */
    private $ministerio;
    
    /**
     * @ORM\ManyToOne(targetEntity="TipoEmpresa", inversedBy="fichas")
     * @ORM\JoinColumn(name="tipoempresa_id", referencedColumnName="id")
     * @return integer
     */
    private $tipoempresa;
    
    //arreglar el mapeo
    /**
     * @ORM\ManyToOne(targetEntity="Costo\UsersBundle\Entity\User", inversedBy="fichas")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * @return integer
     */
    private $usuario;


    /**
     * Add cuenta
     *
     * @param \Costo\ClienteBundle\Entity\Cuenta $cuenta
     * @return Ficha
     */
    public function addCuenta(\Costo\ClienteBundle\Entity\Cuenta $cuenta)
    {
        $cuenta->setFicha($this);
        
        $this->cuentas->add($cuenta);

        return $this;
    }

    /**
     * Remove cuenta
     *
     * @param \Costo\ClienteBundle\Entity\Cuenta $cuenta
     */
    public function removeCuenta(\Costo\ClienteBundle\Entity\Cuenta $cuenta)
    {
        $this->cuentas->removeElement($cuenta);
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

    /**
     * Add contacto
     *
     * @param \Costo\ClienteBundle\Entity\Contacto $contacto
     * @return Ficha
     */
    public function addContacto(\Costo\ClienteBundle\Entity\Contacto $contacto)
    {
        $contacto->setFicha($this);
        
        $this->contactos->add($contacto);

        return $this;
    }

    /**
     * Remove contacto
     *
     * @param \Costo\ClienteBundle\Entity\Contacto $contacto
     */
    public function removeContacto(\Costo\ClienteBundle\Entity\Contacto $contacto)
    {
        $this->contactos->removeElement($contacto);
    }

    /**
     * Get contactos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getContactos()
    {
        return $this->contactos;
    }

    /**
     * Add autorizado
     *
     * @param \Costo\ClienteBundle\Entity\Autorizado $autorizado
     * @return Ficha
     */
    public function addAutorizado(\Costo\ClienteBundle\Entity\Autorizado $autorizado)
    {
        $autorizado->setFicha($this);
        
        $this->autorizados->add($autorizado);

        return $this;
    }

    /**
     * Remove autorizado
     *
     * @param \Costo\ClienteBundle\Entity\Autorizado $autorizado
     */
    public function removeAutorizado(\Costo\ClienteBundle\Entity\Autorizado $autorizado)
    {
        $this->autorizados->removeElement($autorizado);
    }

    /**
     * Get autorizados
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAutorizados()
    {
        return $this->autorizados;
    }

    /**
     * Add directivo
     *
     * @param \Costo\ClienteBundle\Entity\Directivo $directivo
     * @return Ficha
     */
    public function addDirectivo(\Costo\ClienteBundle\Entity\Directivo $directivo)
    {
        $directivo->setFicha($this);
        
        $this->directivos->add($directivo);

        return $this;
    }

    /**
     * Remove directivos
     *
     * @param \Costo\ClienteBundle\Entity\Directivo $directivos
     */
    public function removeDirectivo(\Costo\ClienteBundle\Entity\Directivo $directivos)
    {
        $this->directivos->removeElement($directivos);
    }

    /**
     * Get directivos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDirectivos()
    {
        return $this->directivos;
    }

    /**
     * Add documentos
     *
     * @param \Costo\ClienteBundle\Entity\Documento $documentos
     * @return Ficha
     */
    public function addDocumento(\Costo\ClienteBundle\Entity\Documento $documentos)
    {
        $this->documentos[] = $documentos;

        return $this;
    }

    /**
     * Remove documentos
     *
     * @param \Costo\ClienteBundle\Entity\Documento $documentos
     */
    public function removeDocumento(\Costo\ClienteBundle\Entity\Documento $documentos)
    {
        $this->documentos->removeElement($documentos);
    }

    /**
     * Get documentos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDocumentos()
    {
        return $this->documentos;
    }

    /**
     * Set ministerio
     *
     * @param \Costo\ClienteBundle\Entity\Ministerio $ministerio
     * @return Ficha
     */
    public function setMinisterio(\Costo\ClienteBundle\Entity\Ministerio $ministerio = null)
    {
        $this->ministerio = $ministerio;

        return $this;
    }

    /**
     * Get ministerio
     *
     * @return \Costo\ClienteBundle\Entity\Ministerio 
     */
    public function getMinisterio()
    {
        return $this->ministerio;
    }
    
    /**
     * Set tipoempresa
     *
     * @param \Costo\ClienteBundle\Entity\TipoEmpresa $tipoempresa
     * @return Ficha
     */
    public function setTipoempresa(\Costo\ClienteBundle\Entity\TipoEmpresa $tipoempresa = null)
    {
        $this->tipoempresa = $tipoempresa;

        return $this;
    }

    /**
     * Get tipoempresa
     *
     * @return \Costo\ClienteBundle\Entity\TipoEmpresa 
     */
    public function getTipoempresa()
    {
        return $this->tipoempresa;
    }
    
    public function __toString() {
        return $this->nombre;
    }
        

    /**
     * Set usuario
     *
     * @param \Costo\UsersBundle\Entity\User $usuario
     * @return Ficha
     */
    public function setUsuario(\Costo\UsersBundle\Entity\User $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \Costo\UsersBundle\Entity\User 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ofertas = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cuentas = new \Doctrine\Common\Collections\ArrayCollection();
        $this->contactos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->autorizados = new \Doctrine\Common\Collections\ArrayCollection();
        $this->directivos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->documentos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add ofertas
     *
     * @param \Costo\OfertaBundle\Entity\Oferta $ofertas
     * @return Ficha
     */
    public function addOferta(\Costo\OfertaBundle\Entity\Oferta $ofertas)
    {
        $this->ofertas[] = $ofertas;

        return $this;
    }

    /**
     * Remove ofertas
     *
     * @param \Costo\OfertaBundle\Entity\Oferta $ofertas
     */
    public function removeOferta(\Costo\OfertaBundle\Entity\Oferta $ofertas)
    {
        $this->ofertas->removeElement($ofertas);
    }

    /**
     * Get ofertas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOfertas()
    {
        return $this->ofertas;
    }
}
