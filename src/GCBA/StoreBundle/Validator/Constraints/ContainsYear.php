<?php

namespace GCBA\StoreBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\MissingOptionsException;
/**
 * @Annotation
 */
class ContainsYear extends Constraint
{
   
   
    public $message = 'este año "%string%" es inválido.';
    
       public $minMessage = 'El año debe ser mayor igual que {{ limit }}.';
    public $maxMessage = 'El año debe ser menor igual que {{ limit }}.';
    public $invalidMessage = 'El año debe ser válido.';
    public $min;
    public $max;
 
    public function __construct($options = null)
    {
        parent::__construct($options);
               if (null === $this->min && null === $this->max) {
            throw new MissingOptionsException('Ambas opciones "min" or "max" deben ser dadas para el tipo  ' . __CLASS__, array('min', 'max'));
        }
 
 
 
        if ($this->max=="ahora" || $this->max=="today") {
            $this->max = date("Y");
        }
    
        if ($this->min=="ahora" || $this->min=="today") {
            $this->min = date("Y");
        }
    }
    
    
    
}