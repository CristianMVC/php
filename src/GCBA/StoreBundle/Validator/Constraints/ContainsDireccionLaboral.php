<?php

namespace GCBA\StoreBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ContainsDireccionLaboral extends Constraint
{
    public $message = 'esta direccion  "%string%" es invalida.';
}