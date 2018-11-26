<?php
namespace GCBA\StoreBundle\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;





class SecurityController extends Controller
{
    

    
    public function loginAction(Request $request)
    {
           $session = $request->getSession();
         if ($this->container->getParameter('captcha_enabled')==true or $session->get('numlogin')>0)
         return $this->logincaptchaAction($request);
         
            
        $session = $request->getSession();
           
        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR
            );
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }
        
    

        return $this->render(
            'GCBAStoreBundle:Security:login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                'error'         => $error
               
                
                 
            )
        );
    
    }


    public function logincaptchaAction(Request $request)
    {
        $session = $request->getSession();
 
        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR
            );
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }
        
           $login=array(
            '0' => array('name' => '_username', 'type' => 'text' ),
            '1' => array('name' => '_password', 'type' => 'text' )


            );      

            $form = $this->createFormBuilder($login)
      
            ->add('captcha', 'captcha',  array(
            'width' => 200,
            'height' => 100,
            'length' => 4 ,
            'required' => true,
            'attr' => array('class' => 'tres')
            ))
            ->getForm();
            //$form->handleRequest($request); 
              /*
           if ($form->isValid()) {
           
          
            $fa= $request->request->get('form');
  
           return $this->redirect($this->generateUrl('login_check',
          array('module' => 'input',
           '_username' =>$fa['_username'], '_password' => $fa['_password'])));
       
           
       
            
            return $response;    
                
            }
           else
                */        
  // {

        return $this->render(
            'GCBAStoreBundle:Security:logincaptcha.html.twig',
            array(
                // last username entered by the user
                'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                'error'         => $error,  
               'form'           => $form->createView()
                
                 
            )
        );
  //  }
    }


}




