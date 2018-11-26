<?php
namespace GCBA\StoreBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ContainsPasswordValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        $usuario="00000";
        if (method_exists($this->context->getRoot(),"get"))
        $usuario=$this->context->getRoot()->get('usuario')->getData();
        
        if ($this->validarPassword($value,$usuario)===false)
        {
               

            $this->context->addViolation(
                $this->message,
                array('%string%' => $value)
            );
        }
    }

/**
* Politica de contraseñas...
*     
- Establecer una longitud mínima de ocho (8) caracteres.
- No permitir identificadores de usuario (nombre, apellidos o ID).
- Obligar la utilización de contraseñas compuestas por la combinación de caracteres
especiales, números y letras mayúsculas y minúsculas.
- Bloquear el usuario frente a repetidos intentos de acceso.
- Obligar su cambio cuando el usuario ingrese por primera vez al sistema o servicio.
- Solicitar el cambio obligatorio de la contraseña de forma periódica.
- Conservar un histórico de los sucesivos cambios a fin de evitar su reutilización de forma no
controlada.
* @param mixed $password
 * @param mixed $password
 * @param mixed $usuario
 */
     function validarPassword($password,$usuario)
    {

     /***** 1 *******/

        if (strlen($password)<8)
        {
          $this->message= "La clave no puede ser menor de 8 caracteres";
        return false;
        }
        /***** 2 *******/
        if (preg_match("/@/",$usuario)==true)
        list($usuario,$dominio)=explode("@",$usuario);
        if (!strpos($password,$usuario)===false)

        {
              $this->message= "La clave no puede ser igual que el usuario $usuario;";
            return false;
        }
        
        if (!preg_match('`[a-zA-Z]`',$password)){
      $this->message= "La clave debe tener al menos una letra";
      return false;
   }
   
   if (!preg_match('`[0-9]`',$password)){
      $this->message= "La clave debe tener al menos un caracter numérico";
      return false;
}
   
    }  


}