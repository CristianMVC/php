<?php

namespace GCBA\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('GCBAStoreBundle:Default:index.html.twig');
    }
    public function clearAction()
    {
        $output=array();
        $return_var="";
        $res="";
        exec("cd ../ && php app/console cache:clear --env=prod > /tmp/cache.txt",$output , $return_var );
        $resultado=file("/tmp/cache.txt");
        foreach ($resultado as $val)
            $res.=$val."";

        return $this->render('GCBAStoreBundle:Default:clear.html.twig',array('res'=>$res));
    }
}
