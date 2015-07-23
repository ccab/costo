<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FormaPago
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class FormaPago
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
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;
    
    /**
     * @ORM\OneToMany(targetEntity="Dieta", mappedBy="formaPagoDietaCUP")
     */
    protected $dietasCUP;

    /**
     * @ORM\OneToMany(targetEntity="Dieta", mappedBy="formaPagoDietaCUC")
     */
    protected $dietasCUC;
    
    /**
     * @ORM\OneToMany(targetEntity="Dieta", mappedBy="formaPagoHospedajeCUP")
     */
    protected $hospedajeCUP;
    
    /**
     * @ORM\OneToMany(targetEntity="Dieta", mappedBy="formaPagoHospedajeCUC")
     */
    protected $hospedajeCUC;

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
     *
     * @return FormaPago
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
     * Constructor
     */
    public function __construct()
    {
        $this->dietasCUP = new \Doctrine\Common\Collections\ArrayCollection();
        $this->dietasCUC = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add dietasCUP
     *
     * @param \AppBundle\Entity\Dieta $dietasCUP
     *
     * @return FormaPago
     */
    public function addDietasCUP(\AppBundle\Entity\Dieta $dietasCUP)
    {
        $this->dietasCUP[] = $dietasCUP;

        return $this;
    }

    /**
     * Remove dietasCUP
     *
     * @param \AppBundle\Entity\Dieta $dietasCUP
     */
    public function removeDietasCUP(\AppBundle\Entity\Dieta $dietasCUP)
    {
        $this->dietasCUP->removeElement($dietasCUP);
    }

    /**
     * Get dietasCUP
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDietasCUP()
    {
        return $this->dietasCUP;
    }

    /**
     * Add dietasCUC
     *
     * @param \AppBundle\Entity\Dieta $dietasCUC
     *
     * @return FormaPago
     */
    public function addDietasCUC(\AppBundle\Entity\Dieta $dietasCUC)
    {
        $this->dietasCUC[] = $dietasCUC;

        return $this;
    }

    /**
     * Remove dietasCUC
     *
     * @param \AppBundle\Entity\Dieta $dietasCUC
     */
    public function removeDietasCUC(\AppBundle\Entity\Dieta $dietasCUC)
    {
        $this->dietasCUC->removeElement($dietasCUC);
    }

    /**
     * Get dietasCUC
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDietasCUC()
    {
        return $this->dietasCUC;
    }
    
    public function __toString() {
        return $this->nombre;
    }

    /**
     * Add hospedajeCUP
     *
     * @param \AppBundle\Entity\Dieta $hospedajeCUP
     *
     * @return FormaPago
     */
    public function addHospedajeCUP(\AppBundle\Entity\Dieta $hospedajeCUP)
    {
        $this->hospedajeCUP[] = $hospedajeCUP;

        return $this;
    }

    /**
     * Remove hospedajeCUP
     *
     * @param \AppBundle\Entity\Dieta $hospedajeCUP
     */
    public function removeHospedajeCUP(\AppBundle\Entity\Dieta $hospedajeCUP)
    {
        $this->hospedajeCUP->removeElement($hospedajeCUP);
    }

    /**
     * Get hospedajeCUP
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHospedajeCUP()
    {
        return $this->hospedajeCUP;
    }

    /**
     * Add hospedajeCUC
     *
     * @param \AppBundle\Entity\Dieta $hospedajeCUC
     *
     * @return FormaPago
     */
    public function addHospedajeCUC(\AppBundle\Entity\Dieta $hospedajeCUC)
    {
        $this->hospedajeCUC[] = $hospedajeCUC;

        return $this;
    }

    /**
     * Remove hospedajeCUC
     *
     * @param \AppBundle\Entity\Dieta $hospedajeCUC
     */
    public function removeHospedajeCUC(\AppBundle\Entity\Dieta $hospedajeCUC)
    {
        $this->hospedajeCUC->removeElement($hospedajeCUC);
    }

    /**
     * Get hospedajeCUC
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHospedajeCUC()
    {
        return $this->hospedajeCUC;
    }
}
