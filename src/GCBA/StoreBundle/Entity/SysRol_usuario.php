<?php
namespace GCBA\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SysRol_usuario
 *
 * @ORM\Table(name="sys_rol_usuario")
 * @ORM\Entity
 */
 
class SysRol_usuario
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
     * @ORM\Column(name="id_usuario", type="integer")
     */
    protected $id_usuario;
    
    
    
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
* Get id_usuario
*
* @return integer 
*/     
    public function getId_usuario()
    {
        return $this->id_area;
    }
    

/**
* Set id_usuario
* @param integer $id_usuario
* @return id_usuario
*/    
       
    public function setId_usuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }
    
    

    /**
     * Set id_rol
     *
     * @param integer $idRol
     * @return SysRol_usuario
     */
    public function setIdRol($idRol)
    {
        $this->id_rol = $idRol;
    
        return $this;
    }

    /**
     * Get id_rol
     *
     * @return integer 
     */
    public function getIdRol()
    {
        return $this->id_rol;
    }

    /**
     * Set id_usuario
     *
     * @param integer $idUsuario
     * @return SysRol_usuario
     */
    public function setIdUsuario($idUsuario)
    {
        $this->id_usuario = $idUsuario;
    
        return $this;
    }

    /**
     * Get id_usuario
     *
     * @return integer 
     */
    public function getIdUsuario()
    {
        return $this->id_usuario;
    }
}