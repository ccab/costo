<?php

namespace Costo\ServicioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Servicio
 *
 * @ORM\Table(name="servicios")
 * @ORM\Entity(repositoryClass="Costo\ServicioBundle\Entity\ServicioRepository")
 */
class Servicio
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
     * @ORM\Column(name="nombre", type="string", length=50)
     */
    private $nombre;

    /**
    * @ORM\ManyToOne(targetEntity="Costo\UsersBundle\Entity\Area", inversedBy="servicios")
    * @ORM\JoinColumn(name="area_id", referencedColumnName="id")
    */
    protected $area;
    
    /**
    * @ORM\ManyToOne(targetEntity="Proceso", inversedBy="servicios")
    * @ORM\JoinColumn(name="proceso_id", referencedColumnName="id")
    */
    protected $proceso;
    
    /**
    * @ORM\ManyToOne(targetEntity="Costo\MaterialesBundle\Entity\subcategoria", inversedBy="servicios")
    * @ORM\JoinColumn(name="subcategoria_id", referencedColumnName="id")
    */
    protected $subcategoria;
    
    /**
     * @ORM\OneToMany(targetEntity="Costo\OfertaBundle\Entity\SitioServicio", mappedBy="servicio")
     */
    private $sitio_servicio;
    
    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=50, nullable=true)
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="unidad", type="string", length=25)
     */
    private $unidad;

    /**
     * @var float
     *
     * @ORM\Column(name="salario", type="float", nullable=true)
     */
    private $salario;

    /**
     * @var float
     *
     * @ORM\Column(name="precio_unit_cuc", type="float", nullable=true)
     */
    private $precio_unit_cuc;
    
    /**
     * @var float
     *
     * @ORM\Column(name="precio_unit_cup", type="float", nullable=true)
     */
    private $precio_unit_cup;
    
    /**
     * @var float
     *
     * @ORM\Column(name="deprec_cuc", type="float", nullable=true)
     */
    private $deprec_cuc;
    
    /**
     * @var float
     *
     * @ORM\Column(name="deprec_cup", type="float", nullable=true)
     */
    private $deprec_cup;
    
    /**
     * @var float
     *
     * @ORM\Column(name="alojamiento_cuc", type="float", nullable=true)
     */
    private $alojamiento_cuc;

    /**
     * @var float
     *
     * @ORM\Column(name="alojamiento_cup", type="float", nullable=true)
     */
    private $alojamiento_cup;

    /**
     * @var float
     *
     * @ORM\Column(name="dieta_cuc", type="float", nullable=true)
     */
    private $dieta_cuc;

    /**
     * @var float
     *
     * @ORM\Column(name="dieta_cup", type="float", nullable=true)
     */
    private $dieta_cup;

    /**
     * @var float
     *
     * @ORM\Column(name="mat_prim_cuc", type="float", nullable=true)
     */
    private $mat_prim_cuc;

    /**
     * @var float
     *
     * @ORM\Column(name="mat_prim_cup", type="float", nullable=true)
     */
    private $mat_prim_cup;

    /**
     * @var float
     *
     * @ORM\Column(name="portadores_cuc", type="float", nullable=true)
     */
    private $portadores_cuc;

    /**
     * @var float
     *
     * @ORM\Column(name="portadores_cup", type="float", nullable=true)
     */
    private $portadores_cup;

    /**
     * @var float
     *
     * @ORM\Column(name="arrend_cuc", type="float", nullable=true)
     */
    private $arrend_cuc;

    /**
     * @var float
     *
     * @ORM\Column(name="arrend_cup", type="float", nullable=true)
     */
    private $arrend_cup;


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
     * @return Servicio
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
     * Set codigo
     *
     * @param string $codigo
     * @return Servicio
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string 
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set unidad
     *
     * @param string $unidad
     * @return Servicio
     */
    public function setUnidad($unidad)
    {
        $this->unidad = $unidad;

        return $this;
    }

    /**
     * Get unidad
     *
     * @return string 
     */
    public function getUnidad()
    {
        return $this->unidad;
    }

    /**
     * Set salario
     *
     * @param float $salario
     * @return Servicio
     */
    public function setSalario($salario)
    {
        $this->salario = $salario;

        return $this;
    }

    /**
     * Get salario
     *
     * @return float 
     */
    public function getSalario()
    {
        return $this->salario;
    }

    /**
     * Set alojamiento_cuc
     *
     * @param float $alojamientoCuc
     * @return Servicio
     */
    public function setAlojamientoCuc($alojamientoCuc)
    {
        $this->alojamiento_cuc = $alojamientoCuc;

        return $this;
    }

    /**
     * Get alojamiento_cuc
     *
     * @return float 
     */
    public function getAlojamientoCuc()
    {
        return $this->alojamiento_cuc;
    }

    /**
     * Set alojamiento_cup
     *
     * @param float $alojamientoCup
     * @return Servicio
     */
    public function setAlojamientoCup($alojamientoCup)
    {
        $this->alojamiento_cup = $alojamientoCup;

        return $this;
    }

    /**
     * Get alojamiento_cup
     *
     * @return float 
     */
    public function getAlojamientoCup()
    {
        return $this->alojamiento_cup;
    }

    /**
     * Set dieta_cuc
     *
     * @param float $dietaCuc
     * @return Servicio
     */
    public function setDietaCuc($dietaCuc)
    {
        $this->dieta_cuc = $dietaCuc;

        return $this;
    }

    /**
     * Get dieta_cuc
     *
     * @return float 
     */
    public function getDietaCuc()
    {
        return $this->dieta_cuc;
    }

    /**
     * Set dieta_cup
     *
     * @param float $dietaCup
     * @return Servicio
     */
    public function setDietaCup($dietaCup)
    {
        $this->dieta_cup = $dietaCup;

        return $this;
    }

    /**
     * Get dieta_cup
     *
     * @return float 
     */
    public function getDietaCup()
    {
        return $this->dieta_cup;
    }

    /**
     * Set mat_prim_cuc
     *
     * @param float $matPrimCuc
     * @return Servicio
     */
    public function setMatPrimCuc($matPrimCuc)
    {
        $this->mat_prim_cuc = $matPrimCuc;

        return $this;
    }

    /**
     * Get mat_prim_cuc
     *
     * @return float 
     */
    public function getMatPrimCuc()
    {
        return $this->mat_prim_cuc;
    }

    /**
     * Set mat_prim_cup
     *
     * @param float $matPrimCup
     * @return Servicio
     */
    public function setMatPrimCup($matPrimCup)
    {
        $this->mat_prim_cup = $matPrimCup;

        return $this;
    }

    /**
     * Get mat_prim_cup
     *
     * @return float 
     */
    public function getMatPrimCup()
    {
        return $this->mat_prim_cup;
    }

    /**
     * Set portadores_cuc
     *
     * @param float $portadoresCuc
     * @return Servicio
     */
    public function setPortadoresCuc($portadoresCuc)
    {
        $this->portadores_cuc = $portadoresCuc;

        return $this;
    }

    /**
     * Get portadores_cuc
     *
     * @return float 
     */
    public function getPortadoresCuc()
    {
        return $this->portadores_cuc;
    }

    /**
     * Set portadores_cup
     *
     * @param float $portadoresCup
     * @return Servicio
     */
    public function setPortadoresCup($portadoresCup)
    {
        $this->portadores_cup = $portadoresCup;

        return $this;
    }

    /**
     * Get portadores_cup
     *
     * @return float 
     */
    public function getPortadoresCup()
    {
        return $this->portadores_cup;
    }

    /**
     * Set arrend_cuc
     *
     * @param float $arrendCuc
     * @return Servicio
     */
    public function setArrendCuc($arrendCuc)
    {
        $this->arrend_cuc = $arrendCuc;

        return $this;
    }

    /**
     * Get arrend_cuc
     *
     * @return float 
     */
    public function getArrendCuc()
    {
        return $this->arrend_cuc;
    }

    /**
     * Set arrend_cup
     *
     * @param float $arrendCup
     * @return Servicio
     */
    public function setArrendCup($arrendCup)
    {
        $this->arrend_cup = $arrendCup;

        return $this;
    }

    /**
     * Get arrend_cup
     *
     * @return float 
     */
    public function getArrendCup()
    {
        return $this->arrend_cup;
    }

    /**
     * Set precio_unit_cuc
     *
     * @param float $precioUnitCuc
     * @return Servicio
     */
    public function setPrecioUnitCuc($precioUnitCuc)
    {
        $this->precio_unit_cuc = $precioUnitCuc;

        return $this;
    }

    /**
     * Get precio_unit_cuc
     *
     * @return float 
     */
    public function getPrecioUnitCuc()
    {
        return $this->precio_unit_cuc;
    }

    /**
     * Set precio_unit_cup
     *
     * @param float $precioUnitCup
     * @return Servicio
     */
    public function setPrecioUnitCup($precioUnitCup)
    {
        $this->precio_unit_cup = $precioUnitCup;

        return $this;
    }

    /**
     * Get precio_unit_cup
     *
     * @return float 
     */
    public function getPrecioUnitCup()
    {
        return $this->precio_unit_cup;
    }

    /**
     * Set deprec_cuc
     *
     * @param float $deprecCuc
     * @return Servicio
     */
    public function setDeprecCuc($deprecCuc)
    {
        $this->deprec_cuc = $deprecCuc;

        return $this;
    }

    /**
     * Get deprec_cuc
     *
     * @return float 
     */
    public function getDeprecCuc()
    {
        return $this->deprec_cuc;
    }

    /**
     * Set deprec_cup
     *
     * @param float $deprecCup
     * @return Servicio
     */
    public function setDeprecCup($deprecCup)
    {
        $this->deprec_cup = $deprecCup;

        return $this;
    }

    /**
     * Get deprec_cup
     *
     * @return float 
     */
    public function getDeprecCup()
    {
        return $this->deprec_cup;
    }

    /**
     * Set area
     *
     * @param \Costo\UsersBundle\Entity\Area $area
     * @return Servicio
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

    /**
     * Set proceso
     *
     * @param \Costo\ServicioBundle\Entity\Proceso $proceso
     * @return Servicio
     */
    public function setProceso(\Costo\ServicioBundle\Entity\Proceso $proceso = null)
    {
        $this->proceso = $proceso;

        return $this;
    }

    /**
     * Get proceso
     *
     * @return \Costo\ServicioBundle\Entity\Proceso 
     */
    public function getProceso()
    {
        return $this->proceso;
    }

    /**
     * Set subcategoria
     *
     * @param \Costo\MaterialesBundle\Entity\subcategoria $subcategoria
     * @return Servicio
     */
    public function setSubcategoria(\Costo\MaterialesBundle\Entity\subcategoria $subcategoria = null)
    {
        $this->subcategoria = $subcategoria;

        return $this;
    }

    /**
     * Get subcategoria
     *
     * @return \Costo\MaterialesBundle\Entity\subcategoria 
     */
    public function getSubcategoria()
    {
        return $this->subcategoria;
    }


    /**
     * Add sitio_servicio
     *
     * @param \Costo\OfertaBundle\Entity\SitioServicio $sitioServicio
     * @return Servicio
     */
    public function addSitioServicio(\Costo\OfertaBundle\Entity\SitioServicio $sitioServicio)
    {
        $this->sitio_servicio[] = $sitioServicio;

        return $this;
    }

    /**
     * Remove sitio_servicio
     *
     * @param \Costo\OfertaBundle\Entity\SitioServicio $sitioServicio
     */
    public function removeSitioServicio(\Costo\OfertaBundle\Entity\SitioServicio $sitioServicio)
    {
        $this->sitio_servicio->removeElement($sitioServicio);
    }

    /**
     * Get sitio_servicio
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSitioServicio()
    {
        return $this->sitio_servicio;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sitio_servicio = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
