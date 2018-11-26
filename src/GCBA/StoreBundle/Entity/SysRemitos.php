<?php
namespace GCBA\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SysRemitos
 *
 * @ORM\Table(name="sys_remitos")
 * @ORM\Entity
 */
 
class SysRemitos
{

 /**
 * @ORM\Id
 * @ORM\Column(name="id", type="integer")
 * @ORM\GeneratedValue(strategy="AUTO")
 */    
    protected $id;
    
 /**
     * @var string
     *
     * @ORM\Column(name="area", type="string", length=30, nullable=false)
     */
    protected $area;
    
    
 /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=100, nullable=false)
     */
    protected $descripcion;
    
/**
* Get id
*
* @return integer 
*/    

    public function getId()
    {
        return $this->id;
    }
  
  
/**
* Get area
*
* @return string 
*/  

    public function getArea()
    {
        return $this->area;
    }
    
/**
* Set area
* @param string $area
* @return area
*/    
    
    
    public function setArea($area)
    {
        $this->area = $area;
    }
    

/**
* Get descripcion
*
* @return string 
*/     
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    

/**
* Set descripcion
* @param string $descripcion
* @return descripcion
*/    
       
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }
    
    
}