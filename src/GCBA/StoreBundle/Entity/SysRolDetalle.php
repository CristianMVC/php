<?php
namespace GCBA\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SysRolDetalle
 *
 * @ORM\Table(name="sys_rol_detalle")
 * @ORM\Entity
 */
 
class SysRolDetalle
{
    
    
  
    

 /**
 * @var integer
 * 
 * @ORM\Column(name="id_rol", type="integer")
 */    
    protected $id_rol;
    
 /**
     * @var integer
     *
     * @ORM\Column(name="id_area", type="integer")
     */
    protected $id_area;
  
  /**
     * @var string
     *
     * @ORM\Column(name="Detealle_area", type="string", length=100, nullable=true)
     */  
 
     protected $Detealle_area; 
    
/**
* Get Id_rol
*
* @return integer 
*/    

    public function getId_rol()
    {
        return $this->id;
    }
    
/**
* Set Id_rol
* @param integer $Id_rol
* @return Id_rol
*/     

    public function setId_rol($Id_rol)
    {
        $this->Id_rol = $Id_rol;
    }    
  
  

/**
* Get id_area
*
* @return integer 
*/     
    public function getId_area()
    {
        return $this->id_area;
    }
    

/**
* Set id_area
* @param integer $id_area
* @return id_area
*/    
       
    public function setId_area($id_area)
    {
        $this->id_area = $id_area;
    }
    
    
/**
* Get Detalle_area
*
* @return string 
*/     
    public function getDetalle_area()
    {
        return $this->Detalle_area;
    }
    

/**
* Set Detealle_area
* @param integer $Detealle_area
* @return Detalle_area
*/    
       
    public function setDetealle_area($Detealle_area)
    {
        $this->Detalle_area = $Detalle_area;
    }
        
    
}