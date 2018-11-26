<?php

namespace GCBA\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SysModulo
 *
 * @ORM\Table(name="sys_modulo")
 * @ORM\Entity
 */
class SysModulo
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=20, nullable=false)
     */
    private $nombre;

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
     * @var integer
     *
     * @ORM\Column(name="borrado", type="integer", nullable=false)
     */
    private $borrado;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_sys_modulo", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSysModulo;



    /**
     * Set nombre
     *
     * @param string $nombre
     * @return SysModulo
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
     * @return SysModulo
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
     * @return SysModulo
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
     * @param integer $borrado
     * @return SysModulo
     */
    public function setBorrado($borrado)
    {
        $this->borrado = $borrado;
    
        return $this;
    }

    /**
     * Get borrado
     *
     * @return integer 
     */
    public function getBorrado()
    {
        return $this->borrado;
    }

    /**
     * Get idSysModulo
     *
     * @return integer 
     */
    public function getIdSysModulo()
    {
        return $this->idSysModulo;
    }
}