<?php
namespace GCBA\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use GCBA\StoreBundle\Entity\SysRemitos;

class RemitoController extends Controller
{
    public function altaAction(Request $request)
    {
        
    $task = new SysRemitos();
    $em = $this->getDoctrine()->getEntityManager();
       
    $form = $this->createFormBuilder($task)
            ->add('Area', 'text')
            ->add('Descripcion', 'text')
            ->getForm();
            
            
    $form->handleRequest($request);  
    
    if ($form->isValid()) {
    $data = $form->getData();
    $em->persist($data);
    $em->flush();
    
    }
    
    return $this->render('GCBAStoreBundle:Remito:index.html.twig', array(
    'form' => $form->createView(),
    ));
    
    }
    
    
    
    public function buscarAction()
    {
        
    echo("esto es buscar");
    die();   
        
        
        
        

    }
    
}   