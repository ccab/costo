<?php

namespace Costo\UsersBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Area
 *
 * @ORM\Table(name="areas")
 * @ORM\Entity
 */
class Area {

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
     * @ORM\Column(name="nombre", type="string", length=50)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_grupo_dc", type="string", length=50)
     */
    private $nombre_grupo_dc;

    /**
     * @ORM\OneToMany(targetEntity="Costo\ServicioBundle\Entity\Servicio", mappedBy="area")
     */
    protected $servicios;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="area")
     */
    protected $users;
    
    /**
     * @ORM\OneToMany(targetEntity="Costo\ClienteBundle\Entity\Contacto", mappedBy="area")
     */
    protected $contactos;
    
    /**
     * @ORM\OneToMany(targetEntity="Costo\ClienteBundle\Entity\Autorizado", mappedBy="area")
     */
    protected $autorizados;
    
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Dieta", mappedBy="areaBeneficiario")
     */
    protected $dietas;

  

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
     * @return Area
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
     * Add users
     *
     * @param User $users
     * @return Area
     */
    public function addUser(User $users) {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param User $users
     */
    public function removeUser(User $users) {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers() {
        return $this->users;
    }

    /**
     * Add servicios
     *
     * @param \Costo\UsersBundle\Entity\User $servicios
     * @return Area
     */
    public function addServicio(\Costo\UsersBundle\Entity\User $servicios) {
        $this->servicios[] = $servicios;

        return $this;
    }

    /**
     * Remove servicios
     *
     * @param \Costo\UsersBundle\Entity\User $servicios
     */
    public function removeServicio(\Costo\UsersBundle\Entity\User $servicios) {
        $this->servicios->removeElement($servicios);
    }

    /**
     * Get servicios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getServicios() {
        return $this->servicios;
    }

    public function __toString() {
        return $this->nombre;
    }


    /**
     * Set nombre_grupo_dc
     *
     * @param string $nombreGrupoDc
     * @return Area
     */
    public function setNombreGrupoDc($nombreGrupoDc)
    {
        $this->nombre_grupo_dc = $nombreGrupoDc;

        return $this;
    }

    /**
     * Get nombre_grupo_dc
     *
     * @return string 
     */
    public function getNombreGrupoDc()
    {
        return $this->nombre_grupo_dc;
    }

    /**
     * Add contactos
     *
     * @param \Costo\ClienteBundle\Entity\Contacto $contactos
     * @return Area
     */
    public function addContacto(\Costo\ClienteBundle\Entity\Contacto $contactos)
    {
        $this->contactos[] = $contactos;

        return $this;
    }

    /**
     * Remove contactos
     *
     * @param \Costo\ClienteBundle\Entity\Contacto $contactos
     */
    public function removeContacto(\Costo\ClienteBundle\Entity\Contacto $contactos)
    {
        $this->contactos->removeElement($contactos);
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
     * Add autorizados
     *
     * @param \Costo\ClienteBundle\Entity\Autorizado $autorizados
     * @return Area
     */
    public function addAutorizado(\Costo\ClienteBundle\Entity\Autorizado $autorizados)
    {
        $this->autorizados[] = $autorizados;

        return $this;
    }

    /**
     * Remove autorizados
     *
     * @param \Costo\ClienteBundle\Entity\Autorizado $autorizados
     */
    public function removeAutorizado(\Costo\ClienteBundle\Entity\Autorizado $autorizados)
    {
        $this->autorizados->removeElement($autorizados);
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
     * Add dieta
     *
     * @param \AppBundle\Entity\Dieta $dieta
     *
     * @return Area
     */
    public function addDieta(\AppBundle\Entity\Dieta $dieta)
    {
        $this->dietas[] = $dieta;

        return $this;
    }

    /**
     * Remove dieta
     *
     * @param \AppBundle\Entity\Dieta $dieta
     */
    public function removeDieta(\AppBundle\Entity\Dieta $dieta)
    {
        $this->dietas->removeElement($dieta);
    }

    /**
     * Get dietas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDietas()
    {
        return $this->dietas;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->servicios = new \Doctrine\Common\Collections\ArrayCollection();
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
        $this->contactos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->autorizados = new \Doctrine\Common\Collections\ArrayCollection();
        $this->dietas = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
