<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as AppAssert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Dietas
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\DietaRepository")
 * @AppAssert\Beneficiario(groups={"aprobar"})
 */
class Dieta
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
     * @ORM\ManyToOne(targetEntity="Costo\UsersBundle\Entity\Area", inversedBy="dietas")
     */
    protected $areaBeneficiario;

    /**
     * @ORM\ManyToOne(targetEntity="ContratoPago", inversedBy="dietas")
     */
    protected $contratoPago;

    /**
     * @ORM\OneToMany(targetEntity="ContratoDieta", mappedBy="dieta", cascade={"persist"})
     */
    protected $contratoDietas;

    /**
     * @ORM\ManyToOne(targetEntity="FormaPago", inversedBy="dietasCUP")
     */
    protected $formaPagoDietaCUP;

    /**
     * @ORM\ManyToOne(targetEntity="FormaPago", inversedBy="dietasCUC")
     */
    protected $formaPagoDietaCUC;

    /**
     * @ORM\ManyToOne(targetEntity="FormaPago", inversedBy="hospedajeCUP")
     */
    protected $formaPagoHospedajeCUP;

    /**
     * @ORM\ManyToOne(targetEntity="FormaPago", inversedBy="hospedajeCUC")
     */
    protected $formaPagoHospedajeCUC;

    /**
     * @var string
     *
     * @ORM\Column(name="numeroTarjeta", type="string", nullable=true)
     */
    private $numeroTarjeta;

    /**
     * @var string
     *
     * @ORM\Column(name="concepto", type="string")
     *
     * Concepto de la labor a realizar:
     *   Ejecucion
     *   Supervision
     *   Survey Proyecto
     */
    private $concepto;


    /**
     * @var integer
     *
     * @ORM\Column(name="diasHospedado", type="integer", nullable=true)
     */
    private $diasHospedado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaSalidaEstimada", type="datetime", nullable=true)
     */
    private $fechaSalidaEstimada;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaRegresoEstimada", type="datetime", nullable=true)
     */
    private $fechaRegresoEstimada;

    /**
     * @var string
     *
     * @ORM\Column(name="numeroSolicitud", type="string")
     */
    private $numeroSolicitud;

    /**
     * @var float
     *
     * @ORM\Column(name="importeEntregadoDesayunoCUP", type="float", nullable=true)
     */
    private $importeEntregadoDesayunoCUP;

    /**
     * @var float
     *
     * @ORM\Column(name="importeEntregadoDesayunoCUC", type="float", nullable=true)
     */
    private $importeEntregadoDesayunoCUC;

    /**
     * @var float
     *
     * @ORM\Column(name="importeEntregadoAlmuerzoCUP", type="float", nullable=true)
     */
    private $importeEntregadoAlmuerzoCUP;

    /**
     * @var float
     *
     * @ORM\Column(name="importeEntregadoAlmuerzoCUC", type="float", nullable=true)
     */
    private $importeEntregadoAlmuerzoCUC;

    /**
     * @var float
     *
     * @ORM\Column(name="importeEntregadoComidaCUP", type="float", nullable=true)
     */
    private $importeEntregadoComidaCUP;

    /**
     * @var float
     *
     * @ORM\Column(name="importeEntregadoComidaCUC", type="float", nullable=true)
     */
    private $importeEntregadoComidaCUC;

    /**
     * @var float
     *
     * @ORM\Column(name="importeEntregadoHospedajeCUP", type="float", nullable=true)
     */
    private $importeEntregadoHospedajeCUP;

    /**
     * @var float
     *
     * @ORM\Column(name="importeEntregadoHospedajeCUC", type="float", nullable=true)
     */
    private $importeEntregadoHospedajeCUC;

    /**
     * @var float
     *
     * @ORM\Column(name="importeEntregadoOtrosCUP", type="float", nullable=true)
     */
    private $importeEntregadoOtrosCUP;

    /**
     * @var float
     *
     * @ORM\Column(name="importeEntregadoOtrosCUC", type="float", nullable=true)
     */
    private $importeEntregadoOtrosCUC;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string")
     *
     * Estados por los q debe pasar la Dieta:
     *   Pendiente
     *   Liquidada
     */
    private $estado;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero", type="integer", nullable=true)
     */
    private $numero;

    /**
     * @var integer
     *
     * @ORM\Column(name="numeroReembolso", type="integer", nullable=true)
     */
    private $numeroReembolso;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaPago", type="datetime", nullable=true)
     */
    private $fechaPago;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaSalidaReal", type="datetime", nullable=true)
     */
    private $fechaSalidaReal;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaRegresoReal", type="datetime", nullable=true)
     */
    private $fechaRegresoReal;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaLiquidado", type="datetime", nullable=true)
     */
    private $fechaLiquidado;

    /**
     * @var float
     *
     * @ORM\Column(name="importeUtilizadoDesayunoCUP", type="float", nullable=true)
     */
    private $importeUtilizadoDesayunoCUP;

    /**
     * @var float
     *
     * @ORM\Column(name="importeUtilizadoDesayunoCUC", type="float", nullable=true)
     */
    private $importeUtilizadoDesayunoCUC;

    /**
     * @var float
     *
     * @ORM\Column(name="importeUtilizadoAlmuerzoCUP", type="float", nullable=true)
     */
    private $importeUtilizadoAlmuerzoCUP;

    /**
     * @var float
     *
     * @ORM\Column(name="importeUtilizadoAlmuerzoCUC", type="float", nullable=true)
     */
    private $importeUtilizadoAlmuerzoCUC;

    /**
     * @var float
     *
     * @ORM\Column(name="importeUtilizadoComidaCUP", type="float", nullable=true)
     */
    private $importeUtilizadoComidaCUP;

    /**
     * @var float
     *
     * @ORM\Column(name="importeUtilizadoComidaCUC", type="float", nullable=true)
     */
    private $importeUtilizadoComidaCUC;

    /**
     * @var float
     *
     * @ORM\Column(name="importeUtilizadoHospedajeCUP", type="float", nullable=true)
     */
    private $importeUtilizadoHospedajeCUP;

    /**
     * @var float
     *
     * @ORM\Column(name="importeUtilizadoHospedajeCUC", type="float", nullable=true)
     */
    private $importeUtilizadoHospedajeCUC;

    /**
     * @var float
     *
     * @ORM\Column(name="importeUtilizadoOtrosCUP", type="float", nullable=true)
     */
    private $importeUtilizadoOtrosCUP;

    /**
     * @var float
     *
     * @ORM\Column(name="importeUtilizadoOtrosCUC", type="float", nullable=true)
     */
    private $importeUtilizadoOtrosCUC;

    /**
     * @var string
     *
     * @ORM\Column(name="laborRealizar", type="text", nullable=true)
     */
    private $laborRealizar;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreBeneficiario", type="string")
     */
    private $nombreBeneficiario;

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
     * @param integer $numero
     *
     * @return Dietas
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return integer
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set numeroReembolso
     *
     * @param integer $numeroReembolso
     *
     * @return Dietas
     */
    public function setNumeroReembolso($numeroReembolso)
    {
        $this->numeroReembolso = $numeroReembolso;

        return $this;
    }

    /**
     * Get numeroReembolso
     *
     * @return integer
     */
    public function getNumeroReembolso()
    {
        return $this->numeroReembolso;
    }


    public function __toString()
    {
        return "$this->numero";
    }

    /**
     * Set nombreBeneficiario
     *
     * @param string $nombreBeneficiario
     *
     * @return Dieta
     */
    public function setNombreBeneficiario($nombreBeneficiario)
    {
        $this->nombreBeneficiario = $nombreBeneficiario;

        return $this;
    }

    /**
     * Get nombreBeneficiario
     *
     * @return string
     */
    public function getNombreBeneficiario()
    {
        return $this->nombreBeneficiario;
    }

    /**
     * Set areaBeneficiario
     *
     * @param \Costo\UsersBundle\Entity\Area $areaBeneficiario
     *
     * @return Dieta
     */
    public function setAreaBeneficiario(\Costo\UsersBundle\Entity\Area $areaBeneficiario = null)
    {
        $this->areaBeneficiario = $areaBeneficiario;

        return $this;
    }

    /**
     * Get areaBeneficiario
     *
     * @return \Costo\UsersBundle\Entity\Area
     */
    public function getAreaBeneficiario()
    {
        return $this->areaBeneficiario;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return Dieta
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set diasHospedado
     *
     * @param integer $diasHospedado
     *
     * @return Dieta
     */
    public function setDiasHospedado($diasHospedado)
    {
        $this->diasHospedado = $diasHospedado;

        return $this;
    }

    /**
     * Get diasHospedado
     *
     * @return integer
     */
    public function getDiasHospedado()
    {
        return $this->diasHospedado;
    }

    /**
     * Set fechaSalidaEstimada
     *
     * @param \DateTime $fechaSalidaEstimada
     *
     * @return Dieta
     */
    public function setFechaSalidaEstimada($fechaSalidaEstimada)
    {
        $this->fechaSalidaEstimada = $fechaSalidaEstimada;

        return $this;
    }

    /**
     * Get fechaSalidaEstimada
     *
     * @return \DateTime
     */
    public function getFechaSalidaEstimada()
    {
        return $this->fechaSalidaEstimada;
    }

    /**
     * Set fechaRegresoEstimada
     *
     * @param \DateTime $fechaRegresoEstimada
     *
     * @return Dieta
     */
    public function setFechaRegresoEstimada($fechaRegresoEstimada)
    {
        $this->fechaRegresoEstimada = $fechaRegresoEstimada;

        return $this;
    }

    /**
     * Get fechaRegresoEstimada
     *
     * @return \DateTime
     */
    public function getFechaRegresoEstimada()
    {
        return $this->fechaRegresoEstimada;
    }

    /**
     * Set numeroSolicitud
     *
     * @param string $numeroSolicitud
     *
     * @return Dieta
     */
    public function setNumeroSolicitud($numeroSolicitud)
    {
        $this->numeroSolicitud = $numeroSolicitud;

        return $this;
    }

    /**
     * Get numeroSolicitud
     *
     * @return string
     */
    public function getNumeroSolicitud()
    {
        return $this->numeroSolicitud;
    }

    /**
     * Set fechaPago
     *
     * @param \DateTime $fechaPago
     *
     * @return Dieta
     */
    public function setFechaPago($fechaPago)
    {
        $this->fechaPago = $fechaPago;

        return $this;
    }

    /**
     * Get fechaPago
     *
     * @return \DateTime
     */
    public function getFechaPago()
    {
        return $this->fechaPago;
    }

    /**
     * Set fechaRegresoReal
     *
     * @param \DateTime $fechaRegresoReal
     *
     * @return Dieta
     */
    public function setFechaRegresoReal($fechaRegresoReal)
    {
        $this->fechaRegresoReal = $fechaRegresoReal;

        return $this;
    }

    /**
     * Get fechaRegresoReal
     *
     * @return \DateTime
     */
    public function getFechaRegresoReal()
    {
        return $this->fechaRegresoReal;
    }

    /**
     * Set fechaLiquidado
     *
     * @param \DateTime $fechaLiquidado
     *
     * @return Dieta
     */
    public function setFechaLiquidado($fechaLiquidado)
    {
        $this->fechaLiquidado = $fechaLiquidado;

        return $this;
    }

    /**
     * Get fechaLiquidado
     *
     * @return \DateTime
     */
    public function getFechaLiquidado()
    {
        return $this->fechaLiquidado;
    }

    /**
     * @Assert\Callback
     *
     * @param \Symfony\Component\Validator\Context\ExecutionContextInterface $context
     */
    public function isContratoValid(ExecutionContextInterface $context)
    {
        if ($this->concepto == 'Ejecucion') {
            $flag = true;

            foreach ($this->getContratoDietas() as $cd) {
                if ($cd->getContrato() == null || $cd->getProyecto() == null) {
                    $flag = false;
                    break;
                }
            }

            if ($this->contratoDietas == null || !$flag) {
                $context->buildViolation('Debe introducir el Contrato y el Proyecto')
                    ->addViolation();
            }
        }
    }

    /**
     * Set concepto
     *
     * @param string $concepto
     *
     * @return Dieta
     */
    public function setConcepto($concepto)
    {
        $this->concepto = $concepto;

        return $this;
    }

    /**
     * Get concepto
     *
     * @return string
     */
    public function getConcepto()
    {
        return $this->concepto;
    }

    /**
     * Set laborRealizar
     *
     * @param string $laborRealizar
     *
     * @return Dieta
     */
    public function setLaborRealizar($laborRealizar)
    {
        $this->laborRealizar = $laborRealizar;

        return $this;
    }

    /**
     * Get laborRealizar
     *
     * @return string
     */
    public function getLaborRealizar()
    {
        return $this->laborRealizar;
    }

    /**
     * Set numeroTarjeta
     *
     * @param string $numeroTarjeta
     *
     * @return Dieta
     */
    public function setNumeroTarjeta($numeroTarjeta)
    {
        $this->numeroTarjeta = $numeroTarjeta;

        return $this;
    }

    /**
     * Get numeroTarjeta
     *
     * @return string
     */
    public function getNumeroTarjeta()
    {
        return $this->numeroTarjeta;
    }

    public function getDiffDiasEstimado()
    {
        if ($this->fechaRegresoEstimada == null) {
            return null;
        }

        $dateInterval = $this->fechaRegresoEstimada->diff($this->fechaSalidaEstimada);

        return $dateInterval->days == 0 ? 1 : $dateInterval->days;
    }

    public function getDiffDiasReal()
    {
        if ($this->fechaRegresoReal == null) {
            return null;
        }

        $dateInterval = $this->fechaRegresoReal->diff($this->fechaSalidaReal);

        return $dateInterval->days == 0 ? 1 : $dateInterval->days;
    }

    public function getCaluloImporteEntregado()
    {
        if ($this->importeEntregadoDesayunoCUP == null) {
            return null;
        }

        $totalCUP = ($this->importeEntregadoDesayunoCUP + $this->importeEntregadoAlmuerzoCUP + $this->importeEntregadoComidaCUP +
                $this->importeEntregadoHospedajeCUP + $this->importeEntregadoOtrosCUP) * $this->getDiffDiasEstimado();

        //$todayAt7AM = date('H', (new \DateTime('today 07:00'))->getTimestamp());
        // DESAYUNO
        if (date('H', $this->fechaSalidaEstimada->getTimestamp()) > '07') {
            $totalCUP -= $this->importeEntregadoDesayunoCUP;
        }

        // ALMUERZO
        if (date('H', $this->fechaSalidaEstimada->getTimestamp()) > '11') {
            $totalCUP -= $this->importeEntregadoAlmuerzoCUP;
        }

        // COMIDA
        if (date('H', $this->fechaRegresoEstimada->getTimestamp()) < '18') {
            $totalCUP -= $this->importeEntregadoComidaCUP;
        }

        return $totalCUP;
    }

    /**
     * Set importeEntregadoDesayunoCUP
     *
     * @param float $importeEntregadoDesayunoCUP
     *
     * @return Dieta
     */
    public function setImporteEntregadoDesayunoCUP($importeEntregadoDesayunoCUP)
    {
        $this->importeEntregadoDesayunoCUP = $importeEntregadoDesayunoCUP;

        return $this;
    }

    /**
     * Get importeEntregadoDesayunoCUP
     *
     * @return float
     */
    public function getImporteEntregadoDesayunoCUP()
    {
        return $this->importeEntregadoDesayunoCUP;
    }

    /**
     * Set importeEntregadoDesayunoCUC
     *
     * @param float $importeEntregadoDesayunoCUC
     *
     * @return Dieta
     */
    public function setImporteEntregadoDesayunoCUC($importeEntregadoDesayunoCUC)
    {
        $this->importeEntregadoDesayunoCUC = $importeEntregadoDesayunoCUC;

        return $this;
    }

    /**
     * Get importeEntregadoDesayunoCUC
     *
     * @return float
     */
    public function getImporteEntregadoDesayunoCUC()
    {
        return $this->importeEntregadoDesayunoCUC;
    }

    /**
     * Set importeEntregadoAlmuerzoCUP
     *
     * @param float $importeEntregadoAlmuerzoCUP
     *
     * @return Dieta
     */
    public function setImporteEntregadoAlmuerzoCUP($importeEntregadoAlmuerzoCUP)
    {
        $this->importeEntregadoAlmuerzoCUP = $importeEntregadoAlmuerzoCUP;

        return $this;
    }

    /**
     * Get importeEntregadoAlmuerzoCUP
     *
     * @return float
     */
    public function getImporteEntregadoAlmuerzoCUP()
    {
        return $this->importeEntregadoAlmuerzoCUP;
    }

    /**
     * Set importeEntregadoAlmuerzoCUC
     *
     * @param float $importeEntregadoAlmuerzoCUC
     *
     * @return Dieta
     */
    public function setImporteEntregadoAlmuerzoCUC($importeEntregadoAlmuerzoCUC)
    {
        $this->importeEntregadoAlmuerzoCUC = $importeEntregadoAlmuerzoCUC;

        return $this;
    }

    /**
     * Get importeEntregadoAlmuerzoCUC
     *
     * @return float
     */
    public function getImporteEntregadoAlmuerzoCUC()
    {
        return $this->importeEntregadoAlmuerzoCUC;
    }

    /**
     * Set importeEntregadoComidaCUP
     *
     * @param float $importeEntregadoComidaCUP
     *
     * @return Dieta
     */
    public function setImporteEntregadoComidaCUP($importeEntregadoComidaCUP)
    {
        $this->importeEntregadoComidaCUP = $importeEntregadoComidaCUP;

        return $this;
    }

    /**
     * Get importeEntregadoComidaCUP
     *
     * @return float
     */
    public function getImporteEntregadoComidaCUP()
    {
        return $this->importeEntregadoComidaCUP;
    }

    /**
     * Set importeEntregadoComidaCUC
     *
     * @param float $importeEntregadoComidaCUC
     *
     * @return Dieta
     */
    public function setImporteEntregadoComidaCUC($importeEntregadoComidaCUC)
    {
        $this->importeEntregadoComidaCUC = $importeEntregadoComidaCUC;

        return $this;
    }

    /**
     * Get importeEntregadoComidaCUC
     *
     * @return float
     */
    public function getImporteEntregadoComidaCUC()
    {
        return $this->importeEntregadoComidaCUC;
    }

    /**
     * Set importeEntregadoHospedajeCUP
     *
     * @param float $importeEntregadoHospedajeCUP
     *
     * @return Dieta
     */
    public function setImporteEntregadoHospedajeCUP($importeEntregadoHospedajeCUP)
    {
        $this->importeEntregadoHospedajeCUP = $importeEntregadoHospedajeCUP;

        return $this;
    }

    /**
     * Get importeEntregadoHospedajeCUP
     *
     * @return float
     */
    public function getImporteEntregadoHospedajeCUP()
    {
        return $this->importeEntregadoHospedajeCUP;
    }

    /**
     * Set importeEntregadoHospedajeCUC
     *
     * @param float $importeEntregadoHospedajeCUC
     *
     * @return Dieta
     */
    public function setImporteEntregadoHospedajeCUC($importeEntregadoHospedajeCUC)
    {
        $this->importeEntregadoHospedajeCUC = $importeEntregadoHospedajeCUC;

        return $this;
    }

    /**
     * Get importeEntregadoHospedajeCUC
     *
     * @return float
     */
    public function getImporteEntregadoHospedajeCUC()
    {
        return $this->importeEntregadoHospedajeCUC;
    }

    /**
     * Set importeEntregadoOtrosCUP
     *
     * @param float $importeEntregadoOtrosCUP
     *
     * @return Dieta
     */
    public function setImporteEntregadoOtrosCUP($importeEntregadoOtrosCUP)
    {
        $this->importeEntregadoOtrosCUP = $importeEntregadoOtrosCUP;

        return $this;
    }

    /**
     * Get importeEntregadoOtrosCUP
     *
     * @return float
     */
    public function getImporteEntregadoOtrosCUP()
    {
        return $this->importeEntregadoOtrosCUP;
    }

    /**
     * Set importeEntregadoOtrosCUC
     *
     * @param float $importeEntregadoOtrosCUC
     *
     * @return Dieta
     */
    public function setImporteEntregadoOtrosCUC($importeEntregadoOtrosCUC)
    {
        $this->importeEntregadoOtrosCUC = $importeEntregadoOtrosCUC;

        return $this;
    }

    /**
     * Get importeEntregadoOtrosCUC
     *
     * @return float
     */
    public function getImporteEntregadoOtrosCUC()
    {
        return $this->importeEntregadoOtrosCUC;
    }

    /**
     * Set fechaSalidaReal
     *
     * @param \DateTime $fechaSalidaReal
     *
     * @return Dieta
     */
    public function setFechaSalidaReal($fechaSalidaReal)
    {
        $this->fechaSalidaReal = $fechaSalidaReal;

        return $this;
    }

    /**
     * Get fechaSalidaReal
     *
     * @return \DateTime
     */
    public function getFechaSalidaReal()
    {
        return $this->fechaSalidaReal;
    }

    /**
     * Set importeUtilizadoDesayunoCUP
     *
     * @param float $importeUtilizadoDesayunoCUP
     *
     * @return Dieta
     */
    public function setImporteUtilizadoDesayunoCUP($importeUtilizadoDesayunoCUP)
    {
        $this->importeUtilizadoDesayunoCUP = $importeUtilizadoDesayunoCUP;

        return $this;
    }

    /**
     * Get importeUtilizadoDesayunoCUP
     *
     * @return float
     */
    public function getImporteUtilizadoDesayunoCUP()
    {
        return $this->importeUtilizadoDesayunoCUP;
    }

    /**
     * Set importeUtilizadoDesayunoCUC
     *
     * @param float $importeUtilizadoDesayunoCUC
     *
     * @return Dieta
     */
    public function setImporteUtilizadoDesayunoCUC($importeUtilizadoDesayunoCUC)
    {
        $this->importeUtilizadoDesayunoCUC = $importeUtilizadoDesayunoCUC;

        return $this;
    }

    /**
     * Get importeUtilizadoDesayunoCUC
     *
     * @return float
     */
    public function getImporteUtilizadoDesayunoCUC()
    {
        return $this->importeUtilizadoDesayunoCUC;
    }

    /**
     * Set importeUtilizadoAlmuerzoCUP
     *
     * @param float $importeUtilizadoAlmuerzoCUP
     *
     * @return Dieta
     */
    public function setImporteUtilizadoAlmuerzoCUP($importeUtilizadoAlmuerzoCUP)
    {
        $this->importeUtilizadoAlmuerzoCUP = $importeUtilizadoAlmuerzoCUP;

        return $this;
    }

    /**
     * Get importeUtilizadoAlmuerzoCUP
     *
     * @return float
     */
    public function getImporteUtilizadoAlmuerzoCUP()
    {
        return $this->importeUtilizadoAlmuerzoCUP;
    }

    /**
     * Set importeUtilizadoAlmuerzoCUC
     *
     * @param float $importeUtilizadoAlmuerzoCUC
     *
     * @return Dieta
     */
    public function setImporteUtilizadoAlmuerzoCUC($importeUtilizadoAlmuerzoCUC)
    {
        $this->importeUtilizadoAlmuerzoCUC = $importeUtilizadoAlmuerzoCUC;

        return $this;
    }

    /**
     * Get importeUtilizadoAlmuerzoCUC
     *
     * @return float
     */
    public function getImporteUtilizadoAlmuerzoCUC()
    {
        return $this->importeUtilizadoAlmuerzoCUC;
    }

    /**
     * Set importeUtilizadoComidaCUP
     *
     * @param float $importeUtilizadoComidaCUP
     *
     * @return Dieta
     */
    public function setImporteUtilizadoComidaCUP($importeUtilizadoComidaCUP)
    {
        $this->importeUtilizadoComidaCUP = $importeUtilizadoComidaCUP;

        return $this;
    }

    /**
     * Get importeUtilizadoComidaCUP
     *
     * @return float
     */
    public function getImporteUtilizadoComidaCUP()
    {
        return $this->importeUtilizadoComidaCUP;
    }

    /**
     * Set importeUtilizadoComidaCUC
     *
     * @param float $importeUtilizadoComidaCUC
     *
     * @return Dieta
     */
    public function setImporteUtilizadoComidaCUC($importeUtilizadoComidaCUC)
    {
        $this->importeUtilizadoComidaCUC = $importeUtilizadoComidaCUC;

        return $this;
    }

    /**
     * Get importeUtilizadoComidaCUC
     *
     * @return float
     */
    public function getImporteUtilizadoComidaCUC()
    {
        return $this->importeUtilizadoComidaCUC;
    }

    /**
     * Set importeUtilizadoHospedajeCUP
     *
     * @param float $importeUtilizadoHospedajeCUP
     *
     * @return Dieta
     */
    public function setImporteUtilizadoHospedajeCUP($importeUtilizadoHospedajeCUP)
    {
        $this->importeUtilizadoHospedajeCUP = $importeUtilizadoHospedajeCUP;

        return $this;
    }

    /**
     * Get importeUtilizadoHospedajeCUP
     *
     * @return float
     */
    public function getImporteUtilizadoHospedajeCUP()
    {
        return $this->importeUtilizadoHospedajeCUP;
    }

    /**
     * Set importeUtilizadoHospedajeCUC
     *
     * @param float $importeUtilizadoHospedajeCUC
     *
     * @return Dieta
     */
    public function setImporteUtilizadoHospedajeCUC($importeUtilizadoHospedajeCUC)
    {
        $this->importeUtilizadoHospedajeCUC = $importeUtilizadoHospedajeCUC;

        return $this;
    }

    /**
     * Get importeUtilizadoHospedajeCUC
     *
     * @return float
     */
    public function getImporteUtilizadoHospedajeCUC()
    {
        return $this->importeUtilizadoHospedajeCUC;
    }

    /**
     * Set importeUtilizadoOtrosCUP
     *
     * @param float $importeUtilizadoOtrosCUP
     *
     * @return Dieta
     */
    public function setImporteUtilizadoOtrosCUP($importeUtilizadoOtrosCUP)
    {
        $this->importeUtilizadoOtrosCUP = $importeUtilizadoOtrosCUP;

        return $this;
    }

    /**
     * Get importeUtilizadoOtrosCUP
     *
     * @return float
     */
    public function getImporteUtilizadoOtrosCUP()
    {
        return $this->importeUtilizadoOtrosCUP;
    }

    /**
     * Set importeUtilizadoOtrosCUC
     *
     * @param float $importeUtilizadoOtrosCUC
     *
     * @return Dieta
     */
    public function setImporteUtilizadoOtrosCUC($importeUtilizadoOtrosCUC)
    {
        $this->importeUtilizadoOtrosCUC = $importeUtilizadoOtrosCUC;

        return $this;
    }

    /**
     * Get importeUtilizadoOtrosCUC
     *
     * @return float
     */
    public function getImporteUtilizadoOtrosCUC()
    {
        return $this->importeUtilizadoOtrosCUC;
    }

    /**
     * Set contratoPago
     *
     * @param \AppBundle\Entity\ContratoPago $contratoPago
     *
     * @return Dieta
     */
    public function setContratoPago(\AppBundle\Entity\ContratoPago $contratoPago = null)
    {
        $this->contratoPago = $contratoPago;

        return $this;
    }

    /**
     * Get contratoPago
     *
     * @return \AppBundle\Entity\ContratoPago
     */
    public function getContratoPago()
    {
        return $this->contratoPago;
    }

    /**
     * Set formaPagoDietaCUP
     *
     * @param \AppBundle\Entity\FormaPago $formaPagoDietaCUP
     *
     * @return Dieta
     */
    public function setFormaPagoDietaCUP(\AppBundle\Entity\FormaPago $formaPagoDietaCUP = null)
    {
        $this->formaPagoDietaCUP = $formaPagoDietaCUP;

        return $this;
    }

    /**
     * Get formaPagoDietaCUP
     *
     * @return \AppBundle\Entity\FormaPago
     */
    public function getFormaPagoDietaCUP()
    {
        return $this->formaPagoDietaCUP;
    }

    /**
     * Set formaPagoDietaCUC
     *
     * @param \AppBundle\Entity\FormaPago $formaPagoDietaCUC
     *
     * @return Dieta
     */
    public function setFormaPagoDietaCUC(\AppBundle\Entity\FormaPago $formaPagoDietaCUC = null)
    {
        $this->formaPagoDietaCUC = $formaPagoDietaCUC;

        return $this;
    }

    /**
     * Get formaPagoDietaCUC
     *
     * @return \AppBundle\Entity\FormaPago
     */
    public function getFormaPagoDietaCUC()
    {
        return $this->formaPagoDietaCUC;
    }

    /**
     * Set formaPagoHospedajeCUP
     *
     * @param \AppBundle\Entity\FormaPago $formaPagoHospedajeCUP
     *
     * @return Dieta
     */
    public function setFormaPagoHospedajeCUP(\AppBundle\Entity\FormaPago $formaPagoHospedajeCUP = null)
    {
        $this->formaPagoHospedajeCUP = $formaPagoHospedajeCUP;

        return $this;
    }

    /**
     * Get formaPagoHospedajeCUP
     *
     * @return \AppBundle\Entity\FormaPago
     */
    public function getFormaPagoHospedajeCUP()
    {
        return $this->formaPagoHospedajeCUP;
    }

    /**
     * Set formaPagoHospedajeCUC
     *
     * @param \AppBundle\Entity\FormaPago $formaPagoHospedajeCUC
     *
     * @return Dieta
     */
    public function setFormaPagoHospedajeCUC(\AppBundle\Entity\FormaPago $formaPagoHospedajeCUC = null)
    {
        $this->formaPagoHospedajeCUC = $formaPagoHospedajeCUC;

        return $this;
    }

    /**
     * Get formaPagoHospedajeCUC
     *
     * @return \AppBundle\Entity\FormaPago
     */
    public function getFormaPagoHospedajeCUC()
    {
        return $this->formaPagoHospedajeCUC;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->contratoDietas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add contratoDieta
     *
     * @param \AppBundle\Entity\ContratoDieta $contratoDieta
     *
     * @return Dieta
     */
    public function addContratoDieta(\AppBundle\Entity\ContratoDieta $contratoDieta)
    {
        $contratoDieta->setDieta($this);

        $this->contratoDietas->add($contratoDieta);

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

    /**
     * @Assert\Callback
     *
     * @param \Symfony\Component\Validator\Context\ExecutionContextInterface $context
     */
    public function CantidadDiasValid(ExecutionContextInterface $context)
    {
        $cantDias = 0;
        foreach ($this->getContratoDietas() as $cd) {
            $cantDias += $cd->getDias();
        }

        if ($this->getDiffDiasEstimado() != $cantDias) {
            $context->buildViolation(
                "La cantidad de dias trabajados en el(los) contrato(s) [$cantDias] debe coincidir"
                ." con la cantidad de dias desde la salida hasta el regreso [".$this->getDiffDiasEstimado()."]"
            )
                ->addViolation();
        }
    }

    /**
     * @link http://stackoverflow.com/questions/9088603/symfony2-doctrine-how-to-re-save-an-entity-with-a-onetomany-as-a-cascading-new
     */
    public function __clone()
    {
        if ($this->id) {
            $this->id = null;
            $this->setNombreBeneficiario(null);
            $this->setNumeroSolicitud(null);

            $contDietasCopy = $this->contratoDietas;
            $this->contratoDietas = new ArrayCollection();

            foreach ($contDietasCopy as $cd) {
                $cdClone = clone $cd;
                $this->contratoDietas->add($cdClone);
                $cdClone->setDieta($this);
            }
        }

    }

}
