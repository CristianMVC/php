<?php
namespace GCBA\StoreBundle\Validator\Constraints;
 
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\MissingOptionsException;
 
/**
 * @Annotation
 */
class DateRange extends Constraint
{
    public $minMessage = 'La fecha debe ser mas grande que {{ limit }}.';
    public $maxMessage = 'La fecha debe ser menor que {{ limit }}.';
    public $invalidMessage = 'La fecha debe ser valida.';
    public $min;
    public $max;
 
    public function __construct($options = null)
    {
        parent::__construct($options);
 
        if (null === $this->min && null === $this->max) {
            throw new MissingOptionsException('Ambas opciones "min" or "max" deben ser dadas para el campo  ' . __CLASS__, array('min', 'max'));
        }
 
        if (null !== $this->min) {
            if (!$this->validateDate($this->min,"d-m-Y"))
            {
            $this->min = new \DateTime(date("Y-m-d"));
            
            }
            else
            $this->min = new \DateTime($this->min);
        }
 
        if (null !== $this->max) {
            if (!$this->validateDate($this->max,"d-m-Y"))
            {
            

            if (preg_match('/^[+,-]/i', $this->max, $coincidencias))
            {       // echo  substr($this->max,1,1); exit;
             if (preg_match('/^[+,-][0]/i', $this->max, $coincidencias2))
             {
              $tiempo=substr($this->max,strlen($this->max)-1,1);
              $res=preg_match('/(year|month)/', $this->max, $tiempos); 
              
              if (is_array($tiempos) && $res==true && count($tiempos)>0)
              {
                  foreach ($tiempos as $val)
                  $tiempo=$val;
                 
                  
                  switch ($tiempo)
                  {
                      case "year":               ;
                       $fecha_max = date_create_from_format('Y-m-d', date("Y")."-12-31");
                      
                      break;
                      case "month":
                      $fecha_max = date_create_from_format('Y-m-d', date("Y-m")."-30");
                      break;
      
            
                      break;
                  
                  
                  }
                  $this->max=$fecha_max;
              }
              else
              {
               echo "no hay datos ";
               exit;
              }
             }
             else
             {
             $fecha_max = new \DateTime(date("Y-m-d"));
             $fecha_max->modify($this->max);
             $this->max=$fecha_max;
             }
            }
            else
            
            $this->max = new \DateTime(date("Y-m-d"));
            }
            else
            $this->max = new \DateTime($this->max);
        }
    }

    function validateDate($date, $format = 'Y-m-d H:i:s')
    {
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
    
}