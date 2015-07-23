<?php

namespace Costo\ServicioBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Costo\MaterialesBundle\Entity\moneda;

class LoadMonedaData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {
        $cup = new moneda();
        $cup->setNombreMoneda('Peso Cubano')
                ->setAbreviatura('CUP');
        
        $cuc = new moneda();
        $cuc->setNombreMoneda('Moneda Libremente Convertible')
                ->setAbreviatura('CUC');
        
        $manager->persist($cup);
        $manager->persist($cuc);
        $manager->flush();
        
        $this->addReference("moneda-cup", $cup);
        $this->addReference("moneda-cuc", $cuc);
    }

    public function getOrder() {
        return 10;
    }

}
