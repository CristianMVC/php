<?php

/* GCBAStoreBundle:Security:login.html.twig */
class __TwigTemplate_2cd0bbbba7ac1035408a4c01fec77be82bc246bcda06c84d4f6f92b9f8ab60de extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->env->loadTemplate("arriba.html.twig")->display($context);
        echo " 


<div class=\"contenedor_general\">
<div class=\"container_12\">


    <div class=\"grid_6 push_3 form_consulta\">
    

    
        <form name=\"frm\" method=\"post\" action=\"";
        // line 12
        echo $this->env->getExtension('routing')->getPath("login_check");
        echo "\" >
            <fieldset>
                <legend>autenticaci&oacute;n</legend>
                
                
                                
                <div class=\"separador\"></div>
                   ";
        // line 19
        if ((isset($context["error"]) ? $context["error"] : null)) {
            echo "     
            <div class='error_index grid_4 push_1 form_consulta'>

                ";
            // line 22
            if (($this->getAttribute((isset($context["error"]) ? $context["error"] : null), "message", array()) == "Bad credentials")) {
                // line 23
                echo "                 Los datos suministrados son incorrectos
                ";
            } else {
                // line 24
                echo "    
                ";
                // line 25
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["error"]) ? $context["error"] : null), "message", array()), "html", null, true);
                echo "
                ";
            }
            // line 27
            echo "            </div> 
            ";
        }
        // line 28
        echo "   
                <div class=\"separador\"></div>
                
                
                <label class=\"largo\" for=\"nombre\">Usuario (*)</label>
                <input class=\"tres text\" type=\"text\" required=\"required\" name=\"_username\" id='_username' value=\"";
        // line 33
        echo twig_escape_filter($this->env, (isset($context["last_username"]) ? $context["last_username"] : null), "html", null, true);
        echo "\" />
                
                <div class=\"separador\"></div>
            
                <label class=\"largo\" for=\"seccion\">Contrase&ntilde;a (*)</label>
                <input class=\"tres text\"   type=\"password\" required=\"required\"  name=\"_password\" id='_password' autocomplete=\"off\" />
                
                <div class=\"separador\"></div>
             
                <div class=\" grid_2 push_2 form_consulta\">
                    <input class=\"submit\" type=\"submit\" name=\"Submit\" value=\"Ingresar\" />  
                </div>
        
                <div class=\"separador\"></div>
            </fieldset>
        </form>
        
    </div>
</div>

";
        // line 53
        $this->env->loadTemplate("abajo.html.twig")->display($context);
        echo "  ";
    }

    public function getTemplateName()
    {
        return "GCBAStoreBundle:Security:login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  97 => 53,  74 => 33,  67 => 28,  63 => 27,  58 => 25,  55 => 24,  51 => 23,  49 => 22,  43 => 19,  33 => 12,  19 => 1,);
    }
}
