<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoadTipoEmpresasData
 *
 * @author Yero
 */

namespace Costo\ClienteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Costo\ClienteBundle\Entity\TipoEmpresa;

class LoadTipoEmpresasData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface{
    private $container;

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }
    
    public function Load(ObjectManager $managaer) {
//        $tipos = array("Estatal","Asociación Económica","Mixta","Extrangera");
//        
//        foreach ($tipos as $value) {
//            $tipo_empresa = new TipoEmpresa();
//            
//            $tipo_empresa->setTipo($value);
//            $managaer->persist($tipo_empresa);
//        }
//        $managaer->flush();
//        
        $estatal = new TipoEmpresa();
        $estatal->setTipo("Estatal");
        
        $asoc_econ = new TipoEmpresa();
        $asoc_econ->setTipo("Asociación Económica");
        
        $mixta = new TipoEmpresa();
        $mixta->setTipo("Mixta");
        
        $extrangera = new TipoEmpresa();
        $extrangera->setTipo("Extrangera");
        
        $managaer->persist($estatal);
        $managaer->persist($asoc_econ);
        $managaer->persist($mixta);
        $managaer->persist($extrangera);
        
        $managaer->flush();
        
        $this->addReference("emp_estatal", $estatal);
    }
    
    public function getOrder()
    {
        return 6; 
    }
}
