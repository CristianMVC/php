<?php

namespace GCBA\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SysLog
 *
 * @ORM\Table(name="sys_log")
 * @ORM\Entity
 */
class SysLog
{
    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=45, nullable=true)
     */
    private $ip;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="orig", type="text", nullable=true)
     */
    private $orig;

    /**
     * @var string
     *
     * @ORM\Column(name="modificado", type="text", nullable=true)
     */
    private $mod;

    /**
     * @var integer
     *
     * @ORM\Column(name="idlog", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idlog;

    /**
     * @var \GCBA\StoreBundle\Entity\SysAccion
     *
     * @ORM\ManyToOne(targetEntity="GCBA\StoreBundle\Entity\SysAccion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="accion", referencedColumnName="id_sys_accion")
     * })
     */
    private $accion;

    /**
     * @var \GCBA\StoreBundle\Entity\SysUsuario
     *
     * @ORM\ManyToOne(targetEntity="GCBA\StoreBundle\Entity\SysUsuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="administrador", referencedColumnName="id_sys_usuario")
     * })
     */
    private $administrador;



    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return SysLog
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
     * Set ip
     *
     * @param string $ip
     * @return SysLog
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    
        return $this;
    }

    /**
     * Get ip
     *
     * @return string 
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return SysLog
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    
        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set orig
     *
     * @param string $orig
     * @return SysLog
     */
    public function setOrig($orig)
    {
        $this->orig = $orig;
    
        return $this;
    }

    /**
     * Get orig
     *
     * @return string 
     */
    public function getOrig()
    {
        return $this->orig;
    }

    /**
     * Set mod
     *
     * @param string $mod
     * @return SysLog
     */
    public function setMod($mod)
    {
        $this->mod = $mod;
    
        return $this;
    }

    /**
     * Get mod
     *
     * @return string 
     */
    public function getMod()
    {
        return $this->mod;
    }

    /**
     * Get idlog
     *
     * @return integer 
     */
    public function getIdlog()
    {
        return $this->idlog;
    }

    /**
     * Set accion
     *
     * @param \GCBA\StoreBundle\Entity\SysAccion $accion
     * @return SysLog
     */
    public function setAccion(\GCBA\StoreBundle\Entity\SysAccion $accion = null)
    {
        $this->accion = $accion;
    
        return $this;
    }

    /**
     * Get accion
     *
     * @return \GCBA\StoreBundle\Entity\SysAccion 
     */
    public function getAccion()
    {
        return $this->accion;
    }

    /**
     * Set administrador
     *
     * @param \GCBA\StoreBundle\Entity\SysUsuario $administrador
     * @return SysLog
     */
    public function setAdministrador(\GCBA\StoreBundle\Entity\SysUsuario $administrador = null)
    {
        $this->administrador = $administrador;
    
        return $this;
    }

    /**
     * Get administrador
     *
     * @return \GCBA\StoreBundle\Entity\SysUsuario 
     */
    public function getAdministrador()
    {
        return $this->administrador;
    }
}