    
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>Mdu Registro de Profesionales</title>

  
<link href="/apps/rdp/web/css/grids.css" rel="stylesheet" type="text/css" />
<link href="/apps/rdp/web/css/reset.css" rel="stylesheet" type="text/css" />
<link href="/apps/rdp/web/css/style.css" rel="stylesheet" type="text/css" />
<link href="/apps/rdp/web/fonts/fonts.css" rel="stylesheet" type="text/css" />
<link href="/apps/rdp/web/css/print.css" rel="stylesheet" type="text/css" media="print"  />
<link rel="stylesheet" href="/apps/rdp/web/css/jquery-ui.css">

<link rel="stylesheet" href="/apps/rdp/web/css/uniform.form_ba.css" type="text/css" media="screen">

<link type="text/css" href="/apps/rdp/web/css/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
   
 <script src="/apps/rdp/web/js/jquery/jquery-1.11.0.min.js" type="text/javascript"></script>
 <script src="/apps/rdp/web/DataTables/media/js/jquery.dataTables.js" type="text/javascript"></script>
  




  <script src="/apps/rdp/web/js/uniform211/jquery.uniform.js" type="text/javascript"></script>


 
<script type="text/javascript" >
   
   $(function(){
    $.uniform.defaults.fileButtonHtml = "Seleccione";
    $.uniform.defaults.fileDefaultHtml = "Sin archivo";
        $("input, textarea, select, button").uniform();
        
        
      });   
</script>


</head>
 <body>

<!--EMPIEZA EL HEADER-->
<div class="header " id="cabecera_fija"  style="position:fixed;top:0;left:0;z-index:999999;width:100%;">
	<div class="container_12" style="position:relative;">
		<div class="grid_4">
			<h1 title='0.4.0'>
				Mdu Registro de Profesionales 
			
			</h1>
		</div>

                         
                    
<script>
                       
                       
                       function cambiar_div(div)
                {

                    if ($('#'+div).is(':visible')) 
                    {
                        $('#'+div).hide()
                    } else {
                        $('#'+div).show()
                    }
                
                }
       
       
       
       </script> 
               
<div class='usuario_perfil' >
    <a href="#" onclick="cambiar_div('div_perfil');return false;">Usuario: nferro@buenosaires.gob.ar </a>
    
    <div id='div_perfil' class='perfil' style='display:none'>
    <ul>
    <li>Nicolas Ferro</li>
        
        <li>nferro@buenosaires.gob.ar</li>
        </ul>
       
        <ul>
         <li>Superadmin (ROLE_SUPERADMIN)</li>
     </ul>
       
       
         
    </div></div>
    
     
        <div class="grid_4 push_4">
                <img src="/apps/rdp/web/images/buenosaires_vos.png" alt="Buenos Aires Ciudad" />
        </div>
            
            
                <div class="volver">
                    <a href="javascript:history.back(1)">Volver Atr&aacute;s</a>
                </div>
           
                      

    
	 







	</div>


		

	
<!--TERMINA EL HEADER-->


 <!--EMPIEZA LA PRIMER LINEA DE MENU-->   
    <div class="user_bar clearfix">
        <div class="container_12 clearfix">
            <div class="menu">
                   <ul>
                   <li class="menu_inicio"><a href="http://10.9.3.15/apps/rdp/web/">Inicio</a></li>
                </ul>
                 <!--   twig -->
                 
                           <ul>
             
        <li onmouseover="$(&#039;#contenedor_opciones_1&#039;).show()" onmouseout="$(&quot;#contenedor_opciones_1&quot;).hide()" class="first" >        <a href="#">Profesional</a>        
       
                <ul id="contenedor_opciones_1" style="display: none;" >
             
        <li class="first" >        <a href="/apps/rdp/web/Profesional/Alta">Alta</a>        
       
        
    </li>

 
        <li class="last" >        <a href="/apps/rdp/web/Profesional/">Listar</a>        
       
        
    </li>

                                     
    </ul>   

    </li>

 
        <li onmouseover="$(&#039;#contenedor_opciones_2&#039;).show()" onmouseout="$(&quot;#contenedor_opciones_2&quot;).hide()" >        <a href="#">Metadatos</a>        
       
                <ul id="contenedor_opciones_2" style="display: none;" >
             
        <li class="first" >        <a href="/apps/rdp/web/Metadatos">Listar</a>        
       
        
    </li>

 
        <li >        <a href="/apps/rdp/web/Metadatos/Seleccionar">Importar Entidades</a>        
       
        
    </li>

 
        <li >        <a href="/apps/rdp/web/Consejo/Alta">Alta Consejo</a>        
       
        
    </li>

 
        <li >        <a href="/apps/rdp/web/Consejo/">Listar Consejo</a>        
       
        
    </li>

 
        <li >        <a href="/apps/rdp/web/Titulo/Alta">Alta Titulo</a>        
       
        
    </li>

 
        <li class="last" >        <a href="/apps/rdp/web/Titulo/">Listar Título</a>        
       
        
    </li>

                                     
    </ul>   

    </li>

 
        <li onmouseover="$(&#039;#contenedor_opciones_3&#039;).show()" onmouseout="$(&quot;#contenedor_opciones_3&quot;).hide()" class="last" >        <a href="#">ABM Usuarios</a>        
       
                <ul id="contenedor_opciones_3" style="display: none;" >
             
        <li class="first" >        <a href="/apps/rdp/web/Usuario/">Usuarios</a>        
       
        
    </li>

 
        <li >        <a href="/apps/rdp/web/Usuario/Gcba/">Usuarios Gcba</a>        
       
        
    </li>

 
        <li >        <a href="/apps/rdp/web/Usuario/Perfil/">Perfiles</a>        
       
        
    </li>

 
        <li >        <a href="/apps/rdp/web/Usuario/Perfil/Alta/">Alta Perfil</a>        
       
        
    </li>

 
        <li >        <a href="/apps/rdp/web/Modulo/">Modulo</a>        
       
        
    </li>

 
        <li >        <a href="/apps/rdp/web/Modulo/Alta/">Alta Modulo</a>        
       
        
    </li>

 
        <li >        <a href="/apps/rdp/web/Controlador/">Controladores</a>        
       
        
    </li>

 
        <li >        <a href="/apps/rdp/web/Controlador/Alta/">Alta Controlador</a>        
       
        
    </li>

 
        <li >        <a href="/apps/rdp/web/Accion/">Acción</a>        
       
        
    </li>

 
        <li >        <a href="/apps/rdp/web/Accion/Alta/">Alta Acción</a>        
       
        
    </li>

 
        <li >        <a href="/apps/rdp/web/Perfil/AsignarAccion/">Perfil Acción</a>        
       
        
    </li>

 
        <li >        <a href="/apps/rdp/web/alta_usuario/">Alta Usuario</a>        
       
        
    </li>

 
        <li >        <a href="/apps/rdp/web/Log">Ver Log</a>        
       
        
    </li>

 
        <li class="last" >        <a href="/apps/rdp/web/Bloqueo">Bloqueos</a>        
       
        
    </li>

                                     
    </ul>   

    </li>

                                     
    </ul>   
                 <!--   twig -->
                   <ul>
                    <li class="menu_cerrar_sesion">
                        <a href="http://10.9.3.15/apps/rdp/web/logout">Cerrar Sesión</a>
                    </li>
                   </ul> 

            </div>
        </div>
    </div>
    <!--TERMINA LA PRIMER LINEA DE MENU-->
    <!--EMPIEZA LA SEGUNDA LINEA DE MENU-->   
    
    </div>
    <!--TERMINA LA SEGUNDA LINEA DE MENU-->
<script type="text/javascript">
$(function(){


                 
    var menu = $('#cabecera_fija'),
        pos = menu.offset();
        $(window).scroll(function(){
            if($(this).scrollTop() > pos.top+menu.height() && menu.hasClass('default')){
                menu.fadeOut('fast', function(){
                    $(this).removeClass('default').addClass('fixed').fadeIn('fast');
                });
            } else if($(this).scrollTop() <= pos.top && menu.hasClass('fixed')){
                menu.fadeOut('fast', function(){
                    $(this).removeClass('fixed').addClass('default').fadeIn('fast');
                });
            }
        });

});
</script>
<!--ACA EMPIEZA EL CONTENIDO-->

<style type="text/css" title="currentStyle">
    @import "/apps/rdp/web/DataTables/media/css/demo_page.css"
    @import "/apps/rdp/web/DataTables/media/css/demo_table.css";
    @import "/apps/rdp/web/DataTables/media/css/demo_table.css";
    @import "/apps/rdp/web/DataTables/media/css/TableTools.css";
