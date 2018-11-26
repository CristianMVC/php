<?php

    namespace GCBA\StoreBundle\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use GCBA\StoreBundle\Entity\SysAccion;
    use Symfony\Component\HttpFoundation\Request;


    use GCBA\StoreBundle\Form\Type\AccionType;
    use GCBA\StoreBundle\Entity\SysModulo;
    use GCBA\StoreBundle\Entity\SysControlador;
    use GCBA\StoreBundle\Form\Type\SyncType;
    use Symfony\Component\HttpFoundation\Response;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
    use GCBA\StoreBundle\Helper\SyncMenu;


    class AccionController extends Controller
    {
        public function indexAction()
        {
            return $this->render('GCBAStoreBundle:Default:index.html.twig');
        }
        public function AltaAccionAction(Request $request)
        {

            $permisos = $this->get('gcba.security.permisos');
            $permisos->setCurrentMethod(__METHOD__);
            $securityContext = $this->get('security.context');
            $user = $securityContext->getToken()->getUser();
            $response=$permisos->tienePermiso($user,$securityContext);
            if (!($response===true)) return $response;
            $accion = new SysAccion();
            $em = $this->getDoctrine()->getManager();
            $form = $this->createForm(new AccionType($request,$em,"alta"), $accion);
            $form->handleRequest($request);
            /****************************************/
            $ids=$request->request->get('ids');
            // $this->mensaje(print_r($ids,true));
            if (is_array($ids))
            {     
                foreach ($ids as $id => $val)
                {

                    $Accion = $this->getDoctrine()
                    ->getRepository('GCBAStoreBundle:SysAccion')
                    ->find($id);

                    $em->remove($Accion);
                    $em->flush();
                    if (!$accion) {
                        throw $this->createNotFoundException(
                            'existe el registro para el id '.$id
                        );
                    }
                    else
                    {
                        $this->get('session')->getFlashBag()->add('notice', 'El accion '.$accion->getNombre().' ha sido borrado');
                    }    
                }    
            }
            $dataTables="";
            $datatables = $this->get('gcba_datatables');
            $datatables->setEntity("GCBAStoreBundle:SysAccion");
            $dataTables=$datatables->getGrilla();       
            /****************************************/
            if ($form->isValid()) {
                $em->persist($accion); 
                $req = $this->getRequest();
                $em->flush(); 
                $this->get('session')->getFlashBag()->add('notice', ' accion creada  ok: ');
                return $this->redirect($this->generateUrl('gcba_accion_alta'));
            }

            return $this->render('GCBAStoreBundle:Default:f_alta_accion.html.twig', array(
                'form' => $form->createView(), 'dataTables' => $dataTables 
            ));
        }

        public function mensaje($mens)
        {
            $this->get('session')->getFlashBag()->add('notice', $mens);   
        }    


        public function listarAccionAction()
        {

            $permisos = $this->get('gcba.security.permisos');
            $permisos->setCurrentMethod(__METHOD__);
            $securityContext = $this->get('security.context');
            $user = $securityContext->getToken()->getUser();
            $response=$permisos->tienePermiso($user,$securityContext);
            if (!($response===true)) return $response;

            $em = $this->getDoctrine()->getManager();
            $accion = new SysAccion();
            $request = $this->getRequest();
            $ids=$request->request->get('ids');

            // $this->mensaje(print_r($ids,true));
            if (is_array($ids))
            {     
                foreach ($ids as $id => $val)
                {

                    $accion = $this->getDoctrine()
                    ->getRepository('GCBAStoreBundle:SysAccion')
                    ->find($id);

                    $em->remove($accion);
                    $em->flush();
                    if (!$accion) {
                        throw $this->createNotFoundException(
                            'existe el registro para el id '.$id
                        );
                    }
                    else
                    {
                        $this->get('session')->getFlashBag()->add('notice', 'El accion '.$accion->getNombre().' ha sido borrado');
                    }    
                }    
            }




            $dataTables="";
            $datatables = $this->get('gcba_datatables');
            $datatables->setEntity("GCBAStoreBundle:SysAccion");
            $dataTables=$datatables->getGrilla();       
            return $this->render(
                'GCBAStoreBundle:Default:listado_accion.html.twig',
                array('dataTables' => $dataTables )
            );  
        }
        public function editarAccionAction($id)
        {

            $permisos = $this->get('gcba.security.permisos');
            $permisos->setCurrentMethod(__METHOD__);
            $securityContext = $this->get('security.context');
            $user = $securityContext->getToken()->getUser();
            $response=$permisos->tienePermiso($user,$securityContext);
            if (!($response===true)) return $response;
            $request = $this->getRequest();
            $accion = $this->getDoctrine()
            ->getRepository('GCBAStoreBundle:SysAccion')
            ->find($id);   
            $em = $this->getDoctrine()->getManager();
            $form = $this->createForm(new AccionType($request,$em,"modificar"), $accion);  
            $form->handleRequest($request);   
            /****************************************/
            $enc=false;
            $request = $this->getRequest();
            $ids=$request->request->get('ids');
            // $this->mensaje(print_r($ids,true));
            if (is_array($ids))
            {     
                foreach ($ids as $id => $val)
                {

                    $accion = $this->getDoctrine()
                    ->getRepository('GCBAStoreBundle:SysAccion')
                    ->find($id);

                    $em->remove($accion);
                    $em->flush();
                    if (!$accion) {
                        throw $this->createNotFoundException(
                            'existe el registro para el id '.$id
                        );
                    }
                    else
                    {
                        $this->get('session')->getFlashBag()->add('notice', 'El accion '.$accion->getNombre().' ha sido borrado');
                        $enc=true;
                    }    
                }
                if ($enc==true)
                return $this->redirect($this->generateUrl('gcba_accion_alta'));    
            }
            $dataTables="";
            $datatables = $this->get('gcba_datatables');
            $datatables->setEntity("GCBAStoreBundle:SysAccion");
            $dataTables=$datatables->getGrilla();       
            /****************************************/

            if ($form->isValid()) {



                $em = $this->getDoctrine()->getManager();
                $em->persist($accion); 

                $em->flush();
                $req = $this->getRequest();
                $this->get('session')->getFlashBag()->add('notice', $req->query->get('nombre').' Accion modificado  id: '.$accion->getIdSysAccion() );



                
            }   
            return $this->render('GCBAStoreBundle:Default:f_editar_accion.html.twig',array(
                'form' => $form->createView(),  'dataTables' => $dataTables 
            ));

        }  
        function SyncMenuAction(Request $request)
        {
            $em = $this->getDoctrine()->getManager();
            $sync=array();
            $form = $this->createForm(new SyncType($request,$em,"alta"), $sync);
            $form->handleRequest($request);

            if ($form->isValid()) {
                $datos=$request->request->get('form');
                if (array_key_exists("Importar",$datos))
                {
                    if ($datos["xml"]=="")
                    {
                        $this->get('session')->getFlashBag()->add('error', 'falta el xml para importar' );
                    }
                    else
                    {

                        $xml=$datos["xml"];
                        try{
                            $this->importarXmlMenu($xml);
                        }  
                        catch(\Exception $e){
                            $error="xml invalido";
                            return $this->render("GCBAStoreBundle:Default:error.html.twig",array('status_code'=>  $GestorWs->getErrorCode(),'status_msg' => $GestorWs->getError(),'exception' => $e, 'status_text' => $error

                            ));  
                        }


                        $this->get('session')->getFlashBag()->add('error', 'Las acciones del menmu fueron importadas debe agregar los permisos para las nuevas acciones en la opcion perfil accion' );
                    }
                }
                if (array_key_exists("Exportar",$datos))
                {
                    $this->get('session')->getFlashBag()->add('error', 'Exportando Menu' );

                }


            } 

            return $this->render('GCBAStoreBundle:Default:f_syncMenu.html.twig',array('form' => $form->createView()));
        }

        private function printArray($array,$return=false)
        {
            echo "<pre>";
            print_r($array,$return);
            echo "</pre>";

        }
        function getXmlAction()
        {
            ob_start();
            header("Content-type: text/xml");
            header("Content-Disposition: attachment;filename=menu.xml");
            header("Pragma: no-cache");
            header("Expires: 0");      
            echo $this->generarXmlMenu();
            return $this->render('GCBAStoreBundle:Default:vacio.html.twig',array(

            )); 

        } 
        function generarXmlMenu()
        {
            $xmlClass = new SyncMenu("datosMenu");
            $em = $this->getDoctrine()->getManager();
            $acciones = $this->getDoctrine()
            ->getRepository('GCBAStoreBundle:SysAccion')
            ->findall();
            $datos=array();
            foreach ($acciones as $Accion)
            {
                if (is_object($Accion))
                {
                    $accion=array();
                    $accion["idSysAccion"]=$Accion->getIdSysAccion();
                    if ($Accion->getEsMenu()==true)
                        $esMenu="1";
                    else
                        $esMenu="0";
                    $accion["esMenu"]=$esMenu;
                    $accion["nombre"]=$Accion->getNombre();
                    $accion["nombreMenu"]=$Accion->getNombreMenu();
                    $accion["descripcion"]=$Accion->getDescripcion();
                    $accion["orden"]=$Accion->getOrden();
                    if ($Accion->getBorrado()==true)
                        $borrado="1";
                    else
                        $borrado="0";
                    if ($Accion->getValidarPhpsessid()==true)
                        $validarPhpsessid="1";
                    else
                        $validarPhpsessid="0";
                    if ($Accion->getEsMenuDestacado()==true)
                        $esMenuDestacado="1";
                    else
                        $esMenuDestacado="0";
                    if ($Accion->getLogear()==true)
                        $logear="1";
                    else
                        $logear="0";
                    $accion["borrado"]=$borrado;
                    $accion["logear"]=$logear;
                    $accion["validarPhpsessid"]=$validarPhpsessid;
                    $accion["esMenuDestacado"]=$esMenuDestacado;
                    $accion["nombreRoute"]=$Accion->getNombreRoute();

                    $accion["modulo"]=$Accion->getIdSysModulo()->getNombre();
                    $accion["controlador"]=$Accion->getIdSysControlador()->getNombre();
                    $datos[]=$accion;
                }

            }
            // $this->printArray($datos);exit;

            return $xmlClass->generarXml($datos);
        }
        function importarXmlMenu($xml)
        {
            $xmlClass = new SyncMenu("datosMenu");
            $xmlClass->setCampoId("idSysAccion");

            $datos=$xmlClass->getDatos($xml);
            if (is_array($datos) && count($datos)>0)
            {
                foreach ($datos as $id => $accion)
                {

                    $em = $this->getDoctrine()->getManager();
                    $acciones=array();
                    $acciones = $this->getDoctrine()
                    ->getRepository('GCBAStoreBundle:SysAccion')
                    ->findByNombre($accion["nombre"]);
                    if (count($acciones)<1)
                    {


                        $modulos=array();
                        $controladores=array();
                        $Modulo=null;
                        $Controlador=null;
                        $modulos = $this->getDoctrine()
                        ->getRepository('GCBAStoreBundle:SysModulo')
                        ->findByNombre($accion["modulo"]);
                        if (count($modulos)>0)
                        {
                            foreach ($modulos as $Modulo)
                            {

                            }
                        }
                        else
                        {
                            $Modulo=new SysModulo();
                            $Modulo->setNombre($accion["modulo"]);
                            $Modulo->setDescripcion($accion["modulo"]);
                            $Modulo->setOrden(rand(3,19));
                            $Modulo->setBorrado('0');
                            $em->persist($Modulo);
                            $em->flush();


                        }
                        $controladores = $this->getDoctrine()
                        ->getRepository('GCBAStoreBundle:SysControlador')
                        ->findByNombre($accion["controlador"]); 
                        if (count($controladores)>0)
                        {
                            foreach ($controladores as $Controlador)
                            {

                            }
                        }
                        else
                        {
                            $Controlador=new SysControlador();
                            $Controlador->setNombre($accion["controlador"]);
                            $Controlador->setBorrado('0');
                            $em->persist($Controlador);
                            $em->flush();


                        }
                        if (is_object($Modulo) && is_object($Controlador))
                        {
                            $Accion=new SysAccion();
                            $Accion->setIdSysModulo($Modulo);
                            $Accion->setIdSysControlador($Controlador);
                            $Accion->setesMenu($accion["esMenu"]);
                            $Accion->setNombre($accion["nombre"]);
                            $Accion->setNombreMenu($accion["nombreMenu"]);
                            $Accion->setDescripcion($accion["descripcion"]);
                            $Accion->setOrden($accion["orden"]);
                            $Accion->setBorrado($accion["borrado"]);
                            $Accion->setValidarPhpsessid($accion["validarPhpsessid"]);
                            $Accion->setEsMenuDestacado($accion["esMenuDestacado"]);
                            $Accion->setLogear($accion["logear"]);
                            $Accion->setNombreRoute($accion["nombreRoute"]);
                            $em->persist($Accion);
                            $em->flush();
                        }
                        else
                        {

                            $error="no se encontro el modulo o controlador ".$accion["modulo"]."/ ".$accion["controlador"];
                            return $this->render("GCBAStoreBundle:Default:error.html.twig",array('status_code'=>  "",'status_msg' => $error,'exception' => "", 'status_text' => $error

                            ));  
                        }

                    }


                }

            }
            else
            {
                $error="xml invalido!!";
                return $this->render("GCBAStoreBundle:Default:error.html.twig",array('status_code'=>  "",'status_msg' => $error,'exception' => "", 'status_text' => $error

                ));  

            }


            return true;
        }
    }
