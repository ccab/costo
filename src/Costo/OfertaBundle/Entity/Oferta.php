<?php

namespace Costo\OfertaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Doctrine\Common\Collections\Criteria;

/**
 * Oferta
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Costo\OfertaBundle\Entity\OfertaRepository")
 */
class Oferta {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="vigencia", type="integer", nullable=true)
     */
    private $vigencia;

    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=50, nullable=true)
     */
    private $numero;

    /**
     * @ORM\ManyToOne(targetEntity="Costo\ClienteBundle\Entity\Ficha", inversedBy="ofertas")
     * @ORM\JoinColumn(name="ficha_id", referencedColumnName="id")
     */
    protected $ficha_cliente;

    /**
     * @ORM\OneToMany(targetEntity="Sitio", mappedBy="oferta", cascade={"persist"})
     */
    private $sitios;

    /**
     * @ORM\OneToMany(targetEntity="OfertaProceso", mappedBy="oferta", cascade={"persist"})
     */
    private $oferta_procesos;

    /**
     * @ORM\ManyToMany(targetEntity="Costo\MaterialesBundle\Entity\subcategoria", inversedBy="ofertas")
     * */
    private $categorias;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set vigencia
     *
     * @param integer $vigencia
     * @return Oferta
     */
    public function setVigencia($vigencia) {
        $this->vigencia = $vigencia;

        return $this;
    }

    /**
     * Get vigencia
     *
     * @return integer 
     */
    public function getVigencia() {
        return $this->vigencia;
    }

    /**
     * Set numero
     *
     * @param string $numero
     * @return Oferta
     */
    public function setNumero($numero) {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string 
     */
    public function getNumero() {
        return $this->numero;
    }

    /**
     * Add sitio
     *
     * @param \Costo\OfertaBundle\Entity\Sitio $sitio
     * @return Oferta
     */
    public function addSitio(\Costo\OfertaBundle\Entity\Sitio $sitio) {
        $sitio->setOferta($this);

        $this->sitios->add($sitio);

        return $this;
    }

    /**
     * Remove sitios
     *
     * @param \Costo\OfertaBundle\Entity\Sitio $sitios
     */
    public function removeSitio(\Costo\OfertaBundle\Entity\Sitio $sitios) {
        $this->sitios->removeElement($sitios);
    }

    /**
     * Get sitios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSitios() {
        return $this->sitios;
    }

    /**
     * Add oferta_proceso
     *
     * @param \Costo\OfertaBundle\Entity\OfertaProceso $ofertaProceso
     * @return Oferta
     */
    public function addOfertaProceso(\Costo\OfertaBundle\Entity\OfertaProceso $ofertaProceso) {
        $ofertaProceso->setOferta($this);

        $this->oferta_procesos->add($ofertaProceso);

        return $this;
    }

    /**
     * Remove oferta_procesos
     *
     * @param \Costo\OfertaBundle\Entity\OfertaProceso $ofertaProcesos
     */
    public function removeOfertaProceso(\Costo\OfertaBundle\Entity\OfertaProceso $ofertaProcesos) {
        $this->oferta_procesos->removeElement($ofertaProcesos);
    }

    /**
     * Get oferta_procesos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOfertaProcesos() {
        return $this->oferta_procesos;
    }

    /**
     * Add categorias
     *
     * @param \Costo\MaterialesBundle\Entity\subcategoria $categorias
     * @return Oferta
     */
    public function addCategoria(\Costo\MaterialesBundle\Entity\subcategoria $categorias) {
        $this->categorias[] = $categorias;

        return $this;
    }

    /**
     * Remove categorias
     *
     * @param \Costo\MaterialesBundle\Entity\subcategoria $categorias
     */
    public function removeCategoria(\Costo\MaterialesBundle\Entity\subcategoria $categorias) {
        $this->categorias->removeElement($categorias);
    }

    /**
     * Get categorias
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategorias() {
        return $this->categorias;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->sitios = new \Doctrine\Common\Collections\ArrayCollection();
        $this->oferta_procesos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->categorias = new \Doctrine\Common\Collections\ArrayCollection();
        $this->vigencia = 30;
    }

    /**
     * Set ficha_cliente
     *
     * @param \Costo\ClienteBundle\Entity\Ficha $fichaCliente
     * @return Oferta
     */
    public function setFichaCliente(\Costo\ClienteBundle\Entity\Ficha $fichaCliente = null) {
        $this->ficha_cliente = $fichaCliente;

        return $this;
    }

    /**
     * Get ficha_cliente
     *
     * @return \Costo\ClienteBundle\Entity\Ficha 
     */
    public function getFichaCliente() {
        return $this->ficha_cliente;
    }

    public function __toString() {
        return $this->numero;
    }

    public function getProcesoPrincipal() {
        foreach ($this->oferta_procesos as $op) {
            if ($op->getPrincipal()) {
                return $op->getProceso();
            }
        }
    }

    public function procPrincUnico(ExecutionContextInterface $context) {
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq("principal", TRUE));
        
        $count = $this->oferta_procesos->matching($criteria)->count();
        
        if ($count > 1) {
            $context->buildViolation("La Oferta no puede tener mas de un Proceso Principal")
                    ->addViolation();
        } elseif ($count == 0) {
            $context->buildViolation("La Oferta no tiene asignado un Proceso Principal")
                    ->addViolation();
        }
    }

    public function procUnico(ExecutionContextInterface $context) {
        $procesos = array();

        foreach ($this->oferta_procesos as $op) {
            if (in_array($op->getProceso(), $procesos)) {
                $context->buildViolation("La Oferta esta relacionada con un mismo Proceso mas de una vez")
                        ->addViolation();
                break;
            } else {
                $procesos[] = $op->getProceso();
            }
        }
    }

}
