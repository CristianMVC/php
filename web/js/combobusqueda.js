         /*************************/
/***************************************/

function trim_text(str){
       str = eval("str.replace(/^"+String.fromCharCode(32)+"*(.*[^"+String.fromCharCode(32)+"])"+String.fromCharCode(32)+"*$/,'$1')");
       return  str;
}
function trim(str,espacio){
       str = eval("str.replace(/^"+String.fromCharCode(espacio)+"*(.*[^"+String.fromCharCode(espacio)+"])"+String.fromCharCode(espacio)+"*$/,'$1')");
       return  str;
}
function saca_acento(str){
       str = str.replace("á","a");
       str = str.replace("é","e");
       str = str.replace("í","i");
       str = str.replace("ó","o");
       str = str.replace("ú","u");
       return str;
}
function buscar_com(obj,numero,combo,nregistro){
       eval ("var txtbuscar = document.getElementById('txt_busca"+numero+"')"); 
       if (trim_text(txtbuscar.value)!=''){
               eval ("var combo = document.getElementById('"+combo+"')");
               eval ("var re=/"+trim_text(saca_acento(txtbuscar.value.toLowerCase()))+"/");
               var encontro=false;
               switch(obj.id.substring(0,obj.id.length-1)){
                       case "busca":
                               for (var i=0;i<combo.options.length;i++){
                                       if ( (trim_text(saca_acento(combo.options[i].text.toLowerCase())).search(re))>=0 ){
                                               combo.selectedIndex=i;
                                               encontro=true;
                                               break;
                                       }
                               }
                       break;
                       case "busca_pro":
                               for (var i=combo.selectedIndex+1;i<combo.options.length;i++){
                                       if ( (trim_text(saca_acento(combo.options[i].text.toLowerCase())).search(re))>=0 ){
                                               combo.selectedIndex=i;
                                                encontro=true;
                                               break;
                                       }
                               }
                       break;
                       case "busca_ant":
                               for (var i=combo.selectedIndex-1;i>=0;i--){
                                       if ( (trim_text(saca_acento(combo.options[i].text.toLowerCase())).search(re))>=0 ){
                                               combo.selectedIndex=i;
                                                encontro=true;
                                               break;
                                       }
                               }
                       break;
               }
               if (encontro==false)
                   alert("No se encontraron resultados para esa búsqueda ");
       }
}
function cap_key(evt,numero){
       evt = (evt) ? evt : window.event;
       var charcode = (evt.which) ? evt.which : evt.KeyCode;
       if (charcode == 13){
               eval ("var boton = document.getElementById('busca_rep"+numero+"')");
               buscar_com(boton,numero);
               return false;
       }else{
               return true;
       }
}
function popup(nombre,pagina,x,y){
       eval ("newwin_"+nombre+"=window.open('"+pagina+"','"+nombre+"','height='+x+',top=' + (screen.height-x)/2 + ',width='+y+',left=' + (screen.width - y)/2 + ',toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=yes,resizable=no');");
       eval ("newwin_"+nombre+".focus();");
       return false;
}
function nuevorubro(){
       popup('popup.php?popup_modulo=popup_altas_rubro&alta_licitacion=true');
}
function vaidarubroref(value){
       if (value.substring(value.indexOf("-")+1,value.length)==0){
               alert ("No puede seleccionar el título del rubro.");
       }
       return true;
}
function sacanumero(obj){
       if (obj.value=="Número"){
               obj.value="";
               return true;
       }
       return false;
}

/*****************************/
/*
$(document).ready(function(){
        $('#txt_busca1').keypress(function(e){
                if(e.which == 13){
                    e.preventDefault();
            }
        });
        jQuery.fn.resetForm = function () {
                                      $(this).each (function() { this.reset(); });
                                    }
}); */