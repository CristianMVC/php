<?php

namespace GCBA\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GCBA\StoreBundle\Entity\SysUsuario;
use Symfony\Component\HttpFoundation\Request;



use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use GCBA\StoreBundle\Validator\Constraints\ContainsPassword as PasswordConstraint;


use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
use GCBA\StoreBundle\Form\Type\UsuariosType;
use GCBA\StoreBundle\Form\Type\PasswordType;

class UsuarioController extends Controller
{
    public function indexAction()
    {


        return $this->render('GCBAStoreBundle:Default:index.html.twig');
    }
    public function AltaUsuarioAction(Request $request)
    {
        // crea una task y le asigna algunos datos ficticios para este ejemplo
        $permisos = $this->get('gcba.security.permisos');
        $permisos->setCurrentMethod(__METHOD__);
        $securityContext = $this->get('security.context');
        $user = $securityContext->getToken()->getUser();
        $response=$permisos->tienePermiso($user,$securityContext);
        if (!($response===true)) return $response;
        $usuario = new SysUsuario();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new UsuariosType($request,$em,"alta"), $usuario);
        $form->handleRequest($request);


        $request = $this->getRequest();
        $ids=$request->request->get('ids');
        $securityContext = $this->get('security.context');


        $session = $this->getRequest()->getSession();
        $session->set('filtro'," a.salt<>''" );
        $session->set('entity',"GCBAStoreBundle:SysUsuario" );   
        $dataTables="";
        $datatables = $this->get('gcba_datatables');
        $datatables->setEntity("GCBAStoreBundle:SysUsuario");
        $dataTables=$datatables->getGrilla();
        if ($form->isValid()) {
            // guardar la tarea en la base de datos
            $usuario->getUsuario();
            //  $this->get('session')->getFlashBag()->add('notice', ''.$usuario->getUsuario()); 
            $factory = $this->get('security.encoder_factory');


            $encoder = $factory->getEncoder($usuario);
            $password = $encoder->encodePassword($usuario->getPassword(), $usuario->getSalt());
            $usuario->setPassword($password);
            $usuario->setBorrado(false);
            $usuario->setPrimerLogin(false);
            $usuario->setLogeado(false);
            $em = $this->getDoctrine()->getManager();
            $em->persist($usuario); 
            $req = $this->getRequest();
            $em->flush(); 
            $id=$usuario->getIdSysUsuario();
            $log=$this->get('gcba_log');    
            $log->Log($user,"GCBADoctrineBundle::altaUsuario",null,"El usuario ".$user->getUsuario().' Dió de alta el  Usuario '.$usuario->getUsuario()." "); 

            $this->get('session')->getFlashBag()->add('notice', ' usuario creado  ok: ');

            return $this->redirect($this->generateUrl('gcba_usuario_editar',array('id' => $id)));
        }

