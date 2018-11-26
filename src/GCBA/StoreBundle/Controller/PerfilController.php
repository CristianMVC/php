<?php

namespace GCBA\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use GCBA\StoreBundle\Entity\SysPerfil;
use Symfony\Component\HttpFoundation\Request;


use GCBA\StoreBundle\Form\Type\PerfilType;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class perfilController extends Controller
{
    public function indexAction()
    {
        return $this->render('GCBAStoreBundle:Default:index.html.twig');
    }
    public function AltaPerfilAction(Request $request)
            {
            // crea una task y le asigna algunos datos ficticios para este ejemplo
            
            $permisos = $this->get('gcba.security.permisos');
            $permisos->setCurrentMethod(__METHOD__);
            $securityContext = $this->get('security.context');
            $user = $securityContext->getToken()->getUser();
            $response=$permisos->tienePermiso($user,$securityContext);
            if (!($response===true)) return $response;
            $perfil = new SysPerfil();

           // print_r($perfil);
            $em = $this->getDoctrine()->getManager();
       $form = $this->createForm(new PerfilType($request,$em,"alta"), $perfil);
            $form->handleRequest($request);
            $factory = $this->get('security.encoder_factory');








            if ($form->isValid()) {
            // guardar la tarea en la base de datos

          //  $this->get('session')->getFlashBag()->add('notice', ''.$perfil->getperfil()); 

            $em = $this->getDoctrine()->getManager();
            $em->persist($perfil); 
            $req = $this->getRequest();
            $em->flush(); 

            $this->get('session')->getFlashBag()->add('notice', ' perfil creado  ok: ');

            return $this->redirect($this->generateUrl('gcba_perfil_listar'));
            }
            return $this->render('GCBAStoreBundle:Default:f_alta_perfil.html.twig', array(
            'form' => $form->createView(),
            ));
    }
        public function listarPerfilesAction()
{
        
                      $permisos = $this->get('gcba.security.permisos');
            $permisos->setCurrentMethod(__METHOD__);
            $securityContext = $this->get('security.context');
            $user = $securityContext->getToken()->getUser();
        $response=$permisos->tienePermiso($user,$securityContext);
        if (!($response===true)) return $response;
                
        $em = $this->getDoctrine()->getManager();
        $perfil = new Sysperfil();
        $request = $this->getRequest();
        $ids=$request->request->get('ids');
        if (is_array($ids))
        {     
            foreach ($ids as $id => $val)
            {

                $perfil = $this->getDoctrine()
                ->getRepository('GCBAStoreBundle:SysPerfil')
                ->find($id);
               
               if ($perfil->getNombre()=="ROLE_SUPERADMIN" or $perfil->getNombre()=="ROLE_ADMIN")
               {
                 $this->get('session')->getFlashBag()->add('notice', 'El perfil '.$perfil->getNombre().'  no se puede borrar');
               }
               else
               {
                $em->remove($perfil);
                $em->flush();
                if (!$perfil) {
               $this->get('session')->getFlashBag()->add('notice', 'no existe el registro para el id '.$id);
             
                }
                else
                {
                             $this->get('session')->getFlashBag()->add('notice', 'El perfil '.' ha sido borrado');
                }
               }      
            }    
        }
    
    
    
    $dql = "SELECT p FROM GCBAStoreBundle:SysPerfil p";
    $query = $em->createQuery($dql);

    $paginator = $this->get('knp_paginator');
    $pagination = $paginator->paginate(
        $query,
        $this->getRequest()->query->get('page', 1),
        10
    );  
  //print_r($paginator);
    return $this->render(
        'GCBAStoreBundle:Default:listado_perfil.html.twig',
        compact('pagination')
    );  
}
function PerfilAccionAction()
{
    
        $permisos = $this->get('gcba.security.permisos');
        $permisos->setCurrentMethod(__METHOD__);
        $securityContext = $this->get('security.context');
        $user = $securityContext->getToken()->getUser();
        $response=$permisos->tienePermiso($user,$securityContext);
        if (!($response===true)) return $response;
    
    $html="";
    $request = $this->getRequest();
        $idperfil=$request->request->get('id_sys_perfil'); 
    $em = $this->getDoctrine()->getManager();
    // $perfil=$em->createQuery('SELECT p FROM GCBAStoreBundle:SysPerfil p WHERE p.idSysPerfil=:idperfil')->setParameter('idperfil',$idperfil)->getResult(); 

  /*  return $this->render(
        'GCBAStoreBundle:Default:vacio.html.twig'

        
        
        );    */
    $perfiles=$em->createQuery('SELECT p FROM GCBAStoreBundle:SysPerfil p ')->getResult(); 
    $modulos=$em->createQuery('SELECT m FROM GCBAStoreBundle:SysModulo m ')->getResult(); 

    $perfilAccion=array();

   
    $acciones=array();
    
    $idperfil=$request->request->get('id_sys_perfil');  
    if ($idperfil)
    {

        $acciones=$em->createQuery('SELECT a FROM GCBAStoreBundle:SysAccion a order by a.idSysModulo ')->getResult();
        
    }    

    return $this->render(
        'GCBAStoreBundle:Default:asignar_accion_perfil.html.twig',
        array ('perfiles' => $perfiles ,
        'Acciones' => $acciones ,
        'modulos' => $modulos,
        'idperfil' => $idperfil,
        

        
        
        )
    );     
}
   function addAccionAction()
   {               
        
        $permisos = $this->get('gcba.security.permisos');
        $permisos->setJq(true);
        $permisos->setCurrentMethod(__METHOD__);
        $securityContext = $this->get('security.context');
        $user = $securityContext->getToken()->getUser();
        
        if ($permisos->tienePermiso($user,$securityContext))
        {
        
        
        $request = $this->getRequest();  
            $id=$request->query->get('id'); 
            $idperfil=$request->query->get('perfil');
            $em = $this->getDoctrine()->getManager();
            $accion = $this->getDoctrine()
            ->getRepository('GCBAStoreBundle:SysAccion')
            ->find($id); 
            $perfil = $this->getDoctrine()
            ->getRepository('GCBAStoreBundle:SysPerfil')
            ->find($idperfil); 

            if ($accion->getIdSysAccion()>0 and $perfil->getIdSysPerfil()>0)
            {
            $perfil->addIdSysAccion($accion);
            $em->persist($perfil); 

            $em->flush(); 
            echo "1";
            }
            else
            echo "0";   
            
            }
            else
            {
                  
                echo "NP";
                
            }
            return $this->render('GCBAStoreBundle:Default:vacio.html.twig',array(

            ));
           

     
       
   }   
   function delAccionAction()
   {                  
       
        $permisos = $this->get('gcba.security.permisos');
        $permisos->setJq(true);
        $permisos->setCurrentMethod(__METHOD__);
        $securityContext = $this->get('security.context');
        $user = $securityContext->getToken()->getUser();
       
         if ($permisos->tienePermiso($user,$securityContext))
        {
           
           
        
        
        $request = $this->getRequest();  
            $id=$request->query->get('id'); 
            $idperfil=$request->query->get('perfil');
            $em = $this->getDoctrine()->getManager();
            $accion = $this->getDoctrine()
            ->getRepository('GCBAStoreBundle:SysAccion')
            ->find($id); 
            $perfil = $this->getDoctrine()
            ->getRepository('GCBAStoreBundle:SysPerfil')
            ->find($idperfil); 
            if ($accion->getIdSysAccion()>0 and $perfil->getIdSysPerfil()>0)
            {
            $perfil->removeIdSysAccion($accion);
            $em->persist($perfil); 

            $em->flush(); 
            echo "1";
            }
            else
            echo "0";
        }  
        else
        {
            echo "NP";
        }       
            return $this->render('GCBAStoreBundle:Default:vacio.html.twig',array(

            ));
       
   }   

}