<?php
 
namespace GCBA\StoreBundle\Listener;
 
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Core\SecurityContext;
use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine; // for Symfony 2.1.0+
use Symfony\Component\DependencyInjection\ContainerInterface;
// use Symfony\Bundle\DoctrineBundle\Registry as Doctrine; // for Symfony 2.0.x
 
/**
* Custom login listener.
*/
class LoginListener
{
    /** @var \Symfony\Component\Security\Core\SecurityContext */
    private $securityContext;
    /** @var \Doctrine\ORM\EntityManager */
    private $em;
    private $container;
    private $doctrine;
    /**
    * Constructor
    *
    * @param SecurityContext $securityContext
    * @param Doctrine $doctrine
    */
    
    
    
    public function __construct(SecurityContext $securityContext, Doctrine $doctrine,ContainerInterface $container)
    {
    $this->securityContext = $securityContext;
    $this->em = $doctrine->getManager();
    $this->doctrine= $doctrine;
    $this->container=$container;
    }
    /**
    * Do the magic.
    *
    * @param InteractiveLoginEvent $event
    */
    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
     $login=false;
        
    if ($this->securityContext->isGranted('IS_AUTHENTICATED_FULLY')) {
    // user has just logged in
     $login=true;
    
    }
    if ($this->securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
    // user has logged in using remember_me cookie
    }
    // do some other magic here
    $user = $event->getAuthenticationToken()->getUser();
    if ($login)
    {
      $log=$this->container->get('gcba_log'); 
      if (method_exists($user,"getId"))
      {
      $id=$user->getId();
   
               $User = $this->doctrine
               ->getRepository("GCBAStoreBundle:SysUsuario")
                ->find($id);
      $log->log($User,"GCBAStoreBundle::login",null,"Se logueo el usuario  ".$User->getNa()); 
      }
                 
     
    }         
    // ...
    }
}