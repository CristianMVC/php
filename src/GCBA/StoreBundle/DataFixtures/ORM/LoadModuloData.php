<?php
    

namespace GCBA\StoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use GCBA\StoreBundle\Entity\SysModulo;

class LoadModuloData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        $modulo = new SysModulo();

    
    $modulo->setNombre('ABM Usuarios');
    $modulo->setDescripcion('ABM Usuarios');
    $modulo->setOrden('20');
    $modulo->setBorrado(false);
    $manager->persist($modulo);
    $this->addReference('ABM Usuarios-modulo', $modulo);

        $manager->flush();
      
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 3; // the order in which fixtures will be loaded
    }
}