<?php

namespace GCBA\StoreBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ContainsNumeroCuit extends Constraint
{
    public $message = 'este cuit "%string%" es invalido.';
}