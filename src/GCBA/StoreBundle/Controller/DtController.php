<?php
namespace GCBA\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
class DtController extends Controller
{
      function serverProcessingAction()
      {
             $datatables = $this->get('gcba_datatables');
                echo $datatables->serverProcessing();
         
              return $this->render('GCBAStoreBundle:Default:vacio.html.twig',array(

            ));  
          
      }
}