<?php

namespace GCBA\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GCBA\StoreBundle\Entity\SysModulo;
use Symfony\Component\HttpFoundation\Request;


use GCBA\StoreBundle\Form\Type\ModuloType;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ModuloController extends Controller
{
    public function indexAction()
    {
        return $this->render('GCBAStoreBundle:Default:index.html.twig');
    }
    public function AltaModuloAction(Request $request)
            {
            // crea una task y le asigna algunos datos ficticios para este ejemplo
            $permisos = $this->get('gcba.security.permisos');
            $permisos->setCurrentMethod(__METHOD__);
            $securityContext = $this->get('security.context');
            $user = $securityContext->getToken()->getUser();
            $response=$permisos->tienePermiso($user,$securityContext);
            if (!($response===true)) return $response;
            
            $modulo = new SysModulo();
            $em = $this->getDoctrine()->getManager();
            $form = $this->createForm(new ModuloType($request,$em,"alta"), $modulo);

  
            $form->handleRequest($request);
            if ($form->isValid()) {
            // guardar la tarea en la base de datos

          //  $this->get('session')->getFlashBag()->add('notice', ''.$modulo->getModulo()); 


            $em->persist($modulo); 
            $req = $this->getRequest();
            $em->flush(); 

            $this->get('session')->getFlashBag()->add('notice', ' modulo creado  ok: ');

            return $this->redirect($this->generateUrl('gcba_modulo_listar'));
            }
         
            return $this->render('GCBAStoreBundle:Default:f_alta_modulo.html.twig', array(
            'form' => $form->createView(),
            ));
    }
        
        public function mensaje($mens)
      {
          $this->get('session')->getFlashBag()->add('notice', $mens);   
      }    
      
        
        public function listarModuloAction()
{
        
        
        $permisos = $this->get('gcba.security.permisos');
        $permisos->setCurrentMethod(__METHOD__);
        $securityContext = $this->get('security.context');
        $user = $securityContext->getToken()->getUser();
        $response=$permisos->tienePermiso($user,$securityContext);
        if (!($response===true)) return $response;
        $em = $this->getDoctrine()->getManager();
        $modulo = new SysModulo();
        $request = $this->getRequest();
        $ids=$request->request->get('ids');
        
       // $this->mensaje(print_r($ids,true));
        if (is_array($ids))
        {     
            foreach ($ids as $id => $val)
            {

                $modulo = $this->getDoctrine()
                ->getRepository('GCBAStoreBundle:SysModulo')
                ->find($id);

                $em->remove($modulo);
                $em->flush();
                if (!$modulo) {
                throw $this->createNotFoundException(
                'existe el registro para el id '.$id
                );
                }
                else
                {
                             $this->get('session')->getFlashBag()->add('notice', 'El modulo '.$modulo->getNombre().' ha sido borrado');
                }    
            }    
        }
    
    
    
    $dql = "SELECT m FROM GCBAStoreBundle:SysModulo m ";
    $query = $em->createQuery($dql);

    $paginator = $this->get('knp_paginator');
    
    

    
    $pagination = $paginator->paginate(
        $query,
        $this->getRequest()->query->get('page', 1),
        10
    );  
    
 

    return $this->render(
        'GCBAStoreBundle:Default:listado_modulo.html.twig',
        compact('pagination')
    );  
}
   public function editarModuloAction($id)
   {
           
            $permisos = $this->get('gcba.security.permisos');
            $permisos->setCurrentMethod(__METHOD__);
            $securityContext = $this->get('security.context');
            $user = $securityContext->getToken()->getUser();
            $response=$permisos->tienePermiso($user,$securityContext);
            if (!($response===true)) return $response;
             
             
             $modulo = new SysModulo();
             $request = $this->getRequest();
             $modulo = $this->getDoctrine()
                ->getRepository('GCBAStoreBundle:SysModulo')
                ->find($id);
            $em = $this->getDoctrine()->getManager();
            $form = $this->createForm(new ModuloType($request,$em,"modificar"), $modulo);
            

            $form->handleRequest($request);   

            if ($form->isValid()) {
  

            
            $em = $this->getDoctrine()->getManager();
            $em->persist($modulo); 

            $em->flush();
            $req = $this->getRequest();
            $this->get('session')->getFlashBag()->add('notice', $req->query->get('nombre').' Modulo modificado  id: '.$modulo->getIdSysModulo() );



            return $this->redirect($this->generateUrl('gcba_modulo_listar'));
            }   
            return $this->render('GCBAStoreBundle:Default:f_editar_modulo.html.twig',array(
            'form' => $form->createView(),
            ));

   }  
}
