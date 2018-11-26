<?php
namespace GCBA\StoreBundle\Validator\Constraints;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\HttpKernel\Exception\FatalErrorException;
;
class ContainsDireccionLaboralValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        $resultado=false; 

        $dat=$this->sepcallealtura($value);
        
    
       // echo "calle $calle $altura";
        if (array_key_exists("direc",$dat))
        $resultado=$this->validarDireccionCallejero($dat["direc"],$dat["altura"]);
        if ($resultado==false) 
        {    
               $error="";
               if ($this->mensaje_error<>"")
               { 
               // if (DEBUG==true)
              //  $error=$this->mensaje_error;
                $constraint->message="Error en el ws del callejero ".$error;
               }
               else 
                $constraint->message="Dirección Invalida";
            $this->context->addViolation(
                $constraint->message,
                array('%string%' => $value)
            );
        }
    }

     function validarDireccionCallejero($calle,$altura)
    {
      global $kernel;
      $callejero=$kernel->getContainer()->get('gcba_api_callejero');
      $dbc=$callejero->getComunaBarrio($calle,$altura);

      if ($dbc==null)
      {
       $this->mensaje_error=$callejero->mensaje_error;
       return false;
      }   
      if (is_array($dbc) && array_key_exists("comuna",$dbc) && $dbc["comuna"]<>"")
      return true; 
   } 
                                     
       function sepcallealtura($direccion)
    {
        $dat=array();
        $dat["direc"]="";
        $dat["altura"]="";

        if (strpos($direccion," y "))
        {
        $dat["direc"]=$direccion;
        $dat["altura"]="";
        return $dat;
        }
        $datos=explode(" ",$direccion);
        $total=count($datos);
        if (is_numeric($datos[$total-1]))
        {
        for($i=0;$i<$total-1;$i++)
        {
        $dat["direc"].=$datos[$i]." ";
        }
        $dat["altura"]=$datos[$i];
        }
        return $dat;

    }

}