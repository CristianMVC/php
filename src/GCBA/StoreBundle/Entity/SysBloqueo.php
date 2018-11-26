<?php

namespace GCBA\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SysBloqueo
 *
 * @ORM\Table(name="sys_bloqueo")
 * @ORM\Entity
 */
class SysBloqueo
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="bloqueado_hasta", type="datetime", nullable=false)
     */
    private $bloqueadoHasta;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="bloqueado_desde", type="datetime", nullable=false)
     */
    private $bloqueadoDesde;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activo", type="boolean", nullable=false)
     */
    private $activo;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_sys_bloqueo", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSysBloqueo;

    /**
     * @var \GCBA\StoreBundle\Entity\SysUsuario
     *
     * @ORM\ManyToOne(targetEntity="GCBA\StoreBundle\Entity\SysUsuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_sys_usuario", referencedColumnName="id_sys_usuario")
     * })
     */
    private $idSysUsuario;



    /**
     * Set bloqueadoHasta
     *
     * @param \DateTime $bloqueadoHasta
     * @return SysBloqueo
     */
    public function setBloqueadoHasta($bloqueadoHasta)
    {
        $this->bloqueadoHasta = $bloqueadoHasta;
    
        return $this;
    }

    /**
     * Get bloqueadoHasta
     *
     * @return \DateTime 
     */
    public function getBloqueadoHasta()
    {
        return $this->bloqueadoHasta;
    }

    /**
     * Set bloqueadoDesde
     *
     * @param \DateTime $bloqueadoDesde
     * @return SysBloqueo
     */
    public function setBloqueadoDesde($bloqueadoDesde)
    {
        $this->bloqueadoDesde = $bloqueadoDesde;
    
        return $this;
    }

    /**
     * Get bloqueadoDesde
     *
     * @return \DateTime 
     */
    public function getBloqueadoDesde()
    {
        return $this->bloqueadoDesde;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     * @return SysBloqueo
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;
    
        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean 
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Get idSysBloqueo
     *
     * @return integer 
     */
    public function getIdSysBloqueo()
    {
        return $this->idSysBloqueo;
    }

    /**
     * Set idSysUsuario
     *
     * @param \GCBA\StoreBundle\Entity\SysUsuario $idSysUsuario
     * @return SysBloqueo
     */
    public function setIdSysUsuario(\GCBA\StoreBundle\Entity\SysUsuario $idSysUsuario = null)
    {
        $this->idSysUsuario = $idSysUsuario;
    
        return $this;
    }

    /**
     * Get idSysUsuario
     *
     * @return \GCBA\StoreBundle\Entity\SysUsuario 
     */
    public function getIdSysUsuario()
    {
        return $this->idSysUsuario;
    }
}