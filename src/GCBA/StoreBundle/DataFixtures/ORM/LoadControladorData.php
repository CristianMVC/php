<?php
    

namespace GCBA\StoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use GCBA\StoreBundle\Entity\SysControlador;

class LoadControladorData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        $controlador = new SysControlador();


        $controlador->setNombre('Modulo');
        $controlador->setBorrado(false);
        $manager->persist($controlador);
         $this->addReference('Modulo', $controlador);
        $controlador = new SysControlador();
        $controlador->setNombre('Controlador');
        $controlador->setBorrado(false);
        $manager->persist($controlador);
          $this->addReference('Controlador', $controlador);
        $controlador = new SysControlador();
        $controlador->setNombre('Accion');
        $controlador->setBorrado(false);
        $manager->persist($controlador);
        $this->addReference('Accion', $controlador);    
        $controlador = new SysControlador();
        $controlador->setNombre('Perfil');
        $controlador->setBorrado(false);
        $manager->persist($controlador);
        $this->addReference('Perfil', $controlador); 
        $controlador = new SysControlador();
        $controlador->setNombre('Usuario');
        $controlador->setBorrado(false);
        $manager->persist($controlador);
          $this->addReference('Usuario', $controlador);
        $controlador = new SysControlador();
        $controlador->setNombre('UsuarioGcba');
        $controlador->setBorrado(false);
        $manager->persist($controlador);
        $this->addReference('UsuarioGcba', $controlador);  
        $controlador = new SysControlador();
        $controlador->setNombre('Log');
        $controlador->setBorrado(false);
        $manager->persist($controlador);
        $this->addReference('Log', $controlador); 
  

        $manager->flush();

     
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 4; // the order in which fixtures will be loaded
    }
}