<?php

namespace Costo\UsersBundle\Tests\Security;

use Costo\UsersBundle\Security\LDAPService;
use adLDAP\adLDAP;

/**
 * Test for the LDAPService class
 *
 * @author Carlos Rafael
 */
class LDAPServiceTest extends \PHPUnit_Framework_TestCase {

    private $ldap;

    public function __construct() 
    {
        $this->ldap = new LDAPService("crafael", "Ccabrera93", array('DC=cubatel', 'DC=cu'), "cubatel.cu", "dc.cubatel.cu");
    }

    /**
     * @expectedException Symfony\Component\Security\Core\Exception\AuthenticationException
     */
    public function testConstruct() 
    {
        $fakeLdap = new LDAPService("asd", "Ccabrera93", array('DC=cubatel2', 'DC=cu'), "cubatel.cu", "dc.cubatel.cu");
        $this->assertInstanceOf('adLDAP\adLDAP', $fakeLdap);
    }

    public function testFind() 
    {
        $this->assertTrue($this->ldap->find("crafael")->userPrincipalName == "crafael@cubatel.cu");
        $this->assertFalse($this->ldap->find("inexistente"));
    }

    public function testAuthenticate() 
    {
        $this->assertTrue($this->ldap->authenticate("crafael", "Ccabrera93"));
    }

    public function testGroups() 
    {
        $this->ldap->find("crafael");
        $groups = $this->ldap->groups("crafael");
        $this->assertTrue(in_array("DOMAIN_USERS", $groups));
    }

}