</style>
   <script type="text/javascript" src="/apps/rdp/web/js/datepicker/js/jquery-ui-1.10.4.custom.min.js"></script>
   <script type="text/javascript" src="/apps/rdp/web/js/datepicker/js/spanish.js"></script> 
         
        <script src="/apps/rdp/web/DataTables/media/js/jquery.dataTables.columnFilter.js" type="text/javascript"></script>
            
        <script type="text/javascript" charset="utf-8" src="/apps/rdp/web/DataTables/media/js/ZeroClipboard.js"></script>
        <script type="text/javascript" charset="utf-8" src="/apps/rdp/web/DataTables/media/js/TableTools.js"></script> 
        
        <script type="text/javascript" charset="utf-8"> 

  
$(document).ready(function() {
        
         var oTable=  $('#Profesional').DataTable( {
  
    "sDom": 'T<"clear">lfrtip',
        
        
        "oTableTools": {   
            "sSwfPath": "/apps/rdp/web/DataTables/media/swf/copy_csv_xls.swf",
            "aButtons": []
            
        },      
          
             
"bStateSave": true, // presumably saves state for reloads
        "bProcessing": false,
        "bServerSide": true,
        "bSortClasses": false ,
        "aLengthMenu":  [5,10,40,50, 100, 250,500,1000], 
        "sAjaxSource": "http://10.9.3.15/apps/rdp/web/DtServer",
      //  "aaSorting": [[ corden, "torden" ]],
               'sPaginationType': 'full_numbers',
       'oLanguage': {
                'sUrl': "/apps/rdp/web/DataTables.spanish.txt"
            }, 
          "fnServerData": function ( sSource, aoData, fnCallback ) {
            /* Add some data to send to the source, and send as 'POST' */
            aoData.push( { "name": "msisdn", "value": $('#msisdn').val() } );
            aoData.push( { "name": "msgdata", "value": $('#msgdata').val() } );
            aoData.push( { "name": "entity", "value": "GCBAStoreBundle:Profesional" } );
            aoData.push( { "name": "bCampob", "value": $('#campo').val() } );
            aoData.push( { "name": "buscar", "value": $('#buscar').val() } );
            aoData.push( { "name": "dql", "value": "" } );

            $.ajax( {
                "dataType": 'json',
                "type": "POST",
                "url": sSource,
                "data": aoData,
                "success": function (data, textStatus, jqXHR) {
                    oTable.fnSettings().oLanguage.sInfoEmpty = data.sMsg;
                    oTable.fnSettings().oLanguage.sEmptyTable = data.sMsg;
                    if (data.sDql)
                    $("#error").html(data.sDql);
               
                  
                    fnCallback(data, textStatus, jqXHR);
                }
            } );
        }
      } )
          .columnFilter({aoColumns:[
                 null, 
                  { sSelector: "#idprofesional",type:"text", 
  
  
  
 }, 
                  { sSelector: "#tipoDoc",type:"select", 
  
  values:[" C\u00e9dula de Identidad Brasilera","C\u00e9dula de Identidad Boliviana ","C\u00e9dula de Identidad Chilena","C\u00e9dula de Identidad Paraguaya","C\u00e9dula de Identidad Peruana","C\u00e9dula de Identidad PF","C\u00e9dula de Identidad Uruguaya","DNI","Indocumentado","Libreta Civica","Libreta de Enrolamiento","Otros DNI extranjeros","Pasaporte","Precario"]  
  
 }, 
                  { sSelector: "#nroDoc",type:"text", 
  
  
  
 }, 
                  { sSelector: "#nroCuit",type:"text", 
  
  
  
 }, 
                  { sSelector: "#apellido",type:"text", 
  
  
  
 }, 
                  { sSelector: "#nombre",type:"text", 
  
  
  
 }, 
                 null, 
                 null, 
                 null, 
                 null, 
                 null, 
                 null, 
                  { sSelector: "#borrado",type:"select", 
  
  values:["No","S\u00ed"]  
  
 }, 
                
                ,
         

       
                ]}
                ,
                {sPlaceHolder: [("thead:before")]}
                
                
            );    
          
jQuery.exists = function(selector) {return ($(selector).length > 0);}         
if ($.exists("select")) {           
$("select").uniform();    
}      
                     } );  // fin dr
        
         
                 
                    
                /*     $(function(){

                // Datepicker
                fecha=new Date('07/12/2013');

                $( ".date_range_filter" ).datepicker( "option", "dateFormat", "dd/mm/yy" );
                $( ".date_range_filter" ).datepicker( "option", "changeMonth", "true" );
                $( ".date_range_filter" ).datepicker( "option", "changeYear", "true" );
                $( ".date_range_filter" ).datepicker( "option", "minDate", fecha );
                $( ".date_range_filter" ).datepicker( "option", "maxDate", "+0Y" );
                $( ".date_range_filter" ).datepicker( "option", "buttonImage", "images/calendar.gif" );
                $( ".date_range_filter" ).datepicker( "option", "buttonImageOnly", "false" );
                $( ".date_range_filter" ).datepicker( "option", "showOn", "button" );
                

                              
               


            });   */ 
  

   </script> 

           
<div class="contenedor_general">   
<div class="container_12">
 <h3 class="subrayado">Profesionales</h3>


   

<div class="clear" style="height:15px;"></div>  

    <form id="form2" method="post">   
   


 
 
 <div> 
 

<div>
 <div class="grid_12 push_0 form_consulta">
     <fieldset> 
      <legend>Buscar por:</legend>
     <div class="separador"></div>

         <div class="grid_8 push_1 alpha omega">
                    <div class="grid_8 alpha omega">
                    
               
                    

     <div class="separador"></div>
<label class="largo" for="seccion">Id:&nbsp;</label>   

 
        <span id="idprofesional">
  
    </span>   
    


  




     <div class="separador"></div>
<label class="largo" for="seccion">Tipo Doc:&nbsp;</label>   

    <div class="cuatro">
      <span id="tipoDoc">
        </span> 
    </div>
    
   


  




     <div class="separador"></div>
<label class="largo" for="seccion">Número de Documento:&nbsp;</label>   

 
        <span id="nroDoc">
  
    </span>   
    


  




     <div class="separador"></div>
<label class="largo" for="seccion">Numero de Cuit:&nbsp;</label>   

 
        <span id="nroCuit">
  
    </span>   
    


  




     <div class="separador"></div>
<label class="largo" for="seccion">Apellido:&nbsp;</label>   

 
        <span id="apellido">
  
    </span>   
    


  




     <div class="separador"></div>
<label class="largo" for="seccion">Nombre:&nbsp;</label>   

 
        <span id="nombre">
  
    </span>   
    


  




     <div class="separador"></div>
<label class="largo" for="seccion">Borrado:&nbsp;</label>   

    <div class="cuatro">
      <span id="borrado">
        </span> 
    </div>
    
   


  




</div>
  </div>
  
  
 </fieldset>
 
 </div>
</div> 
 </div>
 <div class="clear"></div>
 
</div>
 
 
 
 
 <div class="fuera_flujo">  
 <div class="tabla_marginada">
<table id="Profesional" class="contenido display" cellspacing="0">

    <thead>  
   
        <tr>
                                     
                        <th>foto</th>           
                     
                        <th>Id</th>           
                     
                        <th>Tipo Doc</th>           
                     
                        <th>Número de Documento</th>           
                     
                        <th>Numero de Cuit</th>           
                     
                        <th>Apellido</th>           
                     
                        <th>Nombre</th>           
                     
                        <th>Genero</th>           
                     
                        <th>Fecha de Nacimiento</th>           
                     
                        <th>Calle y Número</th>           
                     
                        <th>Nacionalidad</th>           
                     
                        <th>Provincia</th>           
                     
                        <th>Localidad</th>           
                     
                        <th>Borrado</th>           
                     
                                                     <th>&nbsp;</th>           
                                                    <th>Operaciones</th>           
                                                    <th>detalle</th>           
                        </tr>
    </thead>

 
</table>
</div> <!-- tabla marginada-->

</div> <!-- fuera flujo  -->


<div class="container_12">

         
     <div class="separador"></div>  
   <div id="error">

</div>     
    <div id="exportar">
     <a href="http://10.9.3.15/apps/rdp/web/Profesional/Exportar/">Exportar</a>
        
        </div>  
           
     

     <div class="separador"></div>   


                <div class="separador"></div>
                <div class=" grid_4 push_2 form_consulta">
<input type="submit" class="submit" value="Borrar" name="B" id="b" >

</div>
                <div class=" grid_4 push_2 form_consulta">
<input type="submit" class="submit" value="Activar" name="A" id="a" >

</div>
   </form>              
   </div> <!--fin container 12 -->
</div> <!--fin -->

 <!--fin contenido -->    
     
<!--AC? TERMINA EL CONTENIDO-->
   </div>
 <div class="separador"></div>
<div class="pie" style="width:100%;text-align:center;">

<div>
    		<img src="/apps/rdp/web/images/logo_asi.png"/>
        </div>
	</div>
  
</body>


</html>

