<?php

/* arriba.html.twig */
class __TwigTemplate_02da239804b77a685b66195d7a1f9a1e1dcd3d4f480883375da350a7d2345af6 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>

<title>";
        // line 5
        echo twig_escape_filter($this->env, (isset($context["aplicacion"]) ? $context["aplicacion"] : null), "html", null, true);
        echo "</title>

  ";
        // line 7
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 20
        echo "
 <script src=\"";
        // line 21
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/jquery/jquery-1.11.0.min.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
 <script src=\"";
        // line 22
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("DataTables/media/js/jquery.dataTables.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
  




 <script src=\"";
        // line 28
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/uniform211/jquery.uniform.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>


 
<script type=\"text/javascript\" >
   
   \$(function(){
    \$.uniform.defaults.fileButtonHtml = \"Seleccione\";
    \$.uniform.defaults.fileDefaultHtml = \"Sin archivo\";
        \$(\"input, textarea, select, button\").uniform();
        
        
      });   
</script>


</head>
 <body>

<!--EMPIEZA EL HEADER-->
<div class=\"header \" id=\"cabecera_fija\"  style=\"position:fixed;top:0;left:0;z-index:999999;width:100%;\">
\t<div class=\"container_12\" style=\"position:relative;\">
\t\t<div class=\"grid_4\">
\t\t\t<h1 title='";
        // line 51
        echo twig_escape_filter($this->env, (isset($context["version"]) ? $context["version"] : null), "html", null, true);
        echo "'>
\t\t\t\t";
        // line 52
        echo twig_escape_filter($this->env, (isset($context["aplicacion"]) ? $context["aplicacion"] : null), "html", null, true);
        echo " 
\t\t\t
\t\t\t</h1>
\t\t</div>

         ";
        // line 57
        if ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "security", array()), "getToken", array(), "method"), "getUser", array(), "method"), "nombre", array())) {
            // line 58
            echo "               ";
            $context["user"] = $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "security", array()), "getToken", array(), "method"), "getUser", array(), "method");
            echo " 
            ";
            // line 59
            $this->env->loadTemplate("datosusuario.html.twig")->display($context);
            echo " 
        <div class=\"grid_4 push_4\">
                <img src=\"";
            // line 61
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("images/buenosaires.png"), "html", null, true);
            echo "\" alt=\"Buenos Aires Ciudad\" />
        </div>
            
            
   
           
                  ";
        }
        // line 68
        echo "    

    
\t 







\t</div>


\t\t

\t
<!--TERMINA EL HEADER-->

";
    }

    // line 7
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 8
        echo "
<link href=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/grids.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" />
<link href=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/reset.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" />
<link href=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/style.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" />
<link href=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("fonts/fonts.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" />
<link href=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/print.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" media=\"print\"  />
<link rel=\"stylesheet\" href=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/jquery-ui.css"), "html", null, true);
        echo "\">

<link rel=\"stylesheet\" href=\"";
        // line 16
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/uniform.form_ba.css"), "html", null, true);
        echo "\" type=\"text/css\" media=\"screen\">

<link type=\"text/css\" href=\"";
        // line 18
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/jquery-ui-1.8.21.custom.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" />
   ";
    }

    public function getTemplateName()
    {
        return "arriba.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  168 => 18,  163 => 16,  158 => 14,  154 => 13,  150 => 12,  146 => 11,  142 => 10,  138 => 9,  135 => 8,  132 => 7,  109 => 68,  99 => 61,  94 => 59,  89 => 58,  87 => 57,  79 => 52,  75 => 51,  49 => 28,  40 => 22,  36 => 21,  33 => 20,  31 => 7,  26 => 5,  20 => 1,  67 => 25,  59 => 19,  51 => 17,  45 => 15,  43 => 14,  35 => 8,  29 => 7,  27 => 6,  21 => 2,  19 => 1,);
    }
}
