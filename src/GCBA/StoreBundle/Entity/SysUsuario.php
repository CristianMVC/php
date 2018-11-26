<?php

namespace GCBA\StoreBundle\Entity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * SysUsuario
 *
 * @ORM\Table(name="sys_usuario")
 * @ORM\Entity
 */
class SysUsuario implements UserInterface ,\Serializable
{
    /**
     * @var string
     *
     * @ORM\Column(name="correo", type="string", length=250, nullable=false)
     */
    private $correo;

    /**
     * @var string
     *
     * @ORM\Column(name="usuario", type="string", length=100, nullable=false)
     */
    private $usuario;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=50, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=20, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=20, nullable=false)
     */
    private $apellido;

    /**
     * @var boolean
     *
     * @ORM\Column(name="borrado", type="boolean", nullable=false)
     */
    private $borrado;

    /**
     * @var boolean
     *
     * @ORM\Column(name="intento_login_fallido", type="boolean", nullable=true)
     */
    private $intentoLoginFallido;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_ultimo_intento_fallido", type="datetime", nullable=true)
     */
    private $fechaUltimoIntentoFallido;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="clave_valida_hasta", type="datetime", nullable=false)
     */
    private $claveValidaHasta;

    /**
     * @var boolean
     *
     * @ORM\Column(name="primer_login", type="boolean", nullable=false)
     */
    private $primerLogin;

    /**
     * @var boolean
     *
     * @ORM\Column(name="logeado", type="boolean", nullable=false)
     */
    private $logeado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ultimo_acceso", type="datetime", nullable=false)
     */
    private $ultimoAcceso;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activo", type="boolean", nullable=false)
     */
    private $activo;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255, nullable=false)
     */
    private $salt;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_sys_usuario", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSysUsuario;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GCBA\StoreBundle\Entity\SysPerfil", inversedBy="idSysUsuario")
     * @ORM\JoinTable(name="sys_usuario_perfil",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_sys_usuario", referencedColumnName="id_sys_usuario")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_sys_perfil", referencedColumnName="id_sys_perfil")
     *   }
     * )
     */
    private $idSysPerfil;
    private $client;
  
    /**
     * Constructor
     */
        public function __construct()
    {
       
        $this->idSysPerfil = new \Doctrine\Common\Collections\ArrayCollection();
        $this->isActive = true;
        $this->salt = md5(uniqid(null, true));  
    }
      public function setWs($ipws)
      {
        $this->client = new \nusoap_client($ipws);              
      }
        public function getPerfiles()
    {
        return $this->idSysPerfil;
    } 
        public function getUsername()
    {
;
        return $this->usuario;
    }    
        public function getRoles()
    {
        $roles=array();
        foreach ($this->getPerfiles() as $perfil)
        {
        $roles[]=$perfil->getNombre();
        }     
       // $roles=array('ROLE_USER');
        return $roles;
    }
       /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
  //  $this->password="";
    
    }
    /**
     * Set correo
     *
     * @param string $correo
     * @return SysUsuario
     */
              
       /**
     * @inheritDoc
     */
    public function equals(UserInterface $user)
    {
        
         
        return $this->idSysUsuario === $user->getId();
    }
  
    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
            $this->idSysUsuario,
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->idSysUsuario,
        ) = unserialize($serialized);
    }

    /**
     * Set correo
     *
     * @param string $correo
     * @return SysUsuario
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

    /**
     * Get correo
     *
     * @return string 
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set usuario
     *
     * @param string $usuario
     * @return SysUsuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return string 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return SysUsuario
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return SysUsuario
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
     * Set apellido
     *
     * @param string $apellido
     * @return SysUsuario
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string 
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set borrado
     *
     * @param boolean $borrado
     * @return SysUsuario
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
     * Set intentoLoginFallido
     *
     * @param boolean $intentoLoginFallido
     * @return SysUsuario
     */ 
    public function setIntentoLoginFallido($intentoLoginFallido)
    {
        $this->intentoLoginFallido = $intentoLoginFallido;

        return $this;
    }

    /**
     * Get intentoLoginFallido
     *
     * @return boolean 
     */
    public function getIntentoLoginFallido()
    {
        return $this->intentoLoginFallido;
    }

    /**
     * Set fechaUltimoIntentoFallido
     *
     * @param \DateTime $fechaUltimoIntentoFallido
     * @return SysUsuario
     */
    public function setFechaUltimoIntentoFallido($fechaUltimoIntentoFallido)
    {
        $this->fechaUltimoIntentoFallido = $fechaUltimoIntentoFallido;

        return $this;
    }

    /**
     * Get fechaUltimoIntentoFallido
     *
     * @return \DateTime 
     */
    public function getFechaUltimoIntentoFallido()
    {
        return $this->fechaUltimoIntentoFallido;
    }

    /**
     * Set claveValidaHasta
     *
     * @param \DateTime $claveValidaHasta
     * @return SysUsuario
     */
    public function setClaveValidaHasta($claveValidaHasta)
    {
        $this->claveValidaHasta = $claveValidaHasta;

        return $this;
    }

    /**
     * Get claveValidaHasta
     *
     * @return \DateTime 
     */
    public function getClaveValidaHasta()
    {
        return $this->claveValidaHasta;
    }

    /**
     * Set primerLogin
     *
     * @param boolean $primerLogin
     * @return SysUsuario
     */
    public function setPrimerLogin($primerLogin)
    {
        $this->primerLogin = $primerLogin;

        return $this;
    }

    /**
     * Get primerLogin
     *
     * @return boolean 
     */
    public function getPrimerLogin()
    {
        return $this->primerLogin;
    }

    /**
     * Set logeado
     *
     * @param boolean $logeado
     * @return SysUsuario
     */
    public function setLogeado($logeado)
    {
        $this->logeado = $logeado;

        return $this;
    }

    /**
     * Get logeado
     *
     * @return boolean 
     */
    public function getLogeado()
    {
        return $this->logeado;
    }

    /**
     * Set ultimoAcceso
     *
     * @param \DateTime $ultimoAcceso
     * @return SysUsuario
     */
    public function setUltimoAcceso($ultimoAcceso)
    {
        $this->ultimoAcceso = $ultimoAcceso;

        return $this;
    }

    /**
     * Get ultimoAcceso
     *
     * @return \DateTime 
     */
    public function getUltimoAcceso()
    {
        return $this->ultimoAcceso;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     * @return SysUsuario
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
   public function getDatosporEmail($email="")
   {
       if ($this->client=="")
       return false;
        
       $datos=$this->client->call('buscarporemail',array( 'email' => $email));

       $datos_usuario=$datos;
       return $datos_usuario;   
   }    
    /**
     * Set salt
     *
     * @param string $salt
     * @return SysUsuario
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Get idSysUsuario
     *
     * @return integer 
     */
    public function getIdSysUsuario()
    {
        return $this->idSysUsuario;
    }
    public function getId()
    {
        return $this->idSysUsuario;
    }
    /**
     * Add idSysPerfil
     *
     * @param \GCBA\StoreBundle\Entity\SysPerfil $idSysPerfil
     * @return SysUsuario
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
    public function getNa(){
    return $this->nombre." ".$this->apellido." (".$this->usuario.")";
    }
    
    
    
}