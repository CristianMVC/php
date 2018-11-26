<?php

namespace GCBA\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GCBA\StoreBundle\Entity\SysControlador;
use Symfony\Component\HttpFoundation\Request;



use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use GCBA\StoreBundle\Form\Type\ControladorType;
class ControladorController extends Controller
{
    public function indexAction()
    {
        return $this->render('GCBAStoreBundle:Default:index.html.twig');
    }
    public function AltaControladorAction(Request $request)
            {
            // crea una task y le asigna algunos datos ficticios para este ejemplo
            
            $permisos = $this->get('gcba.security.permisos');
            $permisos->setCurrentMethod(__METHOD__);
            $securityContext = $this->get('security.context');
            $user = $securityContext->getToken()->getUser();
            $response=$permisos->tienePermiso($user,$securityContext);
            if (!($response===true)) return $response;
            
            $controlador = new SysControlador();
            $em = $this->getDoctrine()->getManager();
            $form = $this->createForm(new ControladorType($request,$em,"alta"), $controlador);
            $form->handleRequest($request);
            if ($form->isValid()) {


          
            $em->persist($controlador); 
            $req = $this->getRequest();
            $em->flush(); 

            $this->get('session')->getFlashBag()->add('notice', ' controlador creado  ok: '.$controlador->getNombre());

            return $this->redirect($this->generateUrl('gcba_controlador_listar'));
            }
         
            return $this->render('GCBAStoreBundle:Default:f_alta_controlador.html.twig', array(
            'form' => $form->createView(),
            ));
    }
        
        public function mensaje($mens)
      {
          $this->get('session')->getFlashBag()->add('notice', $mens);   
      }    
      
        
        public function listarControladorAction()
{
        
        $permisos = $this->get('gcba.security.permisos');
        $permisos->setCurrentMethod(__METHOD__);
        $securityContext = $this->get('security.context');
        $user = $securityContext->getToken()->getUser();
        $response=$permisos->tienePermiso($user,$securityContext);
        if (!($response===true)) return $response;
        $em = $this->getDoctrine()->getManager();
        $controlador = new SysControlador();
        $request = $this->getRequest();
        $ids=$request->request->get('ids');
        
       // $this->mensaje(print_r($ids,true));
        if (is_array($ids))
        {     
            foreach ($ids as $id => $val)
            {

                $controlador = $this->getDoctrine()
                ->getRepository('GCBAStoreBundle:SysControlador')
                ->find($id);

                $em->remove($controlador);
                $em->flush();
                if (!$controlador) {
                throw $this->createNotFoundException(
                'existe el registro para el id '.$id
                );
                }
                else
                {
                             $this->get('session')->getFlashBag()->add('notice', 'El controlador '.$controlador->getNombre().' ha sido borrado');
                }    
            }    
        }
    
    
    
    $dql = "SELECT r FROM GCBAStoreBundle:SysControlador r";
    $query = $em->createQuery($dql);

    $paginator = $this->get('knp_paginator');
    $pagination = $paginator->paginate(
        $query,
        $this->getRequest()->query->get('page', 1),
        10
    );  

    return $this->render(
        'GCBAStoreBundle:Default:listado_controlador.html.twig',
        compact('pagination')
    );  
}
   public function editarControladorAction($id)
   {
           
            $permisos = $this->get('gcba.security.permisos');
            $permisos->setCurrentMethod(__METHOD__);
            $securityContext = $this->get('security.context');
            $user = $securityContext->getToken()->getUser();
              $response=$permisos->tienePermiso($user,$securityContext);
            if (!($response===true)) return $response;
             
             $controlador = new SysControlador();
             $request = $this->getRequest();
             $controlador = $this->getDoctrine()
                ->getRepository('GCBAStoreBundle:SysControlador')
                ->find($id);
                   $em = $this->getDoctrine()->getManager();
            $form = $this->createForm(new ControladorType($request,$em,"modificar"), $controlador);

            $form->handleRequest($request);   

            if ($form->isValid()) {

            
            $em = $this->getDoctrine()->getManager();
            $em->persist($controlador); 

            $em->flush();
            $req = $this->getRequest();
            $this->get('session')->getFlashBag()->add('notice', $req->query->get('nombre').' Controlador modificado  id: '.$controlador->getIdSysControlador() );



            return $this->redirect($this->generateUrl('gcba_controlador_listar'));
            }   
            return $this->render('GCBAStoreBundle:Default:f_editar_controlador.html.twig',array(
            'form' => $form->createView(),
            ));

   }  
}
