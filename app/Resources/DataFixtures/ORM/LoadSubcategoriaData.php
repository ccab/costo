<?php
namespace Costo\ServicioBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Costo\MaterialesBundle\Entity\subcategoria;

class LoadSubcategoriaData extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $documentacion = new subcategoria();
        $documentacion->setNombre('DOCUMENTACIÓN Y SURVEY')
                ->setTipo('Categorias de Servicios');
        
        $cableado = new subcategoria();
        $cableado->setNombre('CABLEADO')
                ->setTipo('Categorias de Servicios');
        
        $elementos = new subcategoria();
        $elementos->setNombre('ELEMENTOS ACTIVOS Y PASIVOS')
                ->setTipo('Categorias de Servicios');
        
        $conectorizacion = new subcategoria();
        $conectorizacion->setNombre('CONECTORIZACIÓN Y EMPALME')
                ->setTipo('Categorias de Servicios');
        
        $mediciones = new subcategoria();
        $mediciones->setNombre('MEDICIONES Y CERTIFICACIÓN')
                ->setTipo('Categorias de Servicios');
        
        $estandar = new subcategoria();
        $estandar->setNombre("ESTANDAR")
                ->setTipo('Categorias de Servicios');
        
        $utp = new subcategoria();
        $utp->setNombre('CABLEADO UTP')
                ->setTipo('Categorias de Materiales');
        
        $canalizacion = new subcategoria();
        $canalizacion->setNombre('CANALIZACIÓN')
                ->setTipo('Categorias de Materiales');
        
        $telefonico = new subcategoria();
        $telefonico->setNombre('CABLEADO TELEFÓNICO')
                ->setTipo('Categorias de Materiales');
        
        $electrico = new subcategoria();
        $electrico->setNombre('CABLEADO ELÉCTRICO')
                ->setTipo('Categorias de Materiales');
        
        $fo = new subcategoria();
        $fo->setNombre('CABLEADO F.O')
                ->setTipo('Categorias de Materiales');
        
        
        $manager->persist($documentacion);
        $manager->persist($cableado);
        $manager->persist($elementos);
        $manager->persist($conectorizacion);
        $manager->persist($mediciones);
        $manager->persist($estandar);
        $manager->persist($utp);
        $manager->persist($canalizacion);
        $manager->persist($telefonico);
        $manager->persist($electrico);
        $manager->persist($fo);
        $manager->flush();
        
        $this->addReference("subcateg-documentacion", $documentacion);
        $this->addReference("subcateg-cableado", $cableado);
        $this->addReference("subcateg-elementos", $elementos);
        $this->addReference("subcateg-conectorizacion", $conectorizacion);
        $this->addReference("subcateg-mediciones", $mediciones);
        $this->addReference("subcateg-estandar", $estandar);
        $this->addReference("subcateg-utp", $utp);
        $this->addReference("subcateg-canalizacion", $canalizacion);
        $this->addReference("subcateg-telefonico", $telefonico);
        $this->addReference("subcateg-electrico", $electrico);
        $this->addReference("subcateg-fo", $fo);
    }
    
    public function getOrder()
    {
        return 10;
    }
}

