<?php
namespace GCBA\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use GCBA\StoreBundle\Entity\SysRolDetalle;

/**
 * SysRol
 *
 * @ORM\Table(name="sys_rol")
 * @ORM\Entity
 */
 
class SysRol
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
     * @ORM\Column(name="nombre", type="string", length=100, nullable=false, unique=true)
     */
    protected $nombre;
    
    
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
* Get nombre
*
* @return string 
*/  

    public function getNombre()
    {
        return $this->nombre;
    }
    
/**
* Set nombre
* @param string $nombre
* @return nombre
*/    
    
    
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
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