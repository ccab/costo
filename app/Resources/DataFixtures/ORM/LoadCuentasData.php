<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoadCuentasData
 *
 * @author Yero
 */
namespace Costo\ClienteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Costo\ClienteBundle\Entity\Cuenta;

class LoadCuentasData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {

    private $container;

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }


    public function Load(ObjectManager $managaer) {
        
        $numero = '01234567891234567890';
        $bancos = array('Metroplitano','BFI','BANDEC','BCC');
        $tipos = array('CUP','USD','EUR','CUC');
        
        $fichas = $managaer->getRepository('ClienteBundle:Ficha')->findAll();
        
        foreach ($fichas as $ficha) {
            
            for ($i = 0; $i <= 1; $i++) {
                $pos = substr(str_shuffle('0123'), 0 , 1);
                
                $cuenta = new Cuenta();
                $cuenta->setNumero(substr(str_shuffle($numero), 0, 16));
                $cuenta->setBanco($bancos[$pos]);
                $cuenta->setDireccion('Dirección del Banco '.$bancos[$pos]);
                $cuenta->setFicha($ficha);
                $cuenta->setMoneda($this->getReference("moneda-cup"));
                
                $managaer->persist($cuenta);
                $managaer->flush();
            }
            
        }
    }


    public function getOrder()     {
        return 8; 
    }

}
