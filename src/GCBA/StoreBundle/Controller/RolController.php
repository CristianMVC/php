<?php
namespace GCBA\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use GCBA\StoreBundle\Entity\SysRol;
use GCBA\StoreBundle\Entity\SysRolDetalle;


class RolController extends Controller
{
    public function altaRolAction(Request $request)
    {
        
    $taskRol = new SysRol();
    $em = $this->getDoctrine()->getEntityManager();
       
    $form = $this->createFormBuilder($taskRol)
            ->add('nombre', 'text')
            ->add('descripcion', 'text')
            
            ->getForm();
            
            
    $form->handleRequest($request);  
  
    if ($form->isValid()) {
        
    try{    
    $data = $form->getData();
    $areas = explode(",", $request->request->get('areas'));
    $em->persist($data);
    $em->flush();
    } catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    
    }
    
    $SysRol =  $this->getDoctrine()
         ->getRepository('GCBAStoreBundle:SysRol')
         ->findOneBy(array('nombre' => $form->getData()->getNombre()));
     
    
    $taskDetalle =  new SysRolDetalle();
    foreach($areas as $area ){
    $taskDetalle->setId_rol($SysRol->getId());    
    $taskDetalle->setId_area($SysRol->getId()."_".$area);
    }
     
    $em->persist($taskDetalle);
    $em->flush(); 
       
    
    }
    
    return $this->render('GCBAStoreBundle:Rol:Rol.html.twig', array(
    'form' => $form->createView(),
    ));
       
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    public function agregarAreaAction(Request $request){
        
     $roles =  $this->getDoctrine()
               ->getRepository('GCBAStoreBundle:SysRol')
               ->findAll(); 
                  
        
      
     return $this->render('GCBAStoreBundle:Rol:Area.html.twig',array('roles'=>$roles));   
        
    }
    
    
    
    
    
    
    
    public function asignarRolAction()
    {
        
        
        
       echo "Rol";
       die(); 
        
        
        
       
    }
}   