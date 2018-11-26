<?php

namespace GCBA\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SysPerfil
 *
 * @ORM\Table(name="sys_perfil")
 * @ORM\Entity
 */
class SysPerfil
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=30, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=100, nullable=false)
     */
    private $descripcion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="borrado", type="boolean", nullable=false)
     */
    private $borrado;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_sys_perfil", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSysPerfil;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GCBA\StoreBundle\Entity\SysUsuario", mappedBy="idSysPerfil")
     */
    private $idSysUsuario;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GCBA\StoreBundle\Entity\SysAccion", inversedBy="idSysPerfil")
     * @ORM\JoinTable(name="sys_perfil_accion",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_sys_perfil", referencedColumnName="id_sys_perfil")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_sys_accion", referencedColumnName="id_sys_accion")
     *   }
     * )
     */
    private $idSysAccion;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idSysUsuario = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idSysAccion = new \Doctrine\Common\Collections\ArrayCollection();
    }
    

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return SysPerfil
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return SysPerfil
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    
        return $this;
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
     * Set borrado
     *
     * @param boolean $borrado
     * @return SysPerfil
     */
    public function setBorrado($borrado)
    {
        $this->borrado = $borrado;
    
        return $this;
    }

    /**
     * Get borrado
     *
     * @return boolean 
     */
    public function getBorrado()
    {
        return $this->borrado;
    }

    /**
     * Get idSysPerfil
     *
     * @return integer 
     */
    public function getIdSysPerfil()
    {
        return $this->idSysPerfil;
    }

    /**
     * Add idSysUsuario
     *
     * @param \GCBA\StoreBundle\Entity\SysUsuario $idSysUsuario
     * @return SysPerfil
     */
    public function addIdSysUsuario(\GCBA\StoreBundle\Entity\SysUsuario $idSysUsuario)
    {
        $this->idSysUsuario[] = $idSysUsuario;
    
        return $this;
    }

    /**
     * Remove idSysUsuario
     *
     * @param \GCBA\StoreBundle\Entity\SysUsuario $idSysUsuario
     */
    public function removeIdSysUsuario(\GCBA\StoreBundle\Entity\SysUsuario $idSysUsuario)
    {
        $this->idSysUsuario->removeElement($idSysUsuario);
    }

    /**
     * Get idSysUsuario
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdSysUsuario()
    {
        return $this->idSysUsuario;
    }

    /**
     * Add idSysAccion
     *
     * @param \GCBA\StoreBundle\Entity\SysAccion $idSysAccion
     * @return SysPerfil
     */
    public function addIdSysAccion(\GCBA\StoreBundle\Entity\SysAccion $idSysAccion)
    {
        $this->idSysAccion[] = $idSysAccion;
    
        return $this;
    }

    /**
     * Remove idSysAccion
     *
     * @param \GCBA\StoreBundle\Entity\SysAccion $idSysAccion
     */
    public function removeIdSysAccion(\GCBA\StoreBundle\Entity\SysAccion $idSysAccion)
    {
        $this->idSysAccion->removeElement($idSysAccion);
    }

    /**
     * Get idSysAccion
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdSysAccion()
    {
        return $this->idSysAccion;
    }
}