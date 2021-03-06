<?php
    namespace GCBA\StoreBundle\Helper;


    use Symfony\Component\DependencyInjection\ContainerAware;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
    use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
    use Symfony\Component\Config\Definition\Exception\Exception;
    use Symfony\Component\DependencyInjection\ContainerInterface;

    class SyncMenu {

        var $datos =array();
        private $campoId="id";
        private $error;
        private $parameters=false;
        function __construct($nombre) {
            //check if the file path and api URI are specified, if not: break out of construct.
            if (strlen($nombre) > 0) {
                //set the local file path and api path
                $this->nombre=$nombre;
                $this->parameters=true;
            }
        }
        function setCampoId($campo)
        {
            $this->campoId=$campo;
        }
        function getDatos($xml)
        {
            //does the file need to be updated?
            if ($this->parameters==true)
            {
                //   if ($this->checkExist()==true) {

                return $this->readXml($xml);
                //  }
                //   else
                //  return false; 

            } else {
                $this->error="No file path and / or api URI specified.";
                return false;
            }

        }


        private function readXml($xml)
        {

            return $this->reindex($this->xml_to_array($xml));


        }
        function getError()
        {
            return $this->error;

        }
        private function checkExist() {
            //set the caching time (in seconds)
            if (file_exists($this->filePath))
            {
                return true;

            }
            else
                return false;
        }


        function GenerarXml($datos) {
            //building the xml object for SimpleXML
            $output = new \SimpleXMLElement("<data></data>");
            $root = $output->addChild($this->nombre);
            foreach ($datos as $c => $reg)
            {
                if (is_array($reg))
                {
                    foreach ($reg as $i => $val)
                    {
                        $root->addChild($i,$val);
                    }

                }
            }
            return $output->asXML();
        }
        function printArray($array,$return=false)
        {
            echo "<pre>";
            print_r($array,$return);
            echo "</pre>";

        }

        private function XML2Array($parent)
        {
            $array = array();

            foreach ($parent as $name => $element) {
                ($node = & $array[$name])
                && (1 === count($node) ? $node = array($node) : 1)
                && $node = & $node[];

                $node = $element->count() ? $this->XML2Array($element) : trim($element);
            }

            return $array;
        }

        function xml_to_array($xml,$main_heading = '') {
            $deXml = simplexml_load_string($xml);
            $deJson = json_encode($deXml);
            $xml_array = json_decode($deJson,TRUE);
            if (! empty($main_heading)) {
                $returned = $xml_array[$main_heading];
                return $returned;
            } else {
                return $xml_array;
            }
        } 
        function reindex($array)
        {


            foreach ($array[$this->nombre] as $key=> $reg)
            {
                $c=0;
                foreach ($reg as $ind => $val)
                {
                    if ($key==$this->campoId)
                    {

                        $ids[$c]=$val;
                    }

                    $c++;
                }

            }
            foreach ($array[$this->nombre] as $key=> $reg)
            {
                $c=0;
                foreach ($reg as $ind => $val)
                {

                    $res[$ids[$c]][$key]=$val;

                    $c++;
                }

            }

            return $res;
        }
    }

