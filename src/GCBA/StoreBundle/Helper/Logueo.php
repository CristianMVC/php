<?php


    namespace GCBA\StoreBundle\Helper;
    use Symfony\Component\Security\Core\Exception\AccessDeniedException;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;  
    use GCBA\StoreBundle\Entity\SysLog;
    use Symfony\Component\DependencyInjection\ContainerAware;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
    use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
    use Symfony\Component\Yaml\Parser;
    use Doctrine\ORM\Mapping\ClassMetadata;

    use Doctrine\ORM\QueryBuilder;

    use Doctrine\ORM\EntityRepository;
    use Symfony\Component\Config\Definition\Exception\Exception;
    use Symfony\Component\Serializer\Encoder\JsonEncoder;
    use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
    use Symfony\Component\Serializer\Serializer;
    use Symfony\Component\DependencyInjection\ContainerInterface;
    class Logueo extends controller{

        private $entityManager;
        private $campos_modificados;
        public function __construct(ContainerInterface $container,$entityManager) {
            $this->container=$container;
            $this->renderer = $this->container->get('templating');
            $this->request = $container->get('request');
            $this->em=$entityManager;

        }
        private function getIdValue($metodos,$objeto)
        {
            if (!is_array($metodos) or !is_object($objeto))
                return false;
            if ($this->nombrePrimaria<>"")
            {
                $metodo="get".$this->nombrePrimaria;  
                return $objeto->$metodo();   
            }  
            foreach ($metodos as $metodo)
            {
                if (method_exists($objeto,$metodo))
                {

                    return $objeto->$metodo();

                }     


            }
            return false;

        }
        function getMetodos($obj)
        {

            $metodos=array();
            $metodos=get_class_methods($obj);
            $getMetodos=array(); 
            if (is_array($metodos) && count($metodos)>0)
            {

                foreach ($metodos as $metodo)
                {

                    if (preg_match('/^get/', $metodo,$math)==true)
                    {
                        $getMetodos[]=$metodo;

                    }
                }
            }
            return $getMetodos;  
        } 
        function printArray($array)
        {
            echo "<pre>";
            print_r($array);
            echo "</pre>";

        } 
        private function getDatosObjeto($objeto)
        {
            $resultado=array();
            $this->tabla="Dictamen";
            $metodos=$this->getMetodos($objeto);
            $datos="";
            $formato="d-m-Y";    
            $res=array();
            $key="";

            if (is_array($metodos))
                foreach ($metodos as $metodo) 
                {

                    //   $id=$this->getIdValue($metodos,$objeto);
                    $enc=false;

                    $val="";

                    if (method_exists($objeto,$metodo))
                    {         

                        $key=str_replace("get","",$metodo);
                        $dato=$objeto->$metodo();       
                        if (is_object($dato))
                        {

                            if (method_exists($dato,"format"))                        
                            {              
                                $fecha=$objeto->$metodo();
                                $val=$fecha->format($formato);


                            }
                            else
                            {
                                if (method_exists($dato,"getCampoLog")  )
                                {


                                    $val=$dato->getCampoLog();




                                }
                                else
                                {


                                    $kmet=$this->getMetodos($dato);
                                    foreach ($kmet as $met)
                                    {

                                        if (preg_match("/nombre/", strtolower($met))==true) 
                                        {
                                            $val=$dato->$met();
                                            break;
                                        } 
                                    }
                                }
                            }

                        }
                        else
                        {

                            $val=$objeto->$metodo();

                        }

                        ;  

                    }




                    if (!is_object($val))
                    {

                        $datos[$key]=$val;
                    }
            }  


            return $datos;
        }
        private function arrayToString($array)
        {

            $str="";
            if (is_array($array))
                foreach ($array as $k => $val) 
                {
                    if ($val===false)
                        $val="No";
                    if ($val===true)
                        $val="Sí";
                    $str.=$k."=".$val." ";

            }
            return $str;     
        }
        private function getModData($dorig,$dmod)
        {
            $datos=array();
            $diff=array_diff_assoc($dorig,$dmod);
            if (is_array($diff))
                foreach ($diff as $k => $val)
                {
                    $this->campos_modificados[$k]=$k;
                    $datos[$k]=$dmod[$k];
            }
            return $datos;

        }

        private function filtrarCamposMod($array)
        {

            $datos=array();
            if (is_array($this->campos_modificados) && is_array($array))
                foreach ($this->campos_modificados as $k => $val)
                {
                    if (array_key_exists($k,$array))
                        $datos[$k]=$array[$k];
            }
            return $datos;
        }
        private function arrayTieneDatos($array)
        {
            if (!is_array($array))
                return false;
            foreach ($array as $val)
            {
                if (trim($val)<>"")
                    return true;
            }
            return false;
        }

        public function Log($admin,$accion,$registro,$desc="",$Eo="",$Em="")
        {


            $log = new SysLog();
            if (is_object($Em) && is_object($Eo))
            {
                $dmod="";
                $dorig="";
                $datoso=$this->getDatosObjeto($Eo);
                $datosm=$this->getDatosObjeto($Em);
                $dm=$this->getModData($datoso,$datosm);
                /*   $this->printArray($datoso);
                $this->printArray($datosm);
                $this->printArray($dm);     */

                if (count($dm)>0)
                {        
                    $do=$this->filtrarCamposMod($datoso);
                    $strdmod=$this->arrayToString($dm);
                    $strdorig=$this->arrayToString($do);

                    if ($this->arrayTieneDatos($datosm))
                    {
                       
                        $log->setMod($strdmod);
                        $log->setOrig($strdorig);    
                    }

                }
                else
                {      
                    return false;
                }
            }           
            list($bundle,$accion)=explode("::",$accion);
            $accion=str_replace("Action","",$accion);
            //    echo $admin->getId()."-->".$accion;exit;

            $em = $this->getDoctrine()->getManager();
            /*   if (!$this->em->isOpen()) {
            $this->em = $this->em->create(
            $this->em->getConnection(),
            $this->em->getConfiguration()
            );
            }             */
            $em=$this->em;
            $acciones = $this->getDoctrine()
            ->getRepository('GCBAStoreBundle:SysAccion')
            ->findByNombre($accion);

            foreach ($acciones as $accion)
                $idaccion=$accion->getIdSysAccion();           

            $oaccion = $this->getDoctrine()
            ->getRepository('GCBAStoreBundle:SysAccion')->find($idaccion);
            //  echo $admin->getId()."-->".$oaccion->getNombre();exit;            
            $datenow=new \DateTime(date("Y-m-d h:i:s"));
            $log->setAdministrador($admin);
            if ($registro)
                $log->setUsuario($registro);
            $log->setFecha($datenow); 
            $log->setAccion($oaccion);    
            $log->setDescripcion($desc);
            if (array_key_exists('REMOTE_ADDR', $_SERVER))
                $ip=$_SERVER["REMOTE_ADDR"];
            if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER))              
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            if ($ip<>"")
                $log->setIp($ip);
            $em->persist($log); 

            $em->flush();
            // $em->getConnection()->commit();    
        }
    }

?>