<?php

namespace Costo\MaterialesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="material")
 * @ORM\Entity(repositoryClass="Costo\MaterialesBundle\Entity\materialRepository")}
 */
class material {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", name="codigo", length=10)
     */
    protected $codigo;

    /**
     * @ORM\Column(type="string", name="unidad_medida", length=50)
     */
    protected $unidad_medida;

    /**
     * @ORM\Column(type="string", name="fabricante", length=50)
     */
    protected $fabricante;

    /**
     * @ORM\Column(type="text", name="descripcion")
     */
    protected $descripcion;

    /**
     * @ORM\Column(type="boolean", name="precio_10_porciento", nullable=true)
     */
    protected $precio_10_porciento;

    /**
     * @ORM\Column(type="integer", name="cantidad_inventario", nullable=true)
     */
    protected $cantidad_inventario;

    /**
     * @ORM\Column(type="integer", name="cantidad_compra", nullable=true)
     */
    protected $cantidad_compra;

    /**
     * @ORM\Column(type="integer", name="cantidad_contrato", nullable=true)
     */
    protected $cantidad_contrato;

    /**
     * @ORM\Column(type="integer", name="cantidad_oferta", nullable=true)
     */
    protected $cantidad_oferta;

    /**
     * @ORM\Column(type="integer", name="cantidad_disponible", nullable=true)
     */
    protected $cantidad_disponible;

    /**
     * @ORM\ManyToOne(targetEntity="subcategoria", inversedBy="materiales")
     * @ORM\JoinColumn(name="subcategoria_id", referencedColumnName="id")
     */
    protected $subcategoria;

    /**
     * @ORM\OneToMany(targetEntity="precio", mappedBy="material")
     */
    protected $precios;

    /**
     * @ORM\OneToMany(targetEntity="costo", mappedBy="material")
     */
    protected $costos;

    /**
     * @ORM\OneToMany(targetEntity="Costo\OfertaBundle\Entity\SitioMaterial", mappedBy="material")
     */
    private $sitio_material;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set codigo
     *
     * @param string $codigo
     * @return material
     */
    public function setCodigo($codigo) {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string 
     */
    public function getCodigo() {
        return $this->codigo;
    }

    /**
     * Set unidad_medida
     *
     * @param string $unidadMedida
     * @return material
     */
    public function setUnidadMedida($unidadMedida) {
        $this->unidad_medida = $unidadMedida;

        return $this;
    }

    /**
     * Get unidad_medida
     *
     * @return string 
     */
    public function getUnidadMedida() {
        return $this->unidad_medida;
    }

    /**
     * Set fabricante
     *
     * @param string $fabricante
     * @return material
     */
    public function setFabricante($fabricante) {
        $this->fabricante = $fabricante;

        return $this;
    }

    /**
     * Get fabricante
     *
     * @return string 
     */
    public function getFabricante() {
        return $this->fabricante;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return material
     */
    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion() {
        return $this->descripcion;
    }

    /**
     * Set precio_10_porciento
     *
     * @param boolean $precio10Porciento
     * @return material
     */
    public function setPrecio10Porciento($precio10Porciento) {
        $this->precio_10_porciento = $precio10Porciento;

        return $this;
    }

    /**
     * Get precio_10_porciento
     *
     * @return boolean 
     */
    public function getPrecio10Porciento() {
        return $this->precio_10_porciento;
    }

    /**
     * Set cantidad_inventario
     *
     * @param integer $cantidadInventario
     * @return material
     */
    public function setCantidadInventario($cantidadInventario) {
        $this->cantidad_inventario = $cantidadInventario;

        return $this;
    }

    /**
     * Get cantidad_inventario
     *
     * @return integer 
     */
    public function getCantidadInventario() {
        return $this->cantidad_inventario;
    }

    /**
     * Set cantidad_compra
     *
     * @param integer $cantidadCompra
     * @return material
     */
    public function setCantidadCompra($cantidadCompra) {
        $this->cantidad_compra = $cantidadCompra;

        return $this;
    }

    /**
     * Get cantidad_compra
     *
     * @return integer 
     */
    public function getCantidadCompra() {
        return $this->cantidad_compra;
    }

    /**
     * Set cantidad_contrato
     *
     * @param integer $cantidadContrato
     * @return material
     */
    public function setCantidadContrato($cantidadContrato) {
        $this->cantidad_contrato = $cantidadContrato;

        return $this;
    }

    /**
     * Get cantidad_contrato
     *
     * @return integer 
     */
    public function getCantidadContrato() {
        return $this->cantidad_contrato;
    }

    /**
     * Set cantidad_oferta
     *
     * @param integer $cantidadOferta
     * @return material
     */
    public function setCantidadOferta($cantidadOferta) {
        $this->cantidad_oferta = $cantidadOferta;

        return $this;
    }

    /**
     * Get cantidad_oferta
     *
     * @return integer 
     */
    public function getCantidadOferta() {
        return $this->cantidad_oferta;
    }

    /**
     * Set cantidad_disponible
     *
     * @param integer $cantidadDisponible
     * @return material
     */
    public function setCantidadDisponible($cantidadDisponible) {
        $this->cantidad_disponible = $cantidadDisponible;

        return $this;
    }

    /**
     * Get cantidad_disponible
     *
     * @return integer 
     */
    public function getCantidadDisponible() {
        return $this->cantidad_disponible;
    }

    /**
     * Set subcategoria
     *
     * @param \Costo\MaterialesBundle\Entity\subcategoria $subcategoria
     * @return material
     */
    public function setSubcategoria(\Costo\MaterialesBundle\Entity\subcategoria $subcategoria = null) {
        $this->subcategoria = $subcategoria;

        return $this;
    }

    /**
     * Get subcategoria
     *
     * @return \Costo\MaterialesBundle\Entity\subcategoria 
     */
    public function getSubcategoria() {
        return $this->subcategoria;
    }

    /**
     * Add precios
     *
     * @param \Costo\MaterialesBundle\Entity\precio $precios
     * @return material
     */
    public function addPrecio(\Costo\MaterialesBundle\Entity\precio $precios) {
        $this->precios[] = $precios;

        return $this;
    }

    /**
     * Remove precios
     *
     * @param \Costo\MaterialesBundle\Entity\precio $precios
     */
    public function removePrecio(\Costo\MaterialesBundle\Entity\precio $precios) {
        $this->precios->removeElement($precios);
    }

    /**
     * Get precios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPrecios() {
        return $this->precios;
    }

    /**
     * Add costos
     *
     * @param \Costo\MaterialesBundle\Entity\costo $costos
     * @return material
     */
    public function addCosto(\Costo\MaterialesBundle\Entity\costo $costos) {
        $this->costos[] = $costos;

        return $this;
    }

    /**
     * Remove costos
     *
     * @param \Costo\MaterialesBundle\Entity\costo $costos
     */
    public function removeCosto(\Costo\MaterialesBundle\Entity\costo $costos) {
        $this->costos->removeElement($costos);
    }

    /**
     * Get costos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCostos() {
        return $this->costos;
    }


    /**
     * Add sitio_material
     *
     * @param \Costo\OfertaBundle\Entity\SitioMaterial $sitioMaterial
     * @return material
     */
    public function addSitioMaterial(\Costo\OfertaBundle\Entity\SitioMaterial $sitioMaterial) {
        $this->sitio_material[] = $sitioMaterial;

        return $this;
    }

    /**
     * Remove sitio_material
     *
     * @param \Costo\OfertaBundle\Entity\SitioMaterial $sitioMaterial
     */
    public function removeSitioMaterial(\Costo\OfertaBundle\Entity\SitioMaterial $sitioMaterial) {
        $this->sitio_material->removeElement($sitioMaterial);
    }

    /**
     * Get sitio_material
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSitioMaterial() {
        return $this->sitio_material;
    }



    public function __toString() {
        return $this->descripcion;
    }

 
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->precios = new \Doctrine\Common\Collections\ArrayCollection();
        $this->costos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sitio_material = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
