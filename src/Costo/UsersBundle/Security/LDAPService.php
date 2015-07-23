<?php
namespace Costo\UsersBundle\Security;

use adLDAP\adLDAP;
use adLDAP\adLDAPException;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

/**
 * Base class to work with adLDAP library via the service container
 *
 * @author Carlos Rafael Cabrera
 */
class LDAPService 
{
    private $username;
    private $password;
    private $base_dn;
    private $account_suffix;
    private $domain_controller;
    private $adLDAP;


    public function __construct($username, $password, $base_dn, $account_suffix, $domain_controller) 
    {
        $this->username = $username;
        $this->password = $password;
        $this->account_suffix = '@'.$account_suffix;
        $this->domain_controller = $domain_controller;
        
       
        $this->base_dn = "";
        for ($i = 0, $count = count($base_dn); $i < $count; $i++) 
        {
            if ($i == $count - 1) 
            {
                $this->base_dn .= "$base_dn[$i]";
            } 
            else 
            {
                $this->base_dn .= "$base_dn[$i],";
            }
        }
        
        //creando el nuevo objeto adLDAP
        // @codeCoverageIgnoreStart
        try 
        {
        // @codeCoverageIgnoreEnd
            $this->adLDAP = new adLDAP(array('base_dn' => $this->base_dn, 
                                             'account_suffix' => $this->account_suffix,
                                             'domain_controllers' => array($this->domain_controller)));
        // @codeCoverageIgnoreStart
        }
        catch (adLDAPException $e) 
        {
            throw new AuthenticationException("It is not possible to connect with DC Server".$e->getMessage());
        }
        // @codeCoverageIgnoreEnd
        
        //autenticando al usuario configurado a traves del objeto creado anteriormente
        $authUser = $this->adLDAP->user()->authenticate($this->username, $this->password);

        if (!$authUser) 
        {
            throw new AuthenticationException("It is not possible to connect with DC Server");
        }
        
    }
    
    /**
     * Finds a user in the DC Server 
     * 
     * @return adLDAPUserCollection The User object with all the information available 
     */
    public function find($username)
    {
        $userData = $this->adLDAP->user()->infoCollection($username,array("*"));

        if ($userData) 
        {
            return $userData;
        }

        return false;
    }
    
    /**
     * Attempts to authenticate a user against the DC Server
     */
    public function authenticate($username, $password)
    {
        return $this->adLDAP->authenticate($username, $password);
    }
    
    /**
     * Get the groups the user is a member of
     */
    public function groups($username)
    {      
        $groups = $this->adLDAP->user()->groups($username);
        
        $sfRoles = array();
        $sfRolesTemp = array();
        foreach ($groups as $r) 
        {
            if (in_array($r, $sfRolesTemp) === false) 
            {
                //if you want symfony's roles format
                //$sfRoles[] = 'ROLE_' . strtoupper(str_replace(' ', '_', $r));
                $sfRoles[] = strtoupper(str_replace(' ', '_', $r));
                $sfRolesTemp[] = $r;
            }
        }
        
        return $sfRoles;
    }
    
    public function findAll() {
        $all = $this->adLDAP->user()->all();
        $formattedInfo = array();
        
        foreach ($all as $username) {
            $name = $this->adLDAP->user()->infoCollection($username,array("name"))->name;
            $formattedInfo[$name] = $name;
            //$formattedInfo[] = array('n' => $name);
        }
        
        unset($formattedInfo['Administrator']);
        unset($formattedInfo['Guest']);
        unset($formattedInfo['IUSR_SVR1']);
        unset($formattedInfo['IUSR_WUS']);
        unset($formattedInfo['IWAM_SVR1']);
        unset($formattedInfo['IWAM_WUS']);
        unset($formattedInfo['SUPPORT_388945a0']);
        unset($formattedInfo['Asistencia Tecnica']);
        unset($formattedInfo['CentroCap']);
        unset($formattedInfo['Chaos [ Servidor Impresion Proyecto ]']);
        unset($formattedInfo['drupal']);
        unset($formattedInfo['emi']);
        unset($formattedInfo['Instalacion de Software']);
        unset($formattedInfo['kaspersky']);
        unset($formattedInfo['Kaspersky Antivirus']);
        unset($formattedInfo['krbtgt']);
        unset($formattedInfo['Jabber']);
        unset($formattedInfo['pepe pepe']);
        unset($formattedInfo['postmaster']);
        unset($formattedInfo['quota_correo']);
        unset($formattedInfo['quota_global']);
        unset($formattedInfo['Microsoft SQL Server']);
        unset($formattedInfo['versat']);
        unset($formattedInfo['Versat_user']);
        
        return $formattedInfo;
    }
    
}

