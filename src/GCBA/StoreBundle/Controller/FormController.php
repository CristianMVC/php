<?php
namespace GCBA\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GCBA\CatalogoAppBundle\Entity\Aplicacion;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Class DtControllerStyleController
 *
 * @Route("/style/controller/")
 * @package Brown298\DtTestBundle\Controller
 */
class FormController extends Controller
{
    private $entity;
    function convertirNomenclaturacampos($string)
   {
       $partes=array();
           $partes=explode("_",$string);
           $c=0;
           $res="";
           foreach ($partes as $val)
           {
               if ($c>0)
               
               $res.=ucfirst($val);
               else
               $res.=$val;
               $c++;   
           }    
       return $res;
   }
    function convertirNomenclaturaEntidades($string)
   {
       $partes=array();
           $partes=explode("_",$string);
           $c=0;
           $res="";
           foreach ($partes as $val)
           {
            
               $res.=ucfirst($val);
            
               $c++;   
           }    
       return $res;
   }
       function getBundles()
   {
       
    $em = $this->getDoctrine()->getManager();
    $namespaces = $em->getConfiguration()->getEntityNamespaces();
   

   foreach ($namespaces as $ind => $namespace)
   {
       $ind=str_replace("GCBA","",$ind);
       $res[$ind]=$ind; 
   }
   return $res;     
   } 
     function getCampos($nombre_tabla)
   {
       
    $em = $this->getDoctrine()->getManager();


    
    $cols = $em->getConnection()->getSchemaManager()->listTableColumns($nombre_tabla);

    $campos=array();
    foreach ($cols as $ind => $col) {
  
    $campos[$this->convertirNomenclaturacampos($ind)]=$ind;

    }    
  return $campos;     
   }   
      
    function getEntities()
   {
       
    $em = $this->getDoctrine()->getManager();

    $tables = $em->getConnection()->getSchemaManager()->listTables();
   

    

    foreach ($tables as $table) {
  
    $entities[$table->getName()]=$table->getName();
    }  
  return $entities;     
   } 
    
    function getAsociados()
  {
          $fields=$this->getDoctrine()->getManager()->getClassMetadata($this->entity)->getAssociationNames();
         if (count($fields)<1)
         return array();
       foreach ($fields as $k => $val)
       {
         
           $lc[]=$this->convertirNomenclatura($val);
           
       }     
         return array_flip($lc); 
      
  }
  function gettipos()
  {
      $stmt = $this->getDoctrine()->getManager()->getConnection()->prepare(" SHOW FIELDS FROM ".$this->tabla."
      ");
          $stmt->execute();
    $datos=$stmt->fetchAll();   
    return $datos;
      
  } 
    function generadorAction(Request $request)
  {

         $entities=$this->getEntities();
   $bundles=$this->getBundles(); 

     

         
             if ($request->request->get('entity')) {
                
                 $this->tabla=$request->request->get('entity');     
             
               
                 $this->bundle=$request->request->get('bundle');
                     $res=$this->GenerarArchivos(); 
                 
                return $this->render('GCBAStoreBundle:Default:resultado.html.twig',array('validation' => $res[2] ,'twig' => $res[1] ,'controlador' => $res[0]));
             } 
         
        return $this->render('GCBAStoreBundle:Default:generador.html.twig',array('entities' => $entities,'bundles' => $bundles));
  }
function getFkyAsoc()
{
   $dat=array(); 
    $datos=$this->xml2array(__DIR__."/../../".$this->bundle."/Resources/config/doctrine/".ucfirst($this->tabla).".orm.xml",100,"attr");
 if (array_key_exists("many-to-one",$datos["doctrine-mapping"]["entity"]))
 foreach ($datos["doctrine-mapping"]["entity"]["many-to-one"] as $k => $reg)
 {
     
     if (array_key_exists("field",$reg['attr']))
     {
     $dat[$reg['attr']["field"]]=$reg['attr']["target-entity"];
     }
 }    
 return $dat;   
}  
  

   
function GenerarArchivos()
{   
   

  

  $em= $this->getDoctrine()->getManager();  
$fields=$this->getFkyAsoc();
  $campos=$this->getCampos("aplicacion");
 $tipos=$this->gettipos();

   $twig="";
      
$string='GCBA\\StoreBundle\\Entity\\'.ucfirst($this->tabla).':
    constraints:
        - Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity:
                fields: nombre
                errorPath: nombre
                message: \'Este nombre dato ya se encuentra en la base de datos.\'

    properties:  
';
     
 //print_r($datos);
 //exit;      
       $form="<?php
         \$formbuilder
         "; 
         $error="<ul>
         "; 
      foreach ($tipos as $k => $reg)
      {
                $partes=array();
           $partes=explode("_",$reg["Field"]);
           $c=0;
           $ind="";
           foreach ($partes as $val)
           {
               if ($c>0)
               $ind.=ucfirst($val);
               else
               $ind.=$val;
               $c++;   
           } 
         $string.='            '.$ind.':
';
        if ($reg["Null"]=="NO")
        $string.="               - NotBlank: ~\n";
      
        
        if (strpos($reg["Type"],"archar",1)==false)
        {
        }
        else
        { 
           $largo=str_replace("varchar(","",$reg["Type"]);
           $largo=str_replace(")","",$largo);
           $string.='               - Length:
                    min: 3
                    max: '.$largo."
";
        }          
  
    
        $res=$this->getform($ind,$fields,$reg["Type"],$reg['Null']);
       
        $form.=$res["form"];
        $twig.=$res["twig"];
      //  $error.=$res["error"];
      }
      $resultado[0]=$form;
      $resultado[1]=$twig;
      $resultado[2]=$string;
      return $resultado;

}      
function getform($ind,$fields,$type,$isnull)
{
           
        
         $res["form"]="";
         $res["twig"]="";
         $res["error"]="";
         $string="";
         $twig="";

       
         

           
         if ($isnull=="YES"){
            $isreq="false";
            $asterisco="";

            }
         else{
            $isreq="true";
            $asterisco='(<font color="#FF0000">*</font>)';
            }
         
         $tipos=explode("(",$type);
         switch($tipos[0])
         {
         case "varchar":
         $tipo="text";
         break;
         case "date":
         case "datetime":
         $tipo="date";
         break;
         case "int":
         $tipo="number";
         break;
         case "tinyint":
         $tipo="checkbox";
         break;
         
         default:
         $tipo="text";
         
         
         }
           
         
         if ($tipo=="date")
             $form="
                  ->add('$ind','date',array(
        'required' => false,            
        'widget' => 'single_text',
        'format' => 'dd/MM/yyyy',
        'attr' => array('class' => 'date'))) 
                 ";
         else
            $form="  ->add('$ind', '$tipo',array('attr' => array('class' => 'tres'), 'required'    => ".$isreq."))\n";            
         
         $twig='
         
                              <div class="separador"></div>
                        
               
         <label class="largo"  for="seccion">'.$ind.' '.$asterisco.':</label>        
 
                        {{ form_errors(form.'.$ind.') }}
  
                        {{ form_widget(form.'.$ind.') }}
                                           
        
  
            
                                        
                                             ';
                                 
         if (array_key_exists($ind,$fields))
         $form="      ->add('$ind', 'entity',array(
                    'class' => 'GCBA".$this->bundle.":".$fields[$ind]."',
                    'property' => 'nombre',
                    'required'    => true
                    ))\n";      
         $twig='
                      <div class="separador"></div>  
                        <label class="largo"  for="campo2">'.$ind.' '.$asterisco.':</label>    
                        {{ form_errors(form.'.$ind.') }}
                            <div class="cinco">
                            
                               
                                {{ form_widget(form.'.$ind.') }}
                                </div>
                        
                        

                                             
                                             
         
         ';   
         $error="
      
         ";    
         
        
         $res["form"]=$form;
         $res["twig"]=$twig;
         $res["error"]=$error;
     
         
         return $res;            

    
} 

function gettwig($ind,$fields1)
{
          if (array_key_exists($ind,$fields1))
          
         //$string.="  ->add('$ind', 'text',array('attr' => array('class' => 'tres')))<br>";            
         $string.='     
         <label class="largo"  for="campo2">'.$ind.':</label>        
 
                        {{ form_errors(form.'.$ind.') }}
  
                        {{ form_widget(form.'.$ind.') }}
                                             <div class="separador"></div>

        
  
            
                                             <div class="separador"></div>
                                             ';
         if (array_key_exists($ind,$fields2))
        /* $string.="      ->add('$ind', 'entity',array(
                    'class' => 'GCBACatalogoAppBundle:".ucfirst($ind)."',
                    'property' => 'nombre',
                    ))<br>";  */     
         $string.='
                        
                        <label class="largo"  for="campo2">'.$ind.':</label>    
                        {{ form_errors(form.'.$ind.') }}
                            <div class="cinco">
                            
                               
                                {{ form_widget(form.'.$ind.') }}
                                </div>
                            </div>
                             <div class="clear" style="height:15px;"></div>

                                             <div class="separador"></div>
                                             
         
         ';   
         return $string;
}
function grabar($archivo,$dato)
{

$fh = fopen($archivo, 'w') or die("can't open file $archivo");

fwrite($fh, $dato);

fclose($fh);

}        
 
function xml2array($url, $get_attributes = 1, $priority = 'tag')
{
    $contents = "";
    if (!function_exists('xml_parser_create'))
    {
        return array ();
    }
    $parser = xml_parser_create('');
    if (!($fp = @ fopen($url, 'rb')))
    {
        return array ();
    }
    while (!feof($fp))
    {
        $contents .= fread($fp, 8192);
    }
    fclose($fp);
    xml_parser_set_option($parser, XML_OPTION_TARGET_ENCODING, "UTF-8");
    xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
    xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
    xml_parse_into_struct($parser, trim($contents), $xml_values);
    xml_parser_free($parser);
    if (!$xml_values)
        return; //Hmm...
    $xml_array = array ();
    $parents = array ();
    $opened_tags = array ();
    $arr = array ();
    $current = & $xml_array;
    $repeated_tag_index = array ();
    foreach ($xml_values as $data)
    {
        unset ($attributes, $value);
        extract($data);
        $result = array ();
        $attributes_data = array ();
        if (isset ($value))
        {
            if ($priority == 'tag')
                $result = $value;
            else
                $result['value'] = $value;
        }
        if (isset ($attributes) and $get_attributes)
        {
            foreach ($attributes as $attr => $val)
            {
                if ($priority == 'tag')
                    $attributes_data[$attr] = $val;
                else
                    $result['attr'][$attr] = $val; //Set all the attributes in a array called 'attr'
            }
        }
        if ($type == "open")
        {
            $parent[$level -1] = & $current;
            if (!is_array($current) or (!in_array($tag, array_keys($current))))
            {
                $current[$tag] = $result;
                if ($attributes_data)
                    $current[$tag . '_attr'] = $attributes_data;
                $repeated_tag_index[$tag . '_' . $level] = 1;
                $current = & $current[$tag];
            }
            else
            {
                if (isset ($current[$tag][0]))
                {
                    $current[$tag][$repeated_tag_index[$tag . '_' . $level]] = $result;
                    $repeated_tag_index[$tag . '_' . $level]++;
                }
                else
                {
                    $current[$tag] = array (
                        $current[$tag],
                        $result
                    );
                    $repeated_tag_index[$tag . '_' . $level] = 2;
                    if (isset ($current[$tag . '_attr']))
                    {
                        $current[$tag]['0_attr'] = $current[$tag . '_attr'];
                        unset ($current[$tag . '_attr']);
                    }
                }
                $last_item_index = $repeated_tag_index[$tag . '_' . $level] - 1;
                $current = & $current[$tag][$last_item_index];
            }
        }
        elseif ($type == "complete")
        {
            if (!isset ($current[$tag]))
            {
                $current[$tag] = $result;
                $repeated_tag_index[$tag . '_' . $level] = 1;
                if ($priority == 'tag' and $attributes_data)
                    $current[$tag . '_attr'] = $attributes_data;
            }
            else
            {
                if (isset ($current[$tag][0]) and is_array($current[$tag]))
                {
                    $current[$tag][$repeated_tag_index[$tag . '_' . $level]] = $result;
                    if ($priority == 'tag' and $get_attributes and $attributes_data)
                    {
                        $current[$tag][$repeated_tag_index[$tag . '_' . $level] . '_attr'] = $attributes_data;
                    }
                    $repeated_tag_index[$tag . '_' . $level]++;
                }
                else
                {
                    $current[$tag] = array (
                        $current[$tag],
                        $result
                    );
                    $repeated_tag_index[$tag . '_' . $level] = 1;
                    if ($priority == 'tag' and $get_attributes)
                    {
                        if (isset ($current[$tag . '_attr']))
                        {
                            $current[$tag]['0_attr'] = $current[$tag . '_attr'];
                            unset ($current[$tag . '_attr']);
                        }
                        if ($attributes_data)
                        {
                            $current[$tag][$repeated_tag_index[$tag . '_' . $level] . '_attr'] = $attributes_data;
                        }
                    }
                    $repeated_tag_index[$tag . '_' . $level]++; //0 and 1 index is already taken
                }
            }
        }
        elseif ($type == 'close')
        {
            $current = & $parent[$level -1];
        }
    }
    return ($xml_array);
}  
  
  
  
}