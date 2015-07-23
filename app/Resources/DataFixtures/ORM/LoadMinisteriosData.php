<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoadMinisteriosData
 *
 * @author Yero
 */

namespace Costo\ClienteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Costo\ClienteBundle\Entity\Ministerio;

class LoadMinisteriosData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {

    private $container;

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function Load(ObjectManager $managaer) {

        $MC = new Ministerio();
        $MC->setNombre("Ministerio de las Comunicaciones");
        $MC->setTelefono('+53-8265487');
        $MC->setDireccion("Direccion del " . $MC->getNombre());
        $MC->setMinistro("Rodrigo Malmierca");
        
        $managaer->persist($MC);
        $managaer->flush();
        
        $this->addReference("MC", $MC);
    }

    public function getOrder() {
        return 4;
    }

}
