<?php
    

namespace GCBA\StoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use GCBA\StoreBundle\Entity\SysPerfil;

class LoadPerfilData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
   /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $perfil = new SysPerfil();

        $perfil->setNombre('ROLE_SUPERADMIN');
        $perfil->setDescripcion('Superadmin');
        $perfil->setBorrado(false);
        $manager->persist($perfil);
        
   
        $this->addReference('admin-perfil', $perfil);
        $usuario=$this->getReference('admin-user');
        $usuario->addIdSysPerfil($perfil); 
        $manager->persist($usuario);


          
        
         $perfil = new SysPerfil();
        $perfil->setNombre('ROLE_ADMIN');
        $perfil->setDescripcion('Admin');
        $perfil->setBorrado(false);
     
        $manager->persist($perfil);
         

     
          $perfil = new SysPerfil();
        $perfil->setNombre('ROLE_USER');
        $perfil->setDescripcion('Usuario');
        $perfil->setBorrado(false);

        $manager->persist($perfil);



        $manager->flush();
      

 
      
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2; // the order in which fixtures will be loaded
    }
}