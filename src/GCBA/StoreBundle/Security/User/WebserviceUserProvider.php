<?php

    namespace GCBA\StoreBundle\Security\User;
    use Symfony\Component\Security\Core\User\UserProviderInterface;
    use Symfony\Component\Security\Core\User\UserInterface;
    use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
    use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
    use Symfony\Component\Security\Core\Exception\BadCredentialsException;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Security\Core\User\User;
    use Symfony\Component\DependencyInjection\ContainerInterface;
    use Symfony\Component\HttpFoundation\Session\Session;
    use Symfony\Component\Security\Core\Exception\AccessDeniedException;
    use GCBA\StoreBundle\Entity\SysBloqueo;
    use GCBA\StoreBundle\Entity\SysUsuario;



    class WebserviceUserProvider implements UserProviderInterface 
    {
        private $service;
        private $em;
        private $password="";

        private $request;
        private $usuario;
        private $user;
        private $tipoUsuario;    
        public function setRequest( ContainerInterface $container, $doctrine ) {

            $this->container=$container;
            $this->request = $container->get('request');

            $this->doctrine=$doctrine;

        }
        public function validarUsuario($usuario,$clave)
        {
            $this->usuario=$usuario;
            switch ($this->tipoUsuario)
            {
                /**
                *  es Usuario GCBA
                */
                case 1:
                    if (strpos($usuario,"@buenosaires.gob.ar")===false)
                        $usuario.="@buenosaires.gob.ar";
                    $this->usuario=$usuario;
                    $this->client = new \nusoap_client($this->container->getParameter('url_webservice'));              
                    $res=$this->client->call('validar',array( 'email'=>$usuario,'clave'=>$clave));     
                    $res=trim($res);  
                    if ($res==1)
                    {

                        return true;
                    }
                    else
                    {

                        return false;
                    }
                    break;
                    /**
                    *  es usuario Interno   
                    */
                case 2:

                    $users=$this->doctrine->getRepository('GCBAStoreBundle:SysUsuario')->findByUsuario($usuario); 
                    if (is_array($users))
                    {
                        $user=$users[0];
                        $factory = $this->container->get('security.encoder_factory');
                        $encoder = $factory->getEncoder($user);
                        $passwordEncriptada = $encoder->encodePassword($clave, $user->getSalt());

                        if ($passwordEncriptada==$user->getPassword())
                        {

                            return true;
                        }
                        else
                        {

                            return false;
                        } 
                    }
                    break;   
                default:
                    return false;   
            }




        }
        /**
        * Tipo de usuario
        *   
        * @param mixed $username
        * @return 1 usuario GCBA 2 Usuario interno false no se encontro el usuario
        */


        private function tipoUsuario($username)
        {


            if (strpos($username,"@buenosaires.gob.ar")===false)
            {
                $users=$this->doctrine->getRepository('GCBAStoreBundle:SysUsuario')->findByUsuario($username);  
                foreach ($users as $user)
                {   
                    if (is_object($user))
                    {
                        if ($user->getSalt()<>"")
                        {
                            $this->user=$user;
                            $this->tipoUsuario=2;
                            return true;
                        }
                    }

                } 
            }
            $username.="@buenosaires.gob.ar";
            $users=$this->doctrine->getRepository('GCBAStoreBundle:SysUsuario')->findByUsuario($username);  
            foreach ($users as $user)
            {   
                if (is_object($user))
                {
                    if ($user->getSalt()=="")
                    {
                        $this->user=$user;
                        $this->tipoUsuario=1;
                        return true;
                    }
                }

            } 


            return false; 
        } 
        public function loadUserByUsername($username)
        {


            $password=$this->request->get('_password');
            $form=$this->request->get('form');
            $session=$this->container->get('session');
            if ($this->container->getParameter('captcha_enabled')==true && !array_key_exists("captcha",$form))
            {
                throw new BadCredentialsException('El código captcha es incorrecto.', 0);   

            }   
            if ($session->get('numlogin')>0 && !array_key_exists("captcha",$form))
            {
                throw new BadCredentialsException('El código captcha es incorrecto.', 0);   

            } 
            if (is_array($form) && array_key_exists("captcha",$form))
            {
                
                $session_captcha=$session->get("gcb_captcha");
                $captcha=$form["captcha"];
                $phrase=$session_captcha["phrase"];
                if (trim($captcha)<>trim($phrase))
                {
                    throw new BadCredentialsException('El código captcha es incorrecto.', 0);   

                }

            }

            $numlogin=$session->get('numlogin')+1;
            $session->set('numlogin',$numlogin);
            $now = new \DateTime();
            $username=trim($username);
            $password=trim($password);
            $this->tipoUsuario($username);
            $log=$this->container->get('gcba_log'); 
            $em=$this->doctrine->getManager();

            if (is_object($this->user))
            {
                $bloqueos = $this->doctrine
                ->getRepository('GCBAStoreBundle:SysBloqueo')
                ->findByIdSysUsuario($this->user->getIdSysUsuario());

                foreach ($bloqueos as $bloqueo)
                {  
                    if (is_object($bloqueo))
                    { 
                        if ($bloqueo->getActivo()==true)
                        {
                            if ($bloqueo->getBloqueadoHasta()>=$now)
                            {

                                if (DEBUG==true)
                                    throw new AccessDeniedException('Su cuenta fue bloqueada por intentos fallidos hasta '.$bloqueo->getBloqueadoHasta()->format('d/m/Y H:i').'');
                                else
                                    throw new AccessDeniedException('Los datos suministrados son incorrectos');
                            }
                            else
                            {

                                $log->Log($this->user,"GCBAStoreBundle::login",null,"El usuario ".$this->user->getUsuario()." fue desbloqueado al expirar el tiempo de bloqueo");
                                $bloqueo->setActivo(false);  
                                $em->persist($bloqueo);
                                $em->flush();
                                $this->user->setIntentoLoginFallido(0);
                                $em->persist($this->user);
                                $em->flush();
                            }
                        }
                    }  

                }      
            }

            $salt="";

            if ($this->validarUsuario($username,$password)==true)
            {



                if (!is_object($this->user))
                {


                    throw new AccessDeniedException('No tiene permisos para ingresar al sistema<br>');




                }


                $session = $this->request->getSession();
                $session->set('errorlogin',false);



                $this->user->setIntentoLoginFallido(0);
                $em->persist($this->user);
                $em->flush();
                $roles=array();
                if ($this->user)
                {
                    $roles=$this->user->getRoles();   
                }    

                return new WebserviceUser($username, $password, $salt, $roles,$this->user); 

            }  
            else
            {


                if (is_object($this->user))
                {

                    $c=$this->user->getIntentoLoginFallido();
                    $session = $this->request->getSession();
                    $session->set('errorlogin', true);
                    $c++;

                    $log->Log($this->user,"GCBAStoreBundle::login",null,"El usuario ".$this->user->getUsuario()." no pudo ingresar por contraseña incorrecta");
                    if ($c>=3)
                    {
                        $fecha = new \DateTime();
                        $fecha->modify('+10 mins');  
                        $bloqueo=new SysBloqueo();
                        $bloqueo->setBloqueadoHasta($fecha);
                        $bloqueo->setActivo(true);
                        $bloqueo->setIdSysUsuario($this->user);
                        $bloqueo->setBloqueadoDesde($now);
                        $log->Log($this->user,"GCBAStoreBundle::login",null,"El usuario ".$this->user->getUsuario()." fue bloqueado por ingresar 3 veces la contraseña incorrecta hasta la fecha-> ".$fecha->format("d/m/Y h:i:s"));
                        $this->user->setIntentoLoginFallido(0);
                        $em->persist($bloqueo);
                        $em->flush();

                    }
                    else
                        $this->user->setIntentoLoginFallido($c);  
                    $this->user->setfechaUltimoIntentoFallido(new \DateTime()); 
                    $em->persist($this->user);
                    $em->flush();   
                }


            }   




            throw new UsernameNotFoundException(
                sprintf('Username "%s" does not exist.', $username)
            );  
        }

        public function refreshUser(UserInterface $user)
        {
            if (!$user instanceof WebserviceUser) {
                throw new UnsupportedUserException(
                    sprintf('Instances of "%s" are not supported.', get_class($user))
                );
            }     
            if ($user->getIdSysUsuario()>0)
            {
                $usuario=$this->doctrine->getRepository('GCBAStoreBundle:SysUsuario')->find($user->getIdSysUsuario()); 



                return $usuario; 
            }  
        }

        public function supportsClass($class)
        {

            return $class === 'GCBA\StoreBundle\Security\User\WebserviceUser';
        }




    }
