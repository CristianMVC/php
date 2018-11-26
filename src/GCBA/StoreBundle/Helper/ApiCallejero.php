<?php

namespace GCBA\StoreBundle\Helper;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;  

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\DependencyInjection\ContainerInterface;
 

class ApiCallejero {

        private $urlCallejero;

        public $mensaje_error;
     public function __construct(ContainerInterface $container) {
        $this->container=$container;
        $this->renderer = $this->container->get('templating');
        $this->urlCallejeroServicio=$this->container->getParameter('url_callejero');
        $this->urlCallejero=$this->container->getParameter('urlapiCallejero');

        
     } 
        
        
 /*Alta de beneficiario y tarjeta*/
 function getUrl()
 {
  return $this->urlCallejero;
 }
function validarDireccion($direccion)
{
    $data["dir"]=$direccion;
    $results = $this->ws($this->urlCallejeroServicio.'/normalizar?','get',$data);
    return $results;
} 
 
function getComunaBarrio($calle,$altura){
    $data["calle"]=$calle;
    $data["altura"]=$altura;
    $results = $this->ws($this->urlCallejero.'/datos_utiles','get',$data);
    return $results;
}
function validarCalleyAltura($calle,$altura){
    $data["calle"]=$calle;
    $data["altura"]=$altura;
    $results = $this->ws($this->urlCallejero.'/geocoding','get',$data);
    return $results;
}


function ws($url, $method, $data=array()){
    global $curl_httperror;
    try{  
        $vars = (!empty($data) ? http_build_query($data) : null);
        $service_url = (!is_null($vars) ? $url.'?': $url);
        
        if (count($data)>0)
        $service_url.= http_build_query($data);
    
      //  echo $service_url;exit;
        switch($method){
            case 'get':
                
               $curl = curl_init($service_url);   
                curl_setopt($curl, CURLOPT_HTTPGET, true);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    $curl_response = curl_exec($curl); 
                break;
            case 'post':
          //  $data_string = json_encode($data);   
           
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
                curl_setopt($curl, CURLINFO_HEADER_OUT, true);
                curl_setopt($curl, CURLOPT_VERBOSE, 1); 
           //    curl_setopt( $curl, CURLOPT_HTTPHEADER, array('application/x-www-form-urlencoded; charset=UTF-8'));
               $curl_response = curl_exec($curl); 
            
           
   
              
                break;
            case 'put':
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $url); 
           
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                curl_setopt($curl, CURLOPT_POSTFIELDS,http_build_query($data));
                $curl_response = curl_exec($curl);
              //    echo " aaa  $url $service_url $curl_response";
                break;
            default:
                
        }
           
 
                
     
      //  $this->printArray($curl_response);
     //   exit;
        $this->mensaje_error=curl_error($curl); 
        $info= curl_getinfo($curl );
       // $this->printArray($curl_response);


        $this->curl_info=$info;
        curl_close($curl);   
   
    if (isset($curl_response))
    return json_decode($curl_response,true);
    }
    catch(\Exception $e){
        return "no se puede ";
    }  
        
      
}
function printArray($array,$return=false)
{
echo "<pre>";
print_r($array,$return);
echo "</pre>";

}
}


