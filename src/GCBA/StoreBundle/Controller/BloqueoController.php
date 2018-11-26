<?php

namespace GCBA\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GCBA\StoreBundle\Entity\SysBloqueo;



use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class BloqueoController extends Controller
{

    private $bundle="GCBAStoreBundle";
    private $entity="GCBAStoreBundle:SysBloqueo";

    public function listarBloqueoAction(Request $request)
    {
        $permisos = $this->get('gcba.security.permisos');
        $permisos->setCurrentMethod(__METHOD__);
        $securityContext = $this->get('security.context');
        $user = $securityContext->getToken()->getUser();
         $response=$permisos->tienePermiso($user,$securityContext);
            if (!($response===true)) return $response;
     
        $entity="GCBAStoreBundle:SysBloqueo";
        $ids=$request->request->get('ids');
        $em = $this->getDoctrine()->getManager();
        $log=$this->get('gcba_log');     
                if (is_array($ids))
        {     
         
        
            foreach ($ids as $id => $val)
            {
                              
                                $bloqueo = $this->getDoctrine()
                                ->getRepository($this->entity)
                                ->find($id);
                              
                                if ($request->request->get('B')=="Borrar")
                                {    
                                    try {
                                    $bloqueo->setActivo(false);
                                   $em->persist($bloqueo);

                                 $em->flush();
                                           } 
                                catch (\Exception $e) {
                                    $error='no se puede borrar el bloqueo ';
                                    return $this->render("GCBAStoreBundle:Default:error.html.twig",array('status_code'=>'', 'status_text' => $error."/"
                                    
                                    ));     
                                }  
                         
                                 
                                }
                              
     
                
                
                if (!$bloqueo) {
                throw $this->createNotFoundException(
                'existe el registro para el id '.$id
                );
                }
                else
                {
                             $this->get('session')->getFlashBag()->add('notice', 'El registro de bloqueo del usuario '.$bloqueo->getIdSysUsuario()->getUsuario().' ha sido desactivado');
                             $log->log($user,__METHOD__,null,'El registro de bloqueo de{ usuario  '.$bloqueo->getIdSysUsuario()->getUsuario().' ha sido desactivado por el usuario '.$user->getUsuario()); 
                }    
            }    
        }/***/  
        $dataTables="";
        $datatables = $this->get('gcba_datatables');
        $datatables->setEntity($entity);
        $dataTables=$datatables->getGrilla(); 

        return $this->render(
            $this->bundle.':Default:listado_bloqueo.html.twig',
            array('dataTables' => $dataTables, 
            'tabla'=> "envio"

        ));
    }

    
}