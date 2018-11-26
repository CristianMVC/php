<?php
// src/Acme/DemoBundle/Menu/Builder.php
namespace GCBA\StoreBundle\Menu;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;  
use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
class Builder extends Controller
{
    private $roles=array();
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        /**
        * Habilitar menubasico cuando no se tiene cargada 
        * las tablas de modulos y acciones en la base de datos
        */
      
      //  return $this->menuBasico($menu);
        $securityContext = $this->get('security.context');
        $user = $securityContext->getToken()->getUser();
        if (!$user)
        {
            
          return $menu;  
        }
        $securityIdentity = UserSecurityIdentity::fromAccount($user);
        
        $this->roles=$user->getRoles();  
       $em = $this->getDoctrine()->getManager();
        $modulos=$em->createQuery('SELECT m FROM GCBAStoreBundle:SysModulo m order by m.orden ')->getResult();
        $c=0;
        foreach ($modulos as $k => $modulo)
        {
            $acciones=array();
            $id=$modulo->getIdSysModulo();
            $nombre=$modulo->getNombre();
            $c++;
            $enc=false;
            $pmenu=$menu->addChild($nombre, array('attributes' => array('onmouseover' => "\$('#contenedor_opciones_$c').show()",
            'onmouseout'=> '$("#contenedor_opciones_'.$c.'").hide()',
            )));

            $acciones=$em->createQuery('SELECT a FROM GCBAStoreBundle:SysAccion a where a.idSysModulo='.$id.' and a.esMenu=1 and a.borrado=0 ')->getResult();

            foreach ($acciones as $k => $accion)
            {
                
                

                if ($modulo->getNombre()<>"")
                {  
                     $route=$accion->getNombreRoute();
                     $perfiles=$accion->getIdSysPerfil();
                  
                  
                    if ($this->tienePermiso($route,$perfiles)==true and $this->routeExists($route))
                     {
                        $pmenu->addChild($accion->getNombreMenu(), array('route' => $route));  
                        $enc=true;
                     }   
                }

               

            }  
            if ($enc==false)
            {          
            $pmenu=$menu->removeChild($modulo->getNombre());
            $c--;
            }
        } 
        

       return $menu;
       
      

    }
   function tienePermiso($route,$perfiles)
   { 

    $roles=$this->roles;
     foreach ($perfiles as $perfil)
    
    {
        foreach ($roles as $rol)
        {        
           
            if ($perfil->getNombre()==$rol)
          return true;
        }
    }    
   return false;
   } 
   
  function routeExists($name)
{
    // I assume that you have a link to the container in your twig extension class
    $router = $this->container->get('router');
    return (null === $router->getRouteCollection()->get($name)) ? false : true;
} 
   
  function menuBasico($menu)
  {
        
       
        $umenu=$menu->addChild('ABM Usuarios', array('attributes' => array('onmouseover' => "\$('#contenedor_opciones_1').show()",
        'onmouseout'=> '$("#contenedor_opciones_1").hide()',

        )));
        $umenu->addChild('Usuarios', array('route' => 'gcba_usuario_homepage'));
        $umenu->addChild('Usuarios GCBA', array('route' => 'gcba_usuario_gcba_listar'));
     
        $umenu->addChild('Usuarios Alta', array('route' => 'gcba_alta_usuario'));      
        $umenu->addChild('Perfil', array('route' => 'gcba_perfil_listar'));
        $umenu->addChild('Modulo', array('route' => 'gcba_modulo_listar'));
        $umenu->addChild('Alta Módulo', array('route' => 'gcba_modulo_alta'));
        $umenu->addChild('Route', array('route' => 'gcba_controlador_listar'));
        $umenu->addChild('Alta Route', array('route' => 'gcba_controlador_alta'));
        $umenu->addChild('Acción', array('route' => 'gcba_accion_listar'));
        $umenu->addChild('Alta Acción', array('route' => 'gcba_accion_alta'));
        $umenu->addChild('Perfil Acción', array('route' => 'gcba_perfil_asignar_accion'));
        
        return $menu;
    
  }
  

      
}

?>