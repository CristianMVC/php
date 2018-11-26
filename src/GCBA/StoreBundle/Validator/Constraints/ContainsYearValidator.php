<?php
namespace GCBA\StoreBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ContainsYearValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
       if (null === $value) {
            return;
        }
 
    $fecha=$this->context->getRoot()->get('fechaDictamen')->getData();
   // $fecha=date_create_from_format('d/m/Y', $fecha_dictamen);
   //      echo $value." ".$fecha->format("Y");exit;
        if ($value > $fecha->format("Y")) {
            $this->context->addViolation($constraint->maxMessage, array(
                '{{ value }}' => $value,
                '{{ limit }}' => $fecha->format("Y"),
            ));
        }
 
        if (null !== $constraint->max && $value > $constraint->max) {
            $this->context->addViolation($constraint->maxMessage, array(
                '{{ value }}' => $value,
                '{{ limit }}' => $constraint->max,
            ));
        }
 
        if (null !== $constraint->min && $value < $constraint->min) {
            $this->context->addViolation($constraint->minMessage, array(
                '{{ value }}' => $value,
                '{{ limit }}' => $constraint->min,
            ));
        }
    }


}