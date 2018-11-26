<?php
    /*****
    *  datatables class version 1.0.1
    * 
    */

    namespace GCBA\StoreBundle\Helper;
    use Symfony\Component\Security\Core\Exception\AccessDeniedException;
    // use Symfony\Component\HttpFoundation\JsonResponse;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;  

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
    use Symfony\Component\HttpFoundation\Session\Session;

    use Symfony\Component\HttpKernel\Exception\FatalErrorException; 
    class Datatables extends controller{
        private $accionBoton;
        private $entityManager;
        private $jq;
        private $templateTabla="GCBAStoreBundle:DataTables:tabla.html.twig";
        private $templateBuscador="GCBAStoreBundle:DataTables:buscador.html.twig";
        private $templateSelector="GCBAStoreBundle:DataTables:selector.html.twig";
        private $routeEditar;
        private $routeServer;
        private $routeInputBuscador;
        private $indice="";
        private $mostrarEditar=false;    
        private $mostrarMarcar=false;
        private $mostrarBorrar=false;
        private $exportar=false;
        private $enable_buscador=false;
        private $campos=array();
        private $camposBusqueda;
        private $ymlData=array();
        private $entity;
        private $camposBusquedaFull=array();
        private $nombresDeCampos=array();
        private $tabla="";
        private $mostrarFk=array();
        private $mostrarDetalle=false;
        private $routeDetalle;
        private $labels;
        private $codigo=96;
        private $idTr=0;
        private $crearIdTr=false;
        private $mostrarFoto=false;
        private $prefijoPrincipal;
        private $defaultFilter;
        private $formatoFechas=array();
        private $routeExportar;
        private $ocultarEditar=false;
        private $mostrarBuscadorGenerico=true;
        private $nombrePrimaria;
        public function __construct(ContainerInterface $container,$entityManager) {
            $this->container=$container;
            $this->renderer = $this->container->get('templating');
            $this->request = $container->get('request');
            $this->em=$entityManager;
            $yaml = new Parser();
            $ymls=$this->container->getParameter('datatables_yml');

            try {
                $ymlBundles=array();    
                foreach ($ymls as $ruta)
                {
                    $file=__DIR__."../../../../".$ruta;
                    //  if (file_exists($file))
                    $content=@file_get_contents($file);
                    if ($content<>"")
                        $ymlBundles[]=$yaml->parse($content);
                }

                $dyml=array();   
                foreach ($ymlBundles as $k => $yml)
                {
                    if (is_array($yml['ymlDataTable']))
                        $dyml=array_merge($dyml,$yml['ymlDataTable']);  

                }

                /*  echo "<pre>";
                print_r($dyml);
                exit;   */
                $this->ymlData['ymlDataTable']=$dyml;


            } catch (ParseException $e) {
                printf("Unable to parse the YAML string: %s", $e->getMessage());
            }


        }

        function serverProcessing()
        {

            $request=$this->request;  
            $session = $this->getRequest()->getSession();
            $aColumns=array();    
            $this->setIndice($request->request->get('indice'));
            $this->setEntity($request->request->get('entity'));
            list($bundle,$this->tabla)=explode(":",$this->entity);     
            $this->tabla=strtolower($this->tabla);
            $this->prefijoPrincipal=$this->getLetra();
            $campos =$this->getCampos();
            $camposA =$this->getAsociados();
            $aColumns =$this->getCamposQuery($campos,$camposA);

            $error=false;
            if ($error==true)
            {
                $output = array(
                    "sDql" => "No esta seteada la tabla o no esta la query",
                    "sMsg" => "No esta seteada la tabla o no esta la query",
                    "sEcho" => intval($request->request->get('sEcho')),
                    "iTotalRecords" => 0,
                    "iTotalDisplayRecords" => 0,
                    "aaData" => array()
                );
                echo json_encode($output);  
            } 
            $sIndexColumn = "id";
            $sLimit = "";
            if ($request->request->get('iDisplayStart')<>"" && $request->request->get('iDisplayLength') != '-1' )
            {
                $sLimit = "LIMIT ".intval( $request->request->get('iDisplayStart').", ".intval( $request->request->get('iDisplayLength')));  
            }  


            $sWhere = "";
            $inner=array();
            $hWhere=false;
            $letras=array();
            list($bundle,$entity)=explode(":",$this->entity);

            $hinner=false;
            /**
            * busqueda por filtros separados definidos
            */



            $sWhereSentence = "";
            $hinner=false;
            for ( $i=0 ; $i<count($aColumns) ; $i++ )
            {

                if ( $request->request->get('sSearch_'.$i)<>"" && $request->request->get('sSearch_'.$i)<>"~" && $request->request->get('bSearchable_'.$i) == "true" )
                {  
                    $hWhere=true;
                    $sWhereSentence = "WHERE (";
                    if ($i<count($aColumns))
                    {
                        $sSearch=$request->request->get('sSearch_'.$i);    
                        $sSearch=str_replace("\\","",$sSearch);
                        $sSearch=$this->cleanVar($sSearch);
                        if (array_key_exists("type",$this->camposBusquedaFull[$aColumns[$i]]))
                            $type=$this->camposBusquedaFull[$aColumns[$i]]['type'];
                        else
                            $type="text";
                        if  ($type<>"text" and array_key_exists($aColumns[$i],$camposA))
                        {
                            list($pre,$enti)=explode(".",$camposA[$aColumns[$i]]);
                            // $letras[$enti]=$pre;
                            $inner[]=" Join ".$this->prefijoPrincipal.".".$enti." ".strtolower(substr($camposA[$aColumns[$i]],0,1));    
                            $hinner=true;

                            $nombre_campo=$this->camposBusquedaFull[$aColumns[$i]]['campofk']; 
                            if ($nombre_campo=="")
                                $nombre_campo="nombre";
                            $sWhere .= " (".$pre.".$nombre_campo LIKE '%". $sSearch."%') AND";    
                        }
                        else
                        {


                            $sSearch=$this->get_date_mysql($sSearch);
                            if (is_numeric($sSearch))
                            {



                                $sWhere .= " (".$campos[$aColumns[$i]]." = '". $sSearch ."') AND";

                            }
                            else
                            {
                                $ids=explode(",",$sSearch);
                                $rfechas=explode("~",$sSearch);
                                if (count($rfechas)>1)
                                {
                                    list($fecha1,$fecha2)=$rfechas;
                                    $fecha1=$this->get_date_mysql($fecha1);
                                    $fecha2=$this->get_date_mysql($fecha2);
                                    if ($fecha1 and $fecha2)
                                        $sWhere .= " (".$campos[$aColumns[$i]]." >= '". $fecha1 ."' and ".$campos[$aColumns[$i]]." <='".$fecha2."') AND";
                                    else
                                        $sWhere .=" (1=1) AND";

                                }
                                else 
                                    if (count($ids)>1)
                                    {
                                        $sIds="";
                                        foreach ($ids as $val)
                                            $sIds.="'".$val."',";
                                        $sIds=substr($sIds,0,strlen($sIds)-1);
                                        $sWhere .= " (".$campos[$aColumns[$i]]." IN ($sIds)) AND";

                                    } 
                                    else
                                    {
                                        if ($aColumns[$i]=="borrado" )
                                        {

                                            $sWhere .= " ".$campos[$aColumns[$i]]." = ". $sSearch ." AND";

                                        }
                                        else
                                            $sWhere .= " ".$campos[$aColumns[$i]]." LIKE '%". $sSearch ."%' AND";
                                }   
                            }
                        }
                    }
                }



            }     
            if ($sWhereSentence<>"")
            { 
                $sWhere = substr($sWhere,0,strlen($sWhere)-3);
                $sWhere = $sWhereSentence.$sWhere. ') ';
            }
            else
            {
                if ($this->defaultFilter<>"")
                    $sWhere="WHERE ".$this->prefijoPrincipal.".".$this->defaultFilter."";
            }




            /**
            * busqueda por todos los campos
            */

            if ( $request->request->get('sSearch')<>"" && $request->request->get('sSearch') != "" )
            {
                if ($sWhereSentence=="")
                    $sWhere = "WHERE (";
                else
                    $sWhere.= " AND (";
                $hWhere=true;
                for ( $i=0 ; $i<count($aColumns) ; $i++ )
                {

                    if ( $request->request->get('bSearchable_'.$i)<>"" && $request->request->get('bSearchable_'.$i) == "true" )
                    {  
                        if ($i<count($aColumns))
                        {
                            $sSearch=$request->request->get('sSearch');    
                            $sSearch=str_replace("\\","",$sSearch);
                            $sSearch=$this->cleanVar($sSearch);
                            if  (array_key_exists($aColumns[$i],$camposA))
                            {
                                list($pre,$enti)=explode(".",$camposA[$aColumns[$i]]);
                                //   if ($hWhere==false)
                                $inner[]=" Join ".$this->prefijoPrincipal.".".$enti." ".strtolower(substr($camposA[$aColumns[$i]],0,1));    
                                $hinner=true;
                                $sWhere .= " (".$pre.".nombre LIKE '%". $sSearch."%') OR ";    
                            }
                            else
                            {


                                $sSearch=$this->get_date_mysql($sSearch);

                                $sWhere .= "(".$campos[$aColumns[$i]]." LIKE '%". $sSearch ."%') OR ";
                            }
                        }
                    }
                }
                $sWhere = substr_replace( $sWhere, "", -3 );
                $sWhere .= ') ';


            }     


            $sOrder="";              
            $nombre_campo="";

            if ( $request->request->get('iSortCol_0')<>"")
            {
                $sOrder = " ORDER BY ";
                for ( $i=0 ; $i<intval( $request->request->get('iSortingCols') ) ; $i++ )
                {       
                    if ( $_POST[ 'bSortable_'.intval($_POST['iSortCol_'.$i]) ] == "true" )
                    {

                        $ncol=intval($_POST['iSortCol_'.$i]);
                        if (array_key_exists($ncol,$aColumns))
                            $nombre_campo=$aColumns[$ncol];


                        if  (array_key_exists($nombre_campo,$camposA)) {
                            list($pre,$enti)=explode(".",$camposA[$nombre_campo]);

                            if ($hWhere==false)
                                $inner[]=" Join ".$this->prefijoPrincipal.".".$nombre_campo." ".strtolower(substr($camposA[$nombre_campo],0,1));     
                            if ($nombre_campo<>"")
                                $sOrder .=  $this->prefijoPrincipal.".$enti     ".($_POST['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .",";
                        }
                        else
                        {         

                            if ($nombre_campo<>"")
                                $sOrder .= $this->prefijoPrincipal.".".$nombre_campo." ".($_POST['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .",";

                        }

                    }

                }   


                $sOrder=substr($sOrder,0,strlen($sOrder)-1);

                // if ($inner<>"")
                //   $sOrder=" "." ".$sOrder." ";


            }   
            if ( trim($sOrder) == "ORDER BY")
            {
                $sOrder = "";
            }         
            $inner2=array_flip($inner);
            $inn="";
            foreach ($inner2 as $ind =>$val)
                $inn.=" ".$ind." ";
           // print_r($inner2);    
          //  exit;    
            $selectCount="SELECT COUNT(".$this->prefijoPrincipal.".".$this->nombrePrimaria.") as cant";
            $select="SELECT ".$this->prefijoPrincipal." ";
            $from = " FROM ".$this->entity." ".$this->prefijoPrincipal." ".trim($inn);     
            if ($session->get('filtro' )<>"" and $session->get('entity')==$this->entity)
            {
                if (trim($sWhere)=="")

                    $sWhere.=" WHERE ".$session->get('filtro' );
                else
                    $sWhere.=" AND ".$session->get('filtro' );
            }
            $dql=trim($select)." ".trim($from)." ". trim($sWhere)." ".trim($sOrder);

            //   echo $dql; exit;
            // $dqlTotal=
            if (trim($sWhere)<>"")
            {
                try {
                    if (DEBUG==true)
                    {
                        $printdql=$selectCount.$from;    
                    }  
                    $query = $this->em->createQuery($selectCount.$from);
                    $cantTotal=$query->getResult();
                    $iTotalRecords=0;

                    if (is_array($cantTotal))
                    {
                        foreach ($cantTotal as $reg)
                        {
                            $iTotalRecords=$reg["cant"];  
                        }
                    } 
                }
                catch (\Exception $e) {
                    $session->set('dql',"" );   
                    $output=array(

                        "sDql" => "Error en la consulta cant/w->".$printdql,   
                        "sMsg" => "",
                        "sEcho" => intval($request->request->get('sEcho')),
                        "iTotalRecords" => 0 ,
                        "iTotalDisplayRecords" => 0,
                        "aaData" => array()
                    );  
                    return json_encode($output);     
                } 

                try{
                    $printdql="";
                    if (DEBUG==true)
                    {
                        $printdql=trim($selectCount)." ".trim($from)." ".trim($sWhere);    
                    }  

                    $query = $this->em->createQuery(trim($selectCount)." ".trim($from)." ".trim($sWhere));
                    $cantFiltrada=$query->getResult();
                    $iTotalDisplayRecords=0;
                    if (is_array($cantFiltrada))
                    {
                        foreach ($cantFiltrada as $reg)
                        {
                            $iTotalDisplayRecords=$reg["cant"];
                        }
                    } 


                } 
                catch (\Exception $e) {
                    $session->set('dql',"" );   
                    $output=array(

                        "sDql" => "Error en la consulta de cantidad->".$printdql." ".$e->getMessage(),   
                        "sMsg" => "",
                        "sEcho" => intval($request->request->get('sEcho')),
                        "iTotalRecords" => 0 ,
                        "iTotalDisplayRecords" => 0,
                        "aaData" => array()
                    );  
                    return json_encode($output);     
                } 
            }
            else
            {
                $printdql="";
                if (DEBUG==true)
                {
                    $printdql=$selectCount.$from;    
                }
                try {
                    $query = $this->em->createQuery($selectCount.$from);
                    $cant=$query->getResult();
                    if (is_array($cant))
                    {
                        foreach ($cant as $reg)
                        {
                            $iTotalRecords=$reg["cant"];
                        }
                    } 

                    $iTotalDisplayRecords=$iTotalRecords;
                } 
                catch (\Exception $e) {
                    $session->set('dql',"" );   
                    $output=array(

                        "sDql" => "Error en la consulta de cantidad2->".$printdql." ".$e->getMessage(),   
                        "sMsg" => "",
                        "sEcho" => intval($request->request->get('sEcho')),
                        "iTotalRecords" => 0 ,
                        "iTotalDisplayRecords" => 0,
                        "aaData" => array()
                    );  
                    return json_encode($output);     
                } 

            }
            try{ 
                if (DEBUG==true)
                    $printdql=$dql; 
                $query = $this->em->createQuery($dql);
                $query->setMaxResults($request->request->get('iDisplayLength'));      
                $query->setFirstResult($request->request->get('iDisplayStart'));
                $result=$query->getResult();
                $resultado=array();
                $resultado=$this->convertirObjeto($result,$aColumns);
                $session->set('dql',$dql );

                $output=array(

                    "sDql" => $printdql." ",
                    "sMsg" => $error."",
                    "sEcho" => intval($request->request->get('sEcho')),
                    "iTotalRecords" => $iTotalRecords ,
                    "iTotalDisplayRecords" => $iTotalDisplayRecords,
                    "aaData" => $resultado
                );     

                return  json_encode($output);
            }
            catch (\Exception $e) {
                $session->set('dql',"" );   
                $output=array(

                    "sDql" => "Error en la consulta final->".$printdql." ".$e->getMessage(),   
                    "sMsg" => "",
                    "sEcho" => intval($request->request->get('sEcho')),
                    "iTotalRecords" => 0 ,
                    "iTotalDisplayRecords" => 0,
                    "aaData" => array()
                );  
                return json_encode($output);     
            } 


        }


        function setOcultarEditar($bol)
        {
            $this->ocultarEditar=$bol;
        }

        /**
        * Devuelve una letra para el prefijo de los joins de las consultas
        */
        private function getLetra()
        {
            // a97 - z 122 A 65- Z 90
            if ($this->codigo==123)
            {
                $this->codigo=65;

            }
            else
                $this->codigo=$this->codigo+1;

            return chr($this->codigo);
        }
        private function leerRouterServer()
        {
            if (array_key_exists("route_server",$this->ymlData))
                $this->routeServer=$this->ymlData['route_server'];  
        }
        private function leerMarcar()
        {
            if (array_key_exists("mostrar_marcar",$this->ymlData))
                $this->mostrarMarcar=$this->ymlData['mostrar_marcar'];  
        }
        private function leerAccionBotonMarcar()
        {
            if (array_key_exists("accion_boton",$this->ymlData))
                $this->accionBoton=$this->ymlData['accion_boton'];  
        }


        private function leerRouteExportar()
        {
            if (array_key_exists("route_exportar",$this->ymlData))
                $this->routeExportar=$this->ymlData['route_exportar'];  
        }
        private function leerNombrePrimaria()
        {
            if (array_key_exists("nombrePrimaria",$this->ymlData))
                $this->nombrePrimaria=$this->ymlData['nombrePrimaria'];
            else
                $this->nombrePrimaria="id";  
        }
        private function leerDefaultFilter()
        {
            if (array_key_exists("defaultFilter",$this->ymlData))
                $this->defaultFilter=$this->ymlData['defaultFilter'];  
        }
        private function leerCrearIdTr()
        {
            if (array_key_exists("crearIdTr",$this->ymlData))
                if ($this->ymlData['crearIdTr']==true)
                {

                    $this->crearIdTr=true;  
                    if (array_key_exists("idTr",$this->ymlData))
                        if ($this->ymlData['idTr']<>"")
                            $this->idTr=$this->ymlData['idTr'];
                }
        }
        private function leerLabels()
        {
            if (!array_key_exists("labels",$this->ymlData))
            {
                throw new FatalErrorException("Debe definir las labels en el archivo datatables.yml ",true);
                return false;
            }
            $labels=$this->ymlData['labels'];
            if (is_array($labels))
                foreach ($labels as $id => $reg)
                {
                    $etiquetas[$id]=$reg["label"];
            }
            return $etiquetas;  
        }
        public function getLabels($entity)
        {
            $this->setEntity($entity);
            $this->leerLabels();
            return $this->leerLabels();
        }    
        private function leerSelectCampos()
        {

            $columns=$this->ymlData['columns'];
            if (!is_array($columns))
                return false;
            $c=0;       
            foreach ($columns as $ind => $reg)
            {
                $campos[]=$ind;
                if (is_array($reg))
                {
                    $this->nombresDeCampos[$c]['nombre']=$reg["nombre"];
                    if (array_key_exists("format",$reg))
                        $this->formatoFechas[$ind]=$reg["format"];


                    if (array_key_exists("dato",$reg))
                        $this->mostrarFk[$ind]=$reg["dato"];
                    $this->nombresDeCampos[$c]['id']=$ind;
                    $c++;
                }    
            }   
            $this->campos=$campos; 

        }
        private function leerBusquedaCampos()
        {

            $columns=$this->ymlData['buscador'];       

            if (!is_array($columns))
                return false;   
            foreach ($columns as $ind => $val)

                $campos[]=$ind;
            $this->camposBusqueda=$campos;
            $this->camposBusquedaFull=$columns;  
        }
        public function leerExportar()
        {   
            if (array_key_exists("exportar",$this->ymlData) && $this->ymlData['exportar']==1)
                $this->exportar=true;
            else
                $this->exportar=false;
        }
        private function setAcol($acol)
        {
            $c=0;
            if (is_array($acol))
                foreach ($acol as $ind => $val)
                {
                    $this->acol[$ind]=$c;
                    $c++;    
            }    
        }
        function getCamposQuery($campos,$camposA)
        {


            $acol=array_merge($campos,$camposA);
            $this->setAcol($acol);
            $i=0;

            if (count($this->campos)>0)
            {
                $campos=array_flip($this->campos);
                foreach ($campos as $ind => $val)
                {
                    $res[$i]=$ind;  
                    $i++;  
                }

            }
            else
            {
                foreach ($acol as $ind => $val)
                {
                    $res[$i]=$ind;  
                    $i++;  
                }
            }

            return $res;  

        }
        function printArray($array)
        {
            echo "<pre>";
            print_r($array);
            echo "</pre>";

        }

        function getCampos()
        {


            $fields=$this->em->getClassMetadata($this->entity)->getFieldNames();
            list($bundle,$entity)=explode(":",$this->entity);
            foreach ($fields as $k => $val)
            {
                $lc[$val]=$this->prefijoPrincipal.".".$val;
            }     
            return $lc;  
        } 
        function getAsociados()
        {
            $fields=$this->em->getClassMetadata($this->entity)->getAssociationNames();
            if (count($fields)<1)
                return array();

            foreach ($fields as $k => $val)
            {

                $prefijo=$this->getLetra(); 
                $lc[$val]=$prefijo.".".$val;

            }     
            return $lc; 

        }
        function setTemplateTabla($template)
        {
            $this->templateTabla=$template; 
        }

        function setTemplateJson($template)
        {
            $this->templateJson=$template; 
        }

        function leerRouteServer()
        {
            $this->routeServer=$this->ymlData['route_server']; 
        }
        function leerRouteEditar()
        {
            if (array_key_exists('route_editar',$this->ymlData))
                $this->routeEditar=$this->ymlData['route_editar']; 
        }
        function leerRouteDetalle()
        {
            if (array_key_exists('route_detalle',$this->ymlData))
                $this->routeDetalle=$this->ymlData['route_detalle']; 
        }
        function setRouteInputBuscador($route)
        {
            $this->routeInputBuscador=$route;
        }
        function leerActivarBuscador()
        {
            if ($this->ymlData['buscador_activo']==1)
                $this->enable_buscador=true;
            else
                $this->enable_buscador=false;
        }
        function leerMostrarDetalle()
        {
            if (array_key_exists("mostrar_detalle",$this->ymlData) && $this->ymlData['mostrar_detalle']==1)
                $this->mostrarDetalle=true;
            else
                $this->mostrarDetalle=false;
        }
        private function leerMostrarBuscar()
        {
            if (array_key_exists("mostrar_buscador_generico",$this->ymlData) && $this->ymlData['mostrar_buscador_generico']==false)
                $this->mostrarBuscadorGenerico=false; 
            else
                $this->mostrarBuscadorGenerico=true; 

        }
        private function leerEntidad()
        {
            if (array_key_exists("entity",$this->ymlData) && $this->ymlData['entity']<>"")
                $this->entity=$this->ymlData['entity']; 



        }
        function setIndice($indice)
        {

            $this->indice=$indice; 



        }
        function setEntity($entity)
        {
            if (!$entity)
            {
                echo "falta la entidad";
                return false;
            }
            $this->entity=$entity;

            if (!array_key_exists("ymlDataTable",$this->ymlData))
            {  
                return false;

            }
            if (!array_key_exists($entity,$this->ymlData['ymlDataTable']) && $this->indice=="")
            {

                return false;

            }    
            if (array_key_exists($entity,$this->ymlData['ymlDataTable']) && $this->indice=="")
                $this->ymlData=$this->ymlData['ymlDataTable'][$entity];
            else
                $this->ymlData=$this->ymlData['ymlDataTable'][$this->indice];
            // $this->printArray($this->ymlData['ymlDataTable']);
            // exit;  
            $this->leerAccionBotonMarcar(); 
            $this->leerMarcar();  
            $this->leerentidad();  
            $this->leerRouteExportar();
            $this->leerDefaultFilter();
            $this->leerCrearIdTr();
            $this->leerActivarBuscador();
            $this->leerRouteServer();
            $this->leerMostrarDetalle();
            $this->leerRouteEditar();
            $this->leerRouteDetalle();
            $this->leerMostrarEditar();
            $this->leerMostrarBorrar();    
            $this->leerExportar();
            $this->leerSelectCampos(); 
            $this->leerBusquedaCampos();
            $this->leerMostrarBuscar(); 
            $this->leerNombrePrimaria();

        }
        function getGrilla()               

        {
            if (!$this->routeServer)
            {
                return $this->routeServer."no se encontro el archivo yml de configuración datatables o no estan cargados los parámetros";
                return false;  
            }       
            $campos =$this->getCampos();
            $camposA =$this->getAsociados();

            $Columns =$this->getCamposQuery($campos,$camposA);

            list($bundle,$this->tabla)=explode(":",$this->entity);
            $formbuscador=""; 
            if ($this->enable_buscador==true)
            {
                $campos=$this->getDatosBuscador();
                $formbuscador=$this->getFormBuscador();
            } 
            if ($this->ocultarEditar==true)
                $this->mostrarEditar=false;
            $url_dt=$this->generateUrl($this->routeServer);          
            return $this->renderer->render($this->templateTabla,array('url_dt'=> $url_dt,
                'tabla'=> $this->tabla,'Columns' => $Columns ,
                'editar' => $this->mostrarEditar,
                'marcar' => $this->mostrarMarcar,
                'borrar' => $this->mostrarBorrar, 
                'exportar' => $this->exportar ,
                'buscador' => $formbuscador,
                'campos' => $campos,       
                'entity' => $this->entity,
                'indice' => $this->indice,
                'Nombres' => $this->nombresDeCampos,
                'mostrar_borrar' => $this->mostrarBorrar,
                'detalle' => $this->mostrarDetalle,
                'crearIdTr'=> $this->crearIdTr,
                'idTr' => $this->idTr,
                'route_exportar' => $this->routeExportar,
                'mostrarBuscarGenerico' => $this->mostrarBuscadorGenerico,
                'AccionBoton' => $this->accionBoton

            )) ;


        }
        function cleanVar($var)
        {
            $chars=array(
                "'","<",">"
            ); 

            foreach ($chars as $char)
            {

                $var=str_replace($char,"%",$var);   
            }
            return $var;
        }

        private function validateDate($date, $format = 'Y-m-d')
        {
            $d = \DateTime::createFromFormat($format, $date);
            return $d && $d->format($format) == $date;
        }



        private function get_date_mysql($fecha)
        {
            if ($fecha=="")
                return false;
            $sSearch=$fecha; 
            if ($this->validateDate($fecha,"d-m-Y"))
            {
                $fecha = \DateTime::createFromFormat('d-m-Y', $fecha);
                $sSearch=$fecha->format("Y-m-d");
            }
            if ($this->validateDate($fecha,"d/m/Y"))
            {
                $fecha = \DateTime::createFromFormat('d/m/Y', $fecha);
                $sSearch=$fecha->format("Y-m-d");

            }
            return $sSearch;  
        }     

        private function getDatosParaSelect($result,$campo,$ncampo="nombre")
        {
            // echo $campo,$ncampo;
            // exit;
            if (!is_array($result))
                return array();
            $resultado=array();
            $metodo="";
            foreach ($result as $k => $objeto)
            {


                $metodo="get".ucfirst($ncampo);
                if (method_exists($objeto,$metodo))

                    $resultado[$k]=$objeto->$metodo();  

            }
            return $resultado;
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

        private function convertirObjeto($result,$aColmuns)
        {
            if (!is_array($result))
                return array();
            $resultado=array();

            $metodos=array('getId',
                "getId".ucfirst($this->tabla),
                "getId".$this->tabla,
                "get".ucfirst($this->tabla)."Id",
                "get".ucfirst($this->tabla)."id"
            );

            foreach ($result as $k => $objeto)
            {
                $c=0;
                $formato="d/m/Y";    
                $res=array();
                $dato=(array)$objeto;
                foreach ($dato as $val) 
                {
                    if (is_object ($val))
                    {
                        $id=$this->getIdValue($metodos,$objeto);
                        $enc=false;
                        if (is_array($this->mostrarFk))
                            foreach ($this->mostrarFk as $d => $met)
                            {
                                $metodo="get".ucfirst($met);
                                if (method_exists($val,$metodo))
                                {

                                    $val=$val->$metodo();
                                    $enc=true;
                                    break;
                                }
                        }


                        if ($enc==false)
                        {
                            if (method_exists($val,"getNombre"))
                                $val=$val->getNombre();

                            if (method_exists($val,"format"))
                            {
                                if (is_array($this->formatoFechas))
                                    foreach ($this->formatoFechas as $d => $formato)
                                    {
                                        break;
                                }     

                                $val=$val->format($formato);
                            }
                        }
                    }
                    if (is_resource($val))
                        $res[$c]="<img width=50 height=50 src='".$this->generateUrl('gcba_profesional_foto',array('id'=> $id))."' >";  
                    else
                    {
                        if (is_object($val) || preg_match("/pdf\$/", $val)==false)
                        {
                            if ($val===true)
                                $val="Sí";
                            if ($val===false)
                                $val="No";
                            $res[$c]=$val;
                        }
                        else
                            $res[$c]="<a href='".$this->generateUrl('pg_bajar_archivo',array('id'=> $id))."' >".$val."</a>";  
                    }
                    $c++;  
                }  
                if (count($this->campos)>0)
                {
                    $d=0;
                    $campos=array_flip($this->campos);

                    foreach ($campos as $ind => $val)
                    {
                        if (array_key_exists($ind,$this->acol))
                            $data[$d]=$res[$this->acol[$ind]];
                        $d++;
                    }
                    $res=$data;
                    $c=$d;
                } 
                $id=0;



                $id=$this->getIdValue($metodos,$objeto);


                if ($this->mostrarEditar==true)
                {
                    if ($this->routeEditar<>"")
                        $res[$c]="<a href=\"".$this->generateUrl($this->routeEditar,array('id' => $id ))."\" >Editar</a>";
                    $c++;
                }
                if ($this->mostrarBorrar==true)
                {
                    $res[$c]=$this->renderer->render("GCBAStoreBundle:DataTables:checkbox.html.twig",array('id' => $id));

                    $c++;
                }      
                if ($this->mostrarMarcar==true)
                {
                    $res[$c]=$this->renderer->render("GCBAStoreBundle:DataTables:checkbox.html.twig",array('id' => $id));

                    $c++;
                }    
                if ($this->mostrarDetalle==true)
                {
                    if ($this->routeDetalle<>"")
                        $res[$c]="<a href=\"".$this->generateUrl($this->routeDetalle,array('id' => $id ))."\" >Detalle</a>";
                    $c++;
                }



                $resultado[$k]=$res;

            }

            return $resultado;   
        }

        private function leerMostrarEditar()
        {
            if ($this->ymlData['mostrar_editar'] && $this->ymlData['mostrar_editar']==1)
                $this->mostrarEditar=true; 
            else
                $this->mostrarEditar=false; 
        }
        private function leerMostrarBorrar()
        {
            if ($this->ymlData['mostrar_borrar'] && $this->ymlData['mostrar_borrar']==1)
                $this->mostrarBorrar=true; 
            else
                $this->mostrarBorrar=false; 

        }
        function getDatosBuscador()
        {

            $combo=array(); 
            if (count($this->camposBusqueda)>0)
            {
                $camposA=$this->getAsociados();
                $campos=$this->getCampos();
                $combom=$this->getCamposQuery($campos,$camposA);
                $combom=array_merge($campos,$camposA);
                $data=array();

                foreach ($this->campos as $ind => $val)
                {

                    $data[$val]=$combom[$val];


                }
                $combom=$data;




            }    
            else
            {     
                return false;
            }     
            $c=0;

            $camposb=array_flip($this->camposBusqueda);

            foreach ($combom as $ind => $val)
            {
                if ($val<>"")
                {
                    if (array_key_exists($ind,$camposb))
                    {

                        $combo[$c]['id']=$val;
                        $combo[$c]['nombre']=$ind;


                        $valor=$this->getCampoBuscador($ind);
                    }
                    else
                    {
                        $valor="null,";    
                    }

                    $combo[$c]['input']=$valor;
                    $c++;
                }  
            }     

            return $combo;
        }
        function getFormBuscador()
        {
            $campos=$this->getDatosBuscador();
            $nombres=array();
            $nombres= $this->nombresDeCampos;
            $nom=array();
            if (is_array($this->camposBusqueda))
            { 
                foreach ($nombres as $reg)
                {

                    if (array_search($reg["id"],$this->camposBusqueda)===false)

                    {
                    }
                    else
                    { 


                        $reg['type']=$this->camposBusquedaFull[$reg["id"]]['type'];
                        $nom[]=$reg;
                    }  

                }
            }
            /*     echo "<pre>";

            print_r($nombres);exit; */
            if (is_array($campos))
                return $this->renderer->render($this->templateBuscador,array('tabla'=> $this->tabla ,'Nombres' =>  $nom 

                )) ;
        }
        function getCampoBuscador($nombre_campo)
        {
            if (!$nombre_campo)
                return false;
            list($bundle,$this->tabla)=explode(":",$this->entity);
            $camposA=$this->getAsociados();
            if (array_key_exists("type",$this->camposBusquedaFull[$nombre_campo]))
                $type=$this->camposBusquedaFull[$nombre_campo]['type'];
            else
                $type="text";

            if ($type<>"text" and array_key_exists($nombre_campo,$camposA))
            {
                return $this->getComboBuscador($nombre_campo);
            }
            else
            {
                return $this->getInputBuscador($nombre_campo);
            }
        }
        function getComboBuscador($campo)
        {
            $mostrar_campo="";
            $entity=$this->camposBusquedaFull[$campo]['name'];
            if (array_key_exists("campofk",$this->camposBusquedaFull[$campo]))
                $mostrar_campo=$this->camposBusquedaFull[$campo]['campofk'];
            $datos=$this->em->getRepository($entity)
            ->findAll();


            $result= json_encode( $this->getDatosParaSelect($datos,$campo,$mostrar_campo));
            return $this->renderer->render($this->templateSelector,array('type'=> 'select','nombre' => $campo
                ,'result' => $result  
            )) ;

        }       
        function getInputBuscador($nombre_campo)
        {

            return $this->renderer->render($this->templateSelector,array(
                'nombre' => $nombre_campo,
                'type' => $this->camposBusquedaFull[$nombre_campo]['type'],

            )) ;
        }  
        function exportar()
        {

            $this->mostrarBorrar=false;
            $this->mostrarDetalle=false;
            $this->mostrarEditar=false;
            $request=$this->request;
            $aColumns=array();    
            $session = $this->getRequest()->getSession();
            $dql=$session->get('dql'); 
            list($bundle,$this->tabla)=explode(":",$this->entity);     
            $this->tabla=strtolower($this->tabla);
            $campos =$this->getCampos();
            $camposA =$this->getAsociados();
            $aColumns =$this->getCamposQuery($campos,$camposA);        
            $query = $this->em->createQuery($dql);
            $result=$query->getResult();

            $resultado=$this->convertirObjeto($result,$aColumns);
            //echo "<pre>";
            //print_r($resultado); 

            $csv="";
            foreach ($aColumns as $ind => $val)
            {

                $csv.='"'.$val.'";'; 
            }
            $csv.="\n";
            foreach ($resultado as $reg)
            {
                foreach ($reg as $val)
                {  
                    if (preg_match("/^<img/i", $val))
                    {

                    }
                    else
                        $csv.='"'.$val.'";';
                }
                $csv.="\n";  
            }

            return $csv;   
        }


    }

?>