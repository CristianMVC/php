<?php 
namespace GCBA\StoreBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ContainsPassword extends Constraint
{
    public $message = 'la password   es invalida.';
}