<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Provincia;

class LoadProvinciaData extends AbstractFixture 
{
    
    public function load(ObjectManager $manager)
    {
        
        $pr = new Provincia();
        $pr->setNombre('Pinar del Río');
        
        $ar = new Provincia();
        $ar->setNombre('Artemisa');
        
        $ha = new Provincia();
        $ha->setNombre('La Habana');
        
        $my = new Provincia();
        $my->setNombre('Mayabeque');
        
        $mt = new Provincia();
        $mt->setNombre('Matanzas');
        
        $cf = new Provincia();
        $cf->setNombre('Cienfuegos');
        
        $vc = new Provincia();
        $vc->setNombre('Villa Clara');
        
        $ss = new Provincia();
        $ss->setNombre('Sancti Spíritus');
        
        $ca = new Provincia();
        $ca->setNombre('Ciego de Ávila');
        
        $cm = new Provincia();
        $cm->setNombre('Camagüey');
        
        $lt = new Provincia();
        $lt->setNombre('Las Tunas');
        
        $gr = new Provincia();
        $gr->setNombre('Granma');
        
        $ho = new Provincia();
        $ho->setNombre('Holguín');
        
        $sc = new Provincia();
        $sc->setNombre('Santiago de Cuba');
        
        $gt = new Provincia();
        $gt->setNombre('Guantánamo');
                
        $manager->persist($pr);
        $manager->persist($ar);
        $manager->persist($ha);
        $manager->persist($my);
        $manager->persist($mt);
        $manager->persist($cf);
        $manager->persist($vc);
        $manager->persist($ss);
        $manager->persist($ca);
        $manager->persist($cm);
        $manager->persist($lt);
        $manager->persist($gr);
        $manager->persist($ho);
        $manager->persist($sc);
        $manager->persist($gt);
        $manager->flush();
    }

}