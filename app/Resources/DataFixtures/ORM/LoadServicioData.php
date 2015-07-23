<?php

namespace Costo\ServicioBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Costo\ServicioBundle\Entity\Servicio;

class LoadServicioData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {
        $documentacion = new Servicio();
        $documentacion->setNombre('Documentación y Survey')
                ->setSubcategoria($this->getReference('subcateg-documentacion'))
                ->setUnidad('m')
                ->setPrecioUnitCuc(0.27)
                ->setPrecioUnitCup(0.48);

        $canalizacion = new Servicio();
        $canalizacion->setNombre('Canalización')
                ->setSubcategoria($this->getReference('subcateg-cableado'))
                ->setUnidad('m')
                ->setPrecioUnitCuc(3.92)
                ->setPrecioUnitCup(4.88);
        
        $bandejas = new Servicio();
        $bandejas->setNombre('Instalación Bandejas Pasa Cables')
                ->setSubcategoria($this->getReference('subcateg-cableado'))
                ->setUnidad('m')
                ->setPrecioUnitCuc(37.44)
                ->setPrecioUnitCup(26.16);

        $gabinete = new Servicio();
        $gabinete->setNombre('Instalación de Gabinete')
                ->setSubcategoria($this->getReference('subcateg-elementos'))
                ->setUnidad('u')
                ->setPrecioUnitCuc(22.17)
                ->setPrecioUnitCup(18.63);
        
        $odf = new Servicio();
        $odf->setNombre('Instalación de ODF')
                ->setSubcategoria($this->getReference('subcateg-elementos'))
                ->setUnidad('u')
                ->setPrecioUnitCuc(34.21)
                ->setPrecioUnitCup(52.25);
        
        $panel = new Servicio();
        $panel->setNombre('Conectorización de Patch Panel')
                ->setSubcategoria($this->getReference('subcateg-conectorizacion'))
                ->setUnidad('conect')
                ->setPrecioUnitCuc(2.18)
                ->setPrecioUnitCup(2.57);
        
        $empalme = new Servicio();
        $empalme->setNombre('Empalme')
                ->setSubcategoria($this->getReference('subcateg-conectorizacion'))
                ->setUnidad('u')
                ->setPrecioUnitCuc(22.75)
                ->setPrecioUnitCup(33.03);
        
        $pruebas = new Servicio();
        $pruebas->setNombre('Pruebas de Enlace y Medición del Cable')
                ->setSubcategoria($this->getReference('subcateg-mediciones'))
                ->setUnidad('enlace')
                ->setPrecioUnitCuc(12.81)
                ->setPrecioUnitCup(21.81);

        $zr = new Servicio();
        $zr->setNombre("Zanjado Rural");
        //$zr->setArea($this->getReference("area-planta_externa"));
        //$zr->setProceso($this->getReference("proceso-redes-ext"));
        $zr->setSubcategoria($this->getReference("subcateg-estandar"));
        $zr->setCodigo("PE-13-ZR-V01");
        $zr->setUnidad("m");
        $zr->setSalario(76815.37);
        $zr->setPrecioUnitCuc(9.87);
        $zr->setPrecioUnitCup(12.73);
        $zr->setDeprecCuc(8616.70);
        $zr->setDeprecCup(108.46);
        $zr->setAlojamientoCuc(16500);
        $zr->setAlojamientoCup(16500);
        $zr->setDietaCuc(15675);
        $zr->setDietaCup(9900);
        $zr->setMatPrimCuc(5384.18);
        $zr->setMatPrimCup(300.06);
        $zr->setPortadoresCuc(56620);
        $zr->setPortadoresCup(0);
        $zr->setArrendCuc(0);
        $zr->setArrendCup(0);
        
        $tc = new Servicio();
        $tc->setNombre("Tendido del Cable");
        //$tc->setArea($this->getReference("area-tecnica"));
        //$tc->setProceso($this->getReference("proceso-redes-int"));
        $tc->setSubcategoria($this->getReference("subcateg-cableado"));
        $tc->setCodigo("DT-13-CABLE-V01");
        $tc->setUnidad("m");
        $tc->setSalario(32198.48);
        $tc->setPrecioUnitCuc(2.98);
        $tc->setPrecioUnitCup(4.85);
        $tc->setDeprecCuc(3574.14);
        $tc->setDeprecCup(29.54);
        $tc->setAlojamientoCuc(19436.34);
        $tc->setAlojamientoCup(15902.46);
        $tc->setDietaCuc(16785.93);
        $tc->setDietaCup(10601.64);
        $tc->setMatPrimCuc(6674.63);
        $tc->setMatPrimCup(287.52);
        $tc->setPortadoresCuc(3611.08);
        $tc->setPortadoresCup(0.29);
        $tc->setArrendCuc(0);
        $tc->setArrendCup(0);
        
        $manager->persist($zr);
        $manager->persist($tc);
        $manager->persist($documentacion);
        $manager->persist($canalizacion);
        $manager->persist($bandejas);
        $manager->persist($gabinete);
        $manager->persist($odf);
        $manager->persist($panel);
        $manager->persist($empalme);
        $manager->persist($pruebas);
        $manager->flush();
    }

    public function getOrder() {
        return 20;
    }

}
