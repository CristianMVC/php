<?php

/* TwigBundle:Exception:error.html.twig */
class __TwigTemplate_78484865200a427261c89ee1ec96e6718c432370f110f881375b6742039f76cc extends Twig_Template
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
        // line 2
        echo "
 <div class=\"contenedor_general\">   

    <div class=\"container_12\">
  ";
        // line 6
        if ((isset($context["error"]) ? $context["error"] : null)) {
            // line 7
            echo "    <div>";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["error"]) ? $context["error"] : null), "message", array()), "html", null, true);
            echo "</div>
";
        }
        // line 8
        echo "   


<div class=\"error_index\">
        <ul>
        <li>Ocurrio un error </li>
        ";
        // line 14
        if (((isset($context["status_code"]) ? $context["status_code"] : null) == 403)) {
            // line 15
            echo "        <li> <h1>";
            echo twig_escape_filter($this->env, (isset($context["message"]) ? $context["message"] : null), "html", null, true);
            echo "No tiene permiso para acceder a esta Aplicación/Acción</h1></li>
        ";
        } else {
            // line 17
            echo "        <li> <h1>\"error ";
            echo twig_escape_filter($this->env, (isset($context["status_code"]) ? $context["status_code"] : null), "html", null, true);
            echo " / ";
            echo twig_escape_filter($this->env, (isset($context["status_text"]) ? $context["status_text"] : null), "html", null, true);
            echo "\"</h1></li>
        ";
        }
        // line 19
        echo "        </ul>
        </div>
     </div>
   </div> 
        
      
";
        // line 25
        $this->env->loadTemplate("abajo.html.twig")->display($context);
    }

    public function getTemplateName()
    {
        return "TwigBundle:Exception:error.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  67 => 25,  59 => 19,  51 => 17,  45 => 15,  43 => 14,  35 => 8,  29 => 7,  27 => 6,  21 => 2,  19 => 1,);
    }
}
