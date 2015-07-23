<?php
namespace Costo\UsersBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Costo\UsersBundle\Entity\Role;

class LoadRoleData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager) 
    {
        $admin = new Role();
        $admin->setName('Administrador');
        $admin->setRole('ROLE_ADMIN');
        $admin->setNombreGrupoDC('ADMIN_COSTO');
        
        $comercial = new Role();
        $comercial->setName('Comercial');
        $comercial->setRole('ROLE_COMERCIAL');
        $comercial->setNombreGrupoDC('COMERCIAL_COSTO');
        
        $user = new Role();
        $user->setName('Usuario');
        $user->setRole('ROLE_USER');
        $user->setNombreGrupoDC("DOMAIN_USERS");
        
        $manager->persist($admin);
        $manager->persist($comercial);
        $manager->persist($user);
        $manager->flush();
        
        $this->addReference("rol-administrador", $admin);
    }
    
    
    public function getOrder() 
    {
        return 2;
    }

}
