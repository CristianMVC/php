<?php

namespace GCBA\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SysControlador
 *
 * @ORM\Table(name="sys_controlador")
 * @ORM\Entity
 */
class SysControlador
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=50, nullable=false)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="borrado", type="integer", nullable=false)
     */
    private $borrado;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_sys_controlador", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSysControlador;



    /**
     * Set nombre
     *
     * @param string $nombre
     * @return SysControlador
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
     * Set borrado
     *
     * @param integer $borrado
     * @return SysControlador
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
     * Get idSysControlador
     *
     * @return integer 
     */
    public function getIdSysControlador()
    {
        return $this->idSysControlador;
    }
}