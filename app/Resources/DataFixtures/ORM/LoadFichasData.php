<?php

/**
 * Description of Fichas
 * Fixtures
 * @author Yero
 * 
 */

namespace Costo\ClienteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
//use Costo\ClienteBundle\Entity\TipoEmpresa;
use Costo\ClienteBundle\Entity\Ficha;
//use Costo\UsersBundle\CostoUsersBundle;

//use Costo\UsersBundle\DataFixtures\ORM\LoadUserData;

class LoadFichasData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {

    private $container;

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function load(ObjectManager $manager) {

        $nombre = array('COPEXTEL', 'ACINOX', 'TRD-CARIBE', 'TELECABLE');
        $nombre_elab = array('Pepe', 'Antonio', 'Jose', 'Raul', 'Manuel', 'Oliver');
        $numeros = '1234567890';

        //obtengo los usuarios del sistema
        //$users = $manager->getRepository('CostoUsersBundle:User')->findAll();

        //Crear 2 entidades por cada usuario
        //foreach ($users as $usuario) {
            for ($i = 0; $i < 2; $i++) {

                $entidad = new Ficha();
                $entidad->setNombre($nombre[$i]);
                $entidad->setDireccion('Direccion de ' . $nombre[$i]);
                $entidad->setReeup(substr(str_shuffle($numeros), 0, 8));
                $entidad->setNit(str_shuffle($numeros) . $i);
                $entidad->setRegComercial(substr(str_shuffle($numeros), 0, 6));
                $entidad->setRegMercantil('G-' . str_shuffle($numeros));
                $entidad->setLicDivisas(substr(str_shuffle($numeros), 0, 5));
                $entidad->setNombreElabora($nombre_elab[$i]);
                $entidad->setCargo('Cargo' . $i);
                $entidad->setFechaElaboracion(new \DateTime('yesterday'));
                $entidad->setFechaCreacion(new \DateTime('today'));
                //$entidad->setUsuario($usuario);
                //$entidad->setUsuario($this->getReference('root'));
                //ministerio y tipo empresa son referencias adicionadas(ver Fixtures de TipoEmpresa y Ministerio)
                $entidad->setTipoempresa($this->getReference("emp_estatal"));
                $entidad->setMinisterio($this->getReference("MC"));

                $manager->persist($entidad);
                $manager->flush();
            }
            
        //}
    }

    public function getOrder() {
        return 20;
    }

}
