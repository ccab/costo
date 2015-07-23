<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoadContactosData
 *
 * @author Yero
 */

namespace Costo\ClienteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Costo\ClienteBundle\Entity\Contacto;

class LoadContactosData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {

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
                $pos = substr(str_shuffle($numeros), 0, 1); //barajeo de nuevo

                $contacto = new Contacto();
                $contacto->setNombre($nombre[$pos].' '.$apellido[$pos]);
                $contacto->setWeb('http://blog.' . strtolower($nombre[$pos] . $apellido[$pos]) . '.net');
                $contacto->setCi(substr(str_shuffle($numeros), 0, 10) . $pos);
                $contacto->setEmail(strtolower($nombre[$pos].$apellido[$pos] . $contacto->getCi() . '@' . $ficha->getNombre() . '.cu'));
                $contacto->setTelefono(substr(str_shuffle($numeros), 0, 6) . $pos);
                $contacto->setNacionalidad('nacionalidad' . $pos);
                $contacto->setPasaporte('E' . substr(str_shuffle($numeros), 0, 5) . $pos);
                $contacto->setArea($area[$pos]);
                $contacto->setFicha($ficha);

                $manager->persist($contacto);
            }
            $manager->flush();
        }
    }

    public function getOrder() {
        return 9;
    }

}
