<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoadAutorizadosData
 *
 * @author Yero
 */
namespace Costo\ClienteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Costo\ClienteBundle\Entity\Autorizado;

class LoadAutorizadosData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {

    private $container;

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function Load(ObjectManager $manager) {
        
        $nombre = array('Pepe', 'Antonio', 'Jose', 'Raul', 'Manuel', 'Oliver', 'Noemi', 'Julio', 'Marti', 'Rosa');
        $apellido = array('Rodriguez', 'Perez', 'Martinez', 'Castro', 'Pacheco', 'Aquilar', 'Fuentes', 'Torre', 'Blas', 'Almenteros');
        $area = array('Division de Capacitación e Infocomunicaciones',
            'Division de Redes',
            'Division de Planta Exterior',
            'Division Tecnica de Equipos',
            'Vicepresidencia Comercial',
            'Vicepresidencia Jurídica',
            'Vicepresidencia Administrativa',
            'Vicepresidencia Económica',
            'Presidencia',
            'Recursos Humanos');
        $numeros = '01234567890123456789';

        $fichas = $manager->getRepository('ClienteBundle:Ficha')->findAll();

        foreach ($fichas as $ficha) {

            for ($i = 0; $i < 2; $i++) {
                $pos = substr(str_shuffle($numeros), 5, 1); //barajeo de nuevo

                $aut = new Autorizado();
                $aut->setNombre($nombre[$pos].' '.$apellido[$pos]);
                $aut->setCi(substr(str_shuffle($numeros), 0, 10) . $pos);
                $aut->setArea($area[$pos]);
                $aut->setObservacion('Observaciones de la persona autorizada '.$aut->getNombre());
                $aut->setFicha($ficha);

                $manager->persist($aut);
            }
            $manager->flush();
        }
    
    }


    public function getOrder()     {
        return 10; 
    }

}
