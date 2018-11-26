<?php
namespace GCBA\StoreBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ContainsNumeroCuitValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        $this->valcuit($value,$resultado);
        
        if ($resultado==0 or $resultado==2) {
            if ($resultado==2)
                $constraint->message="No se admiten cuit de empresas";
            else
                $constraint->message="cuit inválido";
            $this->context->addViolation(
                $constraint->message,
                array('%string%' => $value)
            );
        }
    }

     function valcuit($cuit,&$resultado)
    {

        $coeficiente[0]=5;
        $coeficiente[1]=4;
        $coeficiente[2]=3;
        $coeficiente[3]=2;
        $coeficiente[4]=7;
        $coeficiente[5]=6;
        $coeficiente[6]=5;
        $coeficiente[7]=4;
        $coeficiente[8]=3;
        $coeficiente[9]=2;
        $cuit_rearmado="";
       

        if (substr($cuit, 0, 2)>27  ){
            $resultado=2;
            return 2;
        }  
        $resultado=1;

        for ($i=0; $i < strlen($cuit); $i= $i +1)
        {    //separo cualquier caracter que no tenga que ver con numeros
            if ((Ord(substr($cuit, $i, 1)) >= 48) && (Ord(substr($cuit, $i, 1)) <= 57))
            {
                $cuit_rearmado = $cuit_rearmado . substr($cuit, $i, 1);
            }
        }

        If (strlen($cuit_rearmado) <> 11)
        {  // si to estan todos los digitos
            $resultado=0;
        }
        Else
        {
            $sumador = 0;
            $verificador = substr($cuit_rearmado, 10, 1); //tomo el digito verificador

            For ($i=0; $i <=9; $i=$i+1) {
                $sumador = $sumador + (substr($cuit_rearmado, $i, 1)) * $coeficiente[$i];//separo cada digito y lo multiplico por el coeficiente
            }

            $resultado = $sumador % 11;
            $resultado = 11 - $resultado;  //saco el digito verificador
            $veri_nro = intval($verificador);


            If ($veri_nro <> $resultado)
            {

                if ($veri_nro==0 and $resultado==11)
                    $resultado=1;
                else

                    $resultado=0;

            }
            else
            {
                $resultado=1;
            }


        }

    }  


}