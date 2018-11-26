<?php

namespace GCBA\StoreBundle\Controller;
          
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GCBA\StoreBundle\Entity\SysLog;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class LogController extends Controller
{
    
    private $bundle="GCBAStoreBundle";
    private $entity="GCBAStoreBundle:SysLog";


  
      
      public function mensaje($mens)
      {
          $this->get('session')->getFlashBag()->add('notice', $mens);   
      }    
      
      public function listarLogAction(Request $request)
{
               $permisos = $this->get('gcba.security.permisos');
            $permisos->setCurrentMethod(__METHOD__);
            $securityContext = $this->get('security.context');
            $user = $securityContext->getToken()->getUser();
              $response=$permisos->tienePermiso($user,$securityContext);
            if (!($response===true)) return $response;
   
        
        $em = $this->getDoctrine()->getManager(); 
   
             $Log = new SysLog();
             

             
    $em = $this->getDoctrine()->getManager();
    $entity="GCBACatalogoAppBundle:Log";
    $dql = "SELECT a FROM $entity a ";
  //  $dql="SELECT a   FROM GCBAStoreBundle:Log a ";
 
    $query = $em->createQuery($dql);
   
   

     $dataTables="";
    $datatables = $this->get('gcba_datatables');
    $datatables->setEntity($this->entity);
    $dataTables=$datatables->getGrilla(); 
    
    return $this->render(
    $this->bundle.':Default:listado_log.html.twig',
    array('dataTables' => $dataTables 
    
        
    ));
}
      
      

      





      
}
