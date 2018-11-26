<?php

namespace GCBA\StoreBundle\Security;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Router;
use Symfony\Component\HttpFoundation\RedirectResponse;
class Permisos{
   
    private $entityManager;
    private $jq;
    private $securityContext;
    public function __construct($doctrine,$container) {
        $this->doctrine = $doctrine;
        $this->jq=false;
        $this->container=$container;
    }

   function setCurrentMethod($method)
   {
    
       $datos=explode("::",$method);
       $controlador=explode("\\",$datos[0]);
       $indice=count($controlador)-1;
       $this->controlador=str_replace("Controller","",$controlador[$indice]);
       $this->accion=str_replace("Action","",$datos[1]);
   }
   public function setJq($bol)
   {
        $this->jq=$bol;
   }
   
   public function tienePermiso($user,$securityContext)
   {
 
              $this->securityContext=$securityContext;      
             
              if (preg_match("/(^cambiarPassword|^editarUsuario|^listarUsuarios\$)/",$this->accion,$array)==false && $this->debeCambiarPass()==true)
              {        
                     //    echo  $this->accion;exit;
                    
                     $this->container->get('session')->getFlashBag()->add('error', 'Debe Cambiar la contraseña para continuar');  
                    $router=$this->container->get('router');                          
                    return new RedirectResponse($router->generate('gcba_usuario_cambiarpassword'));
                      
                    
              
              }         
            
             //  $this->container->get('session')->getFlashBag()->clear();
              
              
              $acciones = $this->doctrine
                ->getRepository('GCBAStoreBundle:SysAccion')
                ->findByNombre($this->accion);
             $perf=array();
             foreach ($acciones as $accion)
             {
                $perf=$accion->getIdSysPerfil();
             }
             foreach ($perf as $perfil)
             {
              if ($securityContext->isGranted($perfil->getNombre())) {
              return true; 
              }  
             }
             if ($this->jq==false)
             { 
             echo "No tiene permisos para realizar la accion";
              throw new AccessDeniedException('No tiene permisos para realizar la accion '.$this->accion);
             }
             
             
             return false; 
   }
   
     function debeCambiarPass()
  {
        
        $user = $this->securityContext->getToken()->getUser();

        $id=$user->getId();
       
        $usuario = $this->doctrine
        ->getRepository('GCBAStoreBundle:SysUsuario')
        ->find($id);    
       if (is_object($usuario) && strlen($usuario->getSalt())>0 && $usuario->getPrimerLogin()=="1")
        {
        
            return true;
        }    
        return false;        
  
  }  
   
            
}