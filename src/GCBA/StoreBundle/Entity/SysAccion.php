<?php

namespace GCBA\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SysAccion
 *
 * @ORM\Table(name="sys_accion")
 * @ORM\Entity
 */
class SysAccion
{
    /**
     * @var boolean
     *
     * @ORM\Column(name="es_menu", type="boolean", nullable=false)
     */
    private $esMenu;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=200, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_menu", type="string", length=30, nullable=false)
     */
    private $nombreMenu;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=100, nullable=false)
     */
    private $descripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="orden", type="integer", nullable=false)
     */
    private $orden;

    /**
     * @var boolean
     *
     * @ORM\Column(name="borrado", type="boolean", nullable=false)
     */
    private $borrado;

    /**
     * @var boolean
     *
     * @ORM\Column(name="logear", type="boolean", nullable=false)
     */
    private $logear;

    /**
     * @var boolean
     *
     * @ORM\Column(name="validar_phpsessid", type="boolean", nullable=false)
     */
    private $validarPhpsessid;

    /**
     * @var boolean
     *
     * @ORM\Column(name="es_menu_destacado", type="boolean", nullable=false)
     */
    private $esMenuDestacado;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_route", type="string", length=50, nullable=true)
     */
    private $nombreRoute;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_sys_accion", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSysAccion;

    /**
     * @var \GCBA\StoreBundle\Entity\SysModulo
     *
     * @ORM\ManyToOne(targetEntity="GCBA\StoreBundle\Entity\SysModulo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_sys_modulo", referencedColumnName="id_sys_modulo")
     * })
     */
    private $idSysModulo;

    /**
     * @var \GCBA\StoreBundle\Entity\SysControlador
     *
     * @ORM\ManyToOne(targetEntity="GCBA\StoreBundle\Entity\SysControlador")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_sys_controlador", referencedColumnName="id_sys_controlador")
     * })
     */
    private $idSysControlador;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GCBA\StoreBundle\Entity\SysPerfil", mappedBy="idSysAccion")
     */
    private $idSysPerfil;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idSysPerfil = new \Doctrine\Common\Collections\ArrayCollection();
    }
    

    /**
     * Set esMenu
     *
     * @param boolean $esMenu
     * @return SysAccion
     */
    public function setEsMenu($esMenu)
    {
        $this->esMenu = $esMenu;
    
        return $this;
    }

    /**
     * Get esMenu
     *
     * @return boolean 
     */
    public function getEsMenu()
    {
        return $this->esMenu;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return SysAccion
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
     * Set nombreMenu
     *
     * @param string $nombreMenu
     * @return SysAccion
     */
    public function setNombreMenu($nombreMenu)
    {
        $this->nombreMenu = $nombreMenu;
    
        return $this;
    }

    /**
     * Get nombreMenu
     *
     * @return string 
     */
    public function getNombreMenu()
    {
        return $this->nombreMenu;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return SysAccion
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
     * Set orden
     *
     * @param integer $orden
     * @return SysAccion
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;
    
        return $this;
    }

    /**
     * Get orden
     *
     * @return integer 
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * Set borrado
     *
     * @param boolean $borrado
     * @return SysAccion
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
     * Set logear
     *
     * @param boolean $logear
     * @return SysAccion
     */
    public function setLogear($logear)
    {
        $this->logear = $logear;
    
        return $this;
    }

    /**
     * Get logear
     *
     * @return boolean 
     */
    public function getLogear()
    {
        return $this->logear;
    }

    /**
     * Set validarPhpsessid
     *
     * @param boolean $validarPhpsessid
     * @return SysAccion
     */
    public function setValidarPhpsessid($validarPhpsessid)
    {
        $this->validarPhpsessid = $validarPhpsessid;
    
        return $this;
    }

    /**
     * Get validarPhpsessid
     *
     * @return boolean 
     */
    public function getValidarPhpsessid()
    {
        return $this->validarPhpsessid;
    }

    /**
     * Set esMenuDestacado
     *
     * @param boolean $esMenuDestacado
     * @return SysAccion
     */
    public function setEsMenuDestacado($esMenuDestacado)
    {
        $this->esMenuDestacado = $esMenuDestacado;
    
        return $this;
    }

    /**
     * Get esMenuDestacado
     *
     * @return boolean 
     */
    public function getEsMenuDestacado()
    {
        return $this->esMenuDestacado;
    }

    /**
     * Set nombreRoute
     *
     * @param string $nombreRoute
     * @return SysAccion
     */
    public function setNombreRoute($nombreRoute)
    {
        $this->nombreRoute = $nombreRoute;
    
        return $this;
    }

    /**
     * Get nombreRoute
     *
     * @return string 
     */
    public function getNombreRoute()
    {
        return $this->nombreRoute;
    }

    /**
     * Get idSysAccion
     *
     * @return integer 
     */
    public function getIdSysAccion()
    {
        return $this->idSysAccion;
    }

    /**
     * Set idSysModulo
     *
     * @param \GCBA\StoreBundle\Entity\SysModulo $idSysModulo
     * @return SysAccion
     */
    public function setIdSysModulo(\GCBA\StoreBundle\Entity\SysModulo $idSysModulo = null)
    {
        $this->idSysModulo = $idSysModulo;
    
        return $this;
    }

    /**
     * Get idSysModulo
     *
     * @return \GCBA\StoreBundle\Entity\SysModulo 
     */
    public function getIdSysModulo()
    {
        return $this->idSysModulo;
    }

    /**
     * Set idSysControlador
     *
     * @param \GCBA\StoreBundle\Entity\SysControlador $idSysControlador
     * @return SysAccion
     */
    public function setIdSysControlador(\GCBA\StoreBundle\Entity\SysControlador $idSysControlador = null)
    {
        $this->idSysControlador = $idSysControlador;
    
        return $this;
    }

    /**
     * Get idSysControlador
     *
     * @return \GCBA\StoreBundle\Entity\SysControlador 
     */
    public function getIdSysControlador()
    {
        return $this->idSysControlador;
    }

    /**
     * Add idSysPerfil
     *
     * @param \GCBA\StoreBundle\Entity\SysPerfil $idSysPerfil
     * @return SysAccion
     */
    public function addIdSysPerfil(\GCBA\StoreBundle\Entity\SysPerfil $idSysPerfil)
    {
        $this->idSysPerfil[] = $idSysPerfil;
    
        return $this;
    }

    /**
     * Remove idSysPerfil
     *
     * @param \GCBA\StoreBundle\Entity\SysPerfil $idSysPerfil
     */
    public function removeIdSysPerfil(\GCBA\StoreBundle\Entity\SysPerfil $idSysPerfil)
    {
        $this->idSysPerfil->removeElement($idSysPerfil);
    }

    /**
     * Get idSysPerfil
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdSysPerfil()
    {
        return $this->idSysPerfil;
    }
}