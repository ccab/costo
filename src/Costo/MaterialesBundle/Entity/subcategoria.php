<?php

namespace Costo\MaterialesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="subcategoria")
 * @ORM\Entity(repositoryClass="Costo\MaterialesBundle\Entity\subcategoriaRepository")}
 */
class subcategoria {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", name="nombre", length=255, unique=true)
     */
    protected $nombre;
    
    /**
     * @ORM\Column(type="string", name="tipo", length=255)
     */
    protected $tipo;

    /**
     * @ORM\OneToMany(targetEntity="Costo\MaterialesBundle\Entity\material", mappedBy="subcategoria")
     */
    protected $materiales;
    
    /**
     * @ORM\OneToMany(targetEntity="Costo\ServicioBundle\Entity\Servicio", mappedBy="subcategoria")
     */
    protected $servicios;

    /**
     * @ORM\OneToMany(targetEntity="subcategoria", mappedBy="subcategoria_padre")
     */
    protected $subcategoria_hijo;

    /**
     * @ORM\ManyToOne(targetEntity="subcategoria", inversedBy="subcategoria_hijo")
     * @ORM\JoinColumn(name="categoria_id", referencedColumnName="id")
     */
    protected $subcategoria_padre;
    
    /**
     * @ORM\ManyToMany(targetEntity="Costo\OfertaBundle\Entity\Oferta", mappedBy="categorias")
     **/
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
     * @return subcategoria
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
     * Add materiales
     *
     * @param \Costo\MaterialesBundle\Entity\Material $materiales
     * @return subcategoria
     */
    public function addMateriale(\Costo\MaterialesBundle\Entity\Material $materiales)
    {
        $this->materiales[] = $materiales;

        return $this;
    }

    /**
     * Remove materiales
     *
     * @param \Costo\MaterialesBundle\Entity\Material $materiales
     */
    public function removeMateriale(\Costo\MaterialesBundle\Entity\Material $materiales)
    {
        $this->materiales->removeElement($materiales);
    }

    /**
     * Get materiales
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMateriales()
    {
        return $this->materiales;
    }

    /**
     * Add subcategoria_hijo
     *
     * @param \Costo\MaterialesBundle\Entity\subcategoria $subcategoriaHijo
     * @return subcategoria
     */
    public function addSubcategoriaHijo(\Costo\MaterialesBundle\Entity\subcategoria $subcategoriaHijo)
    {
        $this->subcategoria_hijo[] = $subcategoriaHijo;

        return $this;
    }

    /**
     * Remove subcategoria_hijo
     *
     * @param \Costo\MaterialesBundle\Entity\subcategoria $subcategoriaHijo
     */
    public function removeSubcategoriaHijo(\Costo\MaterialesBundle\Entity\subcategoria $subcategoriaHijo)
    {
        $this->subcategoria_hijo->removeElement($subcategoriaHijo);
    }

    /**
     * Get subcategoria_hijo
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSubcategoriaHijo()
    {
        return $this->subcategoria_hijo;
    }

    /**
     * Set subcategoria_padre
     *
     * @param \Costo\MaterialesBundle\Entity\subcategoria $subcategoriaPadre
     * @return subcategoria
     */
    public function setSubcategoriaPadre(\Costo\MaterialesBundle\Entity\subcategoria $subcategoriaPadre = null)
    {
        $this->subcategoria_padre = $subcategoriaPadre;

        return $this;
    }

    /**
     * Get subcategoria_padre
     *
     * @return \Costo\MaterialesBundle\Entity\subcategoria 
     */
    public function getSubcategoriaPadre()
    {
        return $this->subcategoria_padre;
    }

    /**
     * Add servicios
     *
     * @param \Costo\ServicioBundle\Entity\Servicio $servicios
     * @return subcategoria
     */
    public function addServicio(\Costo\ServicioBundle\Entity\Servicio $servicios)
    {
        $this->servicios[] = $servicios;

        return $this;
    }

    /**
     * Remove servicios
     *
     * @param \Costo\ServicioBundle\Entity\Servicio $servicios
     */
    public function removeServicio(\Costo\ServicioBundle\Entity\Servicio $servicios)
    {
        $this->servicios->removeElement($servicios);
    }

    /**
     * Get servicios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getServicios()
    {
        return $this->servicios;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->materiales = new \Doctrine\Common\Collections\ArrayCollection();
        $this->servicios = new \Doctrine\Common\Collections\ArrayCollection();
        $this->subcategoria_hijo = new \Doctrine\Common\Collections\ArrayCollection();
        $this->ofertas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add ofertas
     *
     * @param \Costo\OfertaBundle\Entity\Oferta $ofertas
     * @return subcategoria
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
    
    public function __toString() {
        return $this->nombre;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     * @return subcategoria
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
}
