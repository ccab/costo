<?php

namespace Costo\UsersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Costo\UsersBundle\Entity\Role;
use Costo\ClienteBundle\Entity\Ficha;//use para poder utilizar la entidad Ficha del Bundle ClienteBundle

/**
 * User
 *
 * @ORM\Table(name="usuarios")
 * @ORM\Entity(repositoryClass="Costo\UsersBundle\Entity\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="first_name", type="string", length=50, nullable=true)
     */
    private $firstName;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="full_name", type="string", length=50, nullable=true)
     */
    private $fullName;
    
    /**
     * Logging the last time the user access to the website(the previous visit)
     * 
     * @var \DateTime
     *
     * @ORM\Column(name="last_access", type="datetime", nullable=true)
     */
    protected $lastAccess;
    
    /**
    * @ORM\ManyToOne(targetEntity="Area", inversedBy="users")
    * @ORM\JoinColumn(name="area_id", referencedColumnName="id")
    */
    protected $area;
    
    /**
    * @ORM\ManyToMany(targetEntity="Role", inversedBy="users")
    * @ORM\JoinTable(name="usuarios_roles")
    * 
    * With this new property we can tweak the Doctrine mapping restriction to the role 
    * property itself, we override the access methods so we work with a role entity instead 
    * of an array
    */
    protected $myRoles;
    
    //referencia con la ficha.
    /**
     * @ORM\OneToMany(targetEntity="Costo\ClienteBundle\Entity\Ficha", mappedBy="usuario")
     */
    protected $fichas;


    public function __construct()
    {
        parent::__construct();
        $this->servicios = new ArrayCollection();
        $this->servicios_solucionados = new ArrayCollection();
        $this->myRoles = new ArrayCollection();
        $this->enabled = true;
        //$this->fichas = new ArrayCollection();
             
    }
 
    
    ////////////////////////////////roles//////////////////////////////////
    
    public function getRoles()
    {
        return $this->myRoles->toArray();
    }
   
    public function setRoles(array $roles)
    {   
        $this->myRoles = new ArrayCollection();
        
        foreach ($roles as $role) 
        {
            $this->addRole($role);
        }
    }
    
    public function removeRole($role)
    {
        $this->myRoles->removeElement($role);
    }
    
    public function addRole($role)
    {
        $this->myRoles[] = $role;
    }
    
    public function getMyRoles() 
    {
        return $this->myRoles;
    }

    public function setMyRoles($myRoles) 
    {
        $this->myRoles = $myRoles;
    }

        ////////////////////////////////roles//////////////////////////////////
    
    public function getFirstName() {
        return $this->firstName;
    }

    public function getFullName() {
        return $this->fullName;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function setFullName($fullName) {
        $this->fullName = $fullName;
    }
    
    public function getArea() {
        return $this->area;
    }

    public function setArea($area) {
        $this->area = $area;
    }

        
    public function getLastAccess() {
        return $this->lastAccess;
    }

    public function setLastAccess($lastAccess) {
        $this->lastAccess = $lastAccess;
    }



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
     * Add myRoles
     *
     * @param \Reporte\UsersBundle\Entity\Role $myRoles
     * @return User
     */
    public function addMyRole(Role $myRoles)
    {
        $this->myRoles[] = $myRoles;

        return $this;
    }

    /**
     * Remove myRoles
     *
     * @param \Reporte\UsersBundle\Entity\Role $myRoles
     */
    public function removeMyRole(Role $myRoles)
    {
        $this->myRoles->removeElement($myRoles);
    }

    /**
     * Add fichas
     *
     * @param \Costo\ClienteBundle\Entity\Ficha $fichas
     * @return User
     */
    public function addFicha(\Costo\ClienteBundle\Entity\Ficha $fichas)
    {
        $this->fichas[] = $fichas;

        return $this;
    }

    /**
     * Remove fichas
     *
     * @param \Costo\ClienteBundle\Entity\Ficha $fichas
     */
    public function removeFicha(\Costo\ClienteBundle\Entity\Ficha $fichas)
    {
        $this->fichas->removeElement($fichas);
    }

    /**
     * Get fichas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFichas()
    {
        return $this->fichas;
    }
    
//    public function __toString() {
//        $this->getUsername();
//    }
}
