<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoadDirectivosData
 *
 * @author Yero
 */

namespace Costo\ClienteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Costo\ClienteBundle\Entity\Directivo;

class LoadDirectivosData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {

    private $container;

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function Load(ObjectManager $manager) {

        $nombre = array('Pepe', 'Antonio', 'Jose', 'Raul', 'Manuel', 'Oliver', 'Noemi', 'Julio', 'Marti', 'Rosa');
        $apellido = array('Rodriguez', 'Perez', 'Martinez', 'Castro', 'Pacheco', 'Aquilar', 'Fuentes', 'Torre', 'Blas', 'Almenteros');
        $tipo_dir = array("Director o Gerente General", "Director o Genrente Económico");

        $numeros = '01234567890123456789';

        $fichas = $manager->getRepository('ClienteBundle:Ficha')->findAll();

        foreach ($fichas as $ficha) {

            for ($i = 0; $i < 2; $i++) {
                $pos = substr(str_shuffle($numeros), 8, 1); //barajeo de nuevo

                $directivo = new Directivo();
                $directivo->setNombre($nombre[$pos] . " " . $apellido[$pos]);
                $directivo->setTelefono(substr(str_shuffle($numeros), 0, 6) . $pos);
                $directivo->setTipo($tipo_dir[$i]);
                $directivo->setEmail(trim(strtolower($nombre[$pos].$apellido[$pos] . '@' . $ficha->getNombre() . '.director.cu')));//verificar porque no lo hace
                $directivo->setFicha($ficha);

                $manager->persist($directivo);
            }
            $manager->flush();
        }
    }

    public function getOrder() {
        return 11;
    }

}
