<?php

namespace Costo\UsersBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/usuarios/mostrar');

        $this->assertTrue($crawler->filter('html:contains("Root")')->count() > 0);
    }
    
      
    public function testAdd() 
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin/usuarios/adicionar');

        $this->assertTrue($crawler->filter('form[name=costo_usersbundle_user]')->count() > 0);
    }
    
    
    public function testUpdate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'admin/usuarios/modificar/1');

        $this->assertTrue($crawler->filter('form[name=costo_usersbundle_user]')->count() > 0);
    }
    
    /**
     * Cuando se crea la BD y se llena con Data Fixtures el id del usuario
     * root debe ser el 1, por lo tanto se prueba eliminarlo
     */
    public function testAskdelete() 
    {   
        $client = static::createClient();

        $crawler = $client->request('GET', 'admin/usuarios/eliminar/1');

        $this->assertTrue($crawler->filter('html:contains("Esta seguro que desea eliminar el Usuario?")')->count() > 0);
    }
    
    public function testLoginPage()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/usuarios/login');

        $this->assertTrue($crawler->filter('form[name=costo_usersbundle_login]')->count() > 0);
    }
}