        return $this->render('GCBAStoreBundle:Default:f_alta_usuario.html.twig', array(
            'form' => $form->createView(),'dataTables' => $dataTables
        ));
    }

    public function mensaje($mens)
    {
        $this->get('session')->getFlashBag()->add('notice', $mens);   
    }    


    public function listarUsuariosAction()
    {
        //  $campos[]="nombre";

        $permisos = $this->get('gcba.security.permisos');
        $permisos->setCurrentMethod(__METHOD__);
        $securityContext = $this->get('security.context');
        $user = $securityContext->getToken()->getUser();
        $response=$permisos->tienePermiso($user,$securityContext);
        if (!($response===true)) return $response;

        $em = $this->getDoctrine()->getManager();
        $usuario = new SysUsuario();

        $em = $this->getDoctrine()->getManager();

        $request = $this->getRequest();
        $ids=$request->request->get('ids');
        $securityContext = $this->get('security.context');


        $session = $this->getRequest()->getSession();
        $session->set('filtro'," a.salt<>''" );
        $session->set('entity',"GCBAStoreBundle:SysUsuario" );   
        $dataTables="";
        $datatables = $this->get('gcba_datatables');
        $datatables->setEntity("GCBAStoreBundle:SysUsuario");
        $dataTables=$datatables->getGrilla();

        return $this->render(
            'GCBAStoreBundle:Default:listado_usuario.html.twig',
            array('dataTables' => $dataTables )

        );  




    }
    public function editarUsuarioAction($id)
    {

        $permisos = $this->get('gcba.security.permisos');
        $permisos->setCurrentMethod(__METHOD__);
        $securityContext = $this->get('security.context');
        $user = $securityContext->getToken()->getUser();
        $response=$permisos->tienePermiso($user,$securityContext);
        if (!($response===true)) return $response;


        $request = $this->getRequest();
        $usuario = $this->getDoctrine()
        ->getRepository('GCBAStoreBundle:SysUsuario')
        ->find($id);


        if (!is_object($usuario))
        {

            throw new AccessDeniedException('El usuario No existe');   
        }   
        $passwordDb=$usuario->getPassword();   
        $Userdata=clone ($usuario);
        $securityContext = $this->get('security.context');
        $user = $securityContext->getToken()->getUser();
        $securityIdentity = UserSecurityIdentity::fromAccount($user);
        // $this->mensaje(print_r($user,true));
        try{
            if ($usuario->getSalt()=="")
            throw new AccessDeniedException('No se puede editar un usuario GCBA');  

        }
        catch (\Exception $e) {
            $error='error';
            return $this->render("GCBAStoreBundle:Default:error.html.twig",array('status_code'=> 444, 'status_text' => $error."/".$e->getMessage()

            ));     
        }            
        $em = $this->getDoctrine()->getManager();       
        $form = $this->createForm(new UsuariosType($request,$em,"modificar"), $usuario);
        $form->handleRequest($request);
        $session = $this->getRequest()->getSession();
        $session->set('filtro'," a.salt<>''" );
        $session->set('entity',"GCBAStoreBundle:SysUsuario" );   
        $dataTables="";
        $datatables = $this->get('gcba_datatables');
        $datatables->setEntity("GCBAStoreBundle:SysUsuario");
        $dataTables=$datatables->getGrilla();


        if ($form->isValid()) {

            if (trim($usuario->getPassword())<>"")
            {
                $factory = $this->get('security.encoder_factory');
                $encoder = $factory->getEncoder($usuario);
                $password = $encoder->encodePassword($usuario->getPassword(), $usuario->getSalt());
                $usuario->setPassword($password);
                $usuario->setPrimerLogin(1);
            }
            else
                $usuario->setPassword($passwordDb);


            $em->persist($usuario); 

            $em->flush();
            $log=$this->get('gcba_log');    
            $log->Log($user,"GCBADoctrineBundle::editarUsuario",null,"El usuario ".$user->getUsuario().' Modificó el  Usuario '.$usuario->getUsuario()." ",$Userdata,$usuario);  
            $req = $this->getRequest();
            $this->get('session')->getFlashBag()->add('notice', $req->query->get('nombre').' Usuario modificado  id: '.$usuario->getIdSysUsuario() );

            // foreach ($roles as $val)
            //  echo "<br> aa".$val;

          
        }   
        return $this->render('GCBAStoreBundle:Default:f_editar_usuario.html.twig',array(
            'form' => $form->createView()
            ,'dataTables' => $dataTables

        ));

    }

    public function verInfoUsuarioAction()
    {          
        $request = $this->getRequest();  
        $id=$request->query->get('id');     

        $resultado="";
        $sysusuario = $this->getDoctrine()
        ->getRepository('GCBAStoreBundle:SysUsuario')
        ->find($id);
        $em = $this->getDoctrine()->getManager();          
        $perfiles=$em->createQuery('SELECT p FROM GCBAStoreBundle:SysPerfil p')->getResult(); 


        $perfiles_asignados=$sysusuario->getPerfiles();
        $usuario["id"]=$sysusuario->getIdSysUsuario();
        $usuario["nombre"]=$sysusuario->getNombre();
        $usuario["apellido"]=$sysusuario->getApellido();
        foreach ($perfiles_asignados as $perfil)
        {
            $PerfilesA[$perfil->getIdSysPerfil()]=$perfil->getNombre();   
        }
        $perfil="";
        $combo_perfiles=array();
        foreach ($perfiles as $perfil)
        {

            if (!isset($PerfilesA[$perfil->getIdSysPerfil()]))
            {
                $combo_perfiles[$perfil->getIdSysPerfil()]["id"]=$perfil->getIdSysPerfil();  
                $combo_perfiles[$perfil->getIdSysPerfil()]["nombre"]=$perfil->getNombre();    
            }
        }


        return $this->render('GCBAStoreBundle:Default:verinfo_usuario.html.twig',array(
            'perfiles' => $combo_perfiles,
            'perfiles_asignados' => $perfiles_asignados,
            'usuario' => $usuario,
        ));

    }


    function addPerfilAction()
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
            $usuario = $this->getDoctrine()
            ->getRepository('GCBAStoreBundle:SysUsuario')
            ->find($id); 
            $perfil = $this->getDoctrine()
            ->getRepository('GCBAStoreBundle:SysPerfil')
            ->find($idperfil); 
            if ($usuario->getIdSysUsuario()>0 and $perfil->getIdSysPerfil()>0)
            {
                $usuario->addIdSysPerfil($perfil);
                $em->persist($usuario); 

                $em->flush();
                $log=$this->get('gcba_log'); 
                $log->Log($user,"GCBAStoreBundle::addPerfil",null,"El usuario ".$user->getUsuario().' Dio de alta el perfil '.$perfil->getNombre()." al usuario ".$usuario->getUsuario());    
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
    function delPerfilAction()
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
            $usuario = $this->getDoctrine()
            ->getRepository('GCBAStoreBundle:SysUsuario')
            ->find($id); 
            $perfil = $this->getDoctrine()
            ->getRepository('GCBAStoreBundle:SysPerfil')
            ->find($idperfil); 
            if ($usuario->getIdSysUsuario()>0 and $perfil->getIdSysPerfil()>0)
            {
                $usuario->removeIdSysPerfil($perfil);
                $em->persist($usuario); 

                $em->flush();
                $log=$this->get('gcba_log'); 
                $log->Log($user,"GCBAStoreBundle::delPerfil",null,"El usuario ".$user->getUsuario().'Le quitó el perfil '.$perfil->getNombre()." al usuario ".$usuario->getUsuario());   
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
    public function cambiarPasswordAction(Request $request)
    {       

        // crea una task y le asigna algunos datos ficticios para este ejemplo


        $permisos = $this->get('gcba.security.permisos');
        $permisos->setCurrentMethod(__METHOD__);
        $securityContext = $this->get('security.context');
        $user = $securityContext->getToken()->getUser();
        $response=$permisos->tienePermiso($user,$securityContext);
        if (!($response===true)) return $response;
        $id=$user->getIdSysUsuario();
        $em = $this->getDoctrine()->getManager();
        $nombre=$user->getUsuario();

        $usuario = $this->getDoctrine()
        ->getRepository('GCBAStoreBundle:SysUsuario')
        ->find($id);
        if ($user->getSalt()<>"")
        {
            $post=$request->request->get('form');
            $claveant=$post["claveant"];
            $clavenueva=$post["clavenueva"];

            $clavenueva2=$post["clavenueva2"];
            $form = $this->createForm(new PasswordType($request,$em,"",array('usuario'=> $nombre)), array());            



            $form->handleRequest($request);  

            $PasswordConstraint = new PasswordConstraint();
            $PasswordConstraint->message = 'la password es incorrecta';
            $errorList = $this->get('validator')->validateValue(
                $clavenueva,
                $PasswordConstraint 
            );        

            if ($form->isValid()) {

                if (count($errorList) == 0)
                {  

                    //   echo $usuario->getPassword().$claveant." -> ".$clavenueva."->".$clavenueva2;
                    ///  exit;
                    //  $this->get('session')->getFlashBag()->add('notice', ''.$usuario->getUsuario()); 
                    $factory = $this->get('security.encoder_factory');

                    $encoder = $factory->getEncoder($usuario);
                    ;               


                    if ($usuario->getPassword()==$encoder->encodePassword($claveant, $usuario->getSalt()))
                    { 

                        if ($clavenueva==$clavenueva2)
                        {    
                            $password = $encoder->encodePassword($clavenueva, $usuario->getSalt());
                            $usuario->setPassword($password);
                            $usuario->setPrimerLogin(0);

                            $em->persist($usuario); 
                            $req = $this->getRequest();
                            $em->flush(); 
                            $this->get('session')->getFlashBag()->add('notice', 'contraseña cambiada ok: '); 
                            $log=$this->get('gcba_log'); 
                            $log->Log($user,"GCBAStoreBundle::cambiarPassword",null,"El usuario ".$user->getUsuario().'Se cambió la contraseña ');  
                        }
                        else
                        {
                            $this->get('session')->getFlashBag()->add('error', 'las contraseñas no coinciden ');

                        }
                    }
                    else
                    {

                        $this->get('session')->getFlashBag()->add('error', 'las contraseña anterior es incorrecta');  

                    }
                    // return $this->redirect($this->generateUrl('gcba_usuario_homepage'));

                }
                else
                {

                    $this->get('session')->getFlashBag()->add('error', $errorList[0]->getMessage());  
                }

            }


            return $this->render('GCBAStoreBundle:Default:f_cambiarpassword.html.twig',array(
                'form' => $form->createView(),
                'user' => $user
            ));
        }
        else
            return $this->render('GCBAStoreBundle:Default:f_cambiarpassword.html.twig',array(

                'user' => $user
            ));


    }

}

