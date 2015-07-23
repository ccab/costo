<?php
namespace Costo\ServicioBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Costo\ServicioBundle\Entity\Proceso;

class LoadProcesoData extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $cap = new Proceso();
        $cap->setNombre("Capacitacion")
            ->setNumero(14);
        
        $de = new Proceso();
        $de->setNombre("Direccion Estrategica")
            ->setNumero(4);
        
        $gch = new Proceso();
        $gch->setNombre("Gestion del Capital Humano")
            ->setNumero(5);
        
        $com = new Proceso();
        $com->setNombre("Comercializacion")
            ->setNumero(7);
        
        $obra = new Proceso();
        $obra->setNombre("Ejecucion de Obra Civil Tecnologica")
             ->setNumero(8);
        
        $redes_ext = new Proceso();
        $redes_ext->setNombre("Instalacion de redes exteriores de fibra optica")
                  ->setNumero(9);
        
        $redes_int = new Proceso();
        $redes_int->setNombre("Instalacion de redes interiores")
                  ->setNumero(10);
        
        $at = new Proceso();
        $at->setNombre("Asistencia Tecnica")
           ->setNumero(13);
        
        $sgi = new Proceso();
        $sgi->setNombre("Servicios Generales Internos")
            ->setNumero(11);
        
        $info = new Proceso();
        $info->setNombre("Infocomunicaciones")
             ->setNumero(6);
        
        $manager->persist($cap);
        $manager->persist($de);
        $manager->persist($gch);
        $manager->persist($com);
        $manager->persist($obra);
        $manager->persist($redes_ext);
        $manager->persist($redes_int);
        $manager->persist($at);
        $manager->persist($sgi);
        $manager->persist($info);
        $manager->flush();
        
        $this->addReference("proceso-redes-ext", $redes_ext);
        $this->addReference("proceso-redes-int", $redes_int);
    }
    
    public function getOrder()
    {
        return 1;
    }
}

