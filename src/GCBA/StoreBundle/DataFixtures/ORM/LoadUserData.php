<?php
    

namespace GCBA\StoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use GCBA\StoreBundle\Entity\SysUsuario;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        $usuario = new SysUsuario();
        $usuario->setUsuario('admin');
        $usuario->setCorreo('admin@admin.com');
        $usuario->setNombre('admin');
        $usuario->setApellido('admin');
        $usuario->setActivo(true);
        $usuario->setBorrado(false);
        $factory = $this->container->get('security.encoder_factory');
                

            $encoder = $factory->getEncoder($usuario);
            $password = $encoder->encodePassword('troquelad0', $usuario->getSalt());
            $usuario->setPassword($password);
            $usuario->setBorrado(false);
            $usuario->setPrimerLogin(false);
            $usuario->setLogeado(false);
            
        
        

     
        $manager->persist($usuario);
        $manager->flush();
          $this->addReference('admin-user', $usuario);
      
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}