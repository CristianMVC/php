<?php

    namespace GCBA\StoreBundle\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use GCBA\StoreBundle\Entity\SysUsuario;
    use Symfony\Component\HttpFoundation\Request;



    use Symfony\Component\HttpFoundation\Response;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

    class UsuarioGcbaController extends Controller
    {
        public function indexAction()
        {
            return $this->render('GCBAStoreBundle:Default:index.html.twig');
        }
        public function mensaje($mensaje,$error=false)
        {
            if ($error==false)
                $label="notice";
            else
                $label="error";
            $this->get('session')->getFlashBag()->add($label, $mensaje);    
        }    

        public function listarUsuariosGcbaAction()
        {
            $permisos = $this->get('gcba.security.permisos');
            $permisos->setCurrentMethod(__METHOD__);
            $securityContext = $this->get('security.context');
            $user = $securityContext->getToken()->getUser();
            $response=$permisos->tienePermiso($user,$securityContext);
            if (!($response===true)) return $response;      
            $log=$this->get('gcba_log');    
            $em = $this->getDoctrine()->getManager();
            $usuario = new SysUsuario();
            $request = $this->getRequest();

            $correo=$request->request->get('usuario');
            $dominio=$request->request->get('dominio');
            //  $this->mensaje("dominio $correo");
            if ($correo<>"")
            {




                $email=$correo."@".$dominio;
                $usuario_buscar = $this->getDoctrine()
                ->getRepository('GCBAStoreBundle:SysUsuario')
                ->findOneByCorreo($email);
                $usuario->setWs($this->container->getParameter('url_webservice'));
                $datos_usuario=$usuario->getDatosporEmail($email);

                if (!is_object($usuario_buscar))
                {

                    if (is_array($datos_usuario))
                    {
                        $usuario->setNombre($datos_usuario['nombre']);
                        $usuario->setApellido($datos_usuario['apellido']);
                        $usuario->setUsuario($email);
                        $usuario->setCorreo($email);
                      //  if (array_key_exists("numero_cui",$datos_usuario))
                    //        $usuario->setCuil($datos_usuario["numero_cui"]);
                        $usuario->setBorrado(false);
                        $usuario->setPrimerLogin(false);
                        $usuario->setLogeado(false);
                        $usuario->setActivo(true);
                        $usuario->setSalt('');
                        $em->persist($usuario); 
                        $em->flush();
                        $req = $this->getRequest(); 
                        $this->mensaje('Se dio de alta el usuario '.$usuario->getNombre()." ".$usuario->getApellido()." ".$email);
                        $log->Log($user,"GCBAStoreBundle::listarUsuariosGcba",null,"El usuario ".$user->getUsuario().' Dio de alta el usuario '.$usuario->getUsuario()." "); 
                    }
                    else
                    {
                        $this->mensaje('No se encontro el usuario  '.$email. 'en el ldap',true);

                    }    
                }
                else
                {


          
                    if (array_key_exists("numero_cui",$datos_usuario))
                        $usuario_buscar->setCuil($datos_usuario["numero_cui"]);
                    $em->persist($usuario_buscar); 
                    $em->flush();



                    $this->mensaje('Ya existe el usuario  '.$usuario_buscar->getNombre()." ".$usuario_buscar->getApellido()." en la base de datos con el correo ".$email,true);
                }    
            }    

            $ids=$request->request->get('ids');



            if (is_array($ids))
            {     
                foreach ($ids as $id => $val)
                {

                    $usuario = $this->getDoctrine()
                    ->getRepository('GCBAStoreBundle:SysUsuario')
                    ->find($id);

                    $em->remove($usuario);
                    $em->flush();
                    if (!$usuario) {
                        throw $this->createNotFoundException(
                            'existe el registro para el id '.$id
                        );
                    }
                    else
                    {
                        $this->get('session')->getFlashBag()->add('notice', 'El usuario '.$usuario->getUsuario().' ha sido borrado');
                    }    
                }    
            }

            $session = $this->getRequest()->getSession();
            $session->set('filtro'," a.salt=''" );
            $session->set('entity',"GCBAStoreBundle:SysUsuario" );    
            $dataTables="";
            $datatables = $this->get('gcba_datatables');
            $datatables->setEntity("GCBAStoreBundle:SysUsuario");
            $datatables->setOcultarEditar(true);
            $dataTables=$datatables->getGrilla();

            //define("FILTRO"," "
            return $this->render(
                'GCBAStoreBundle:Default:listado_usuariogcba.html.twig',
                array('dataTables' => $dataTables )

            );  
        }
        function printArray($array,$return=false)
        {
            echo "<pre>";
            print_r($array,$return);
            echo "</pre>";

        }
    }
