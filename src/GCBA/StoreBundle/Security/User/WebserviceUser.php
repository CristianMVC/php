<?php

// src/Acme/WebserviceUserBundle/Security/User/WebserviceUser.php
namespace GCBA\StoreBundle\Security\User;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;

class WebserviceUser implements UserInterface, EquatableInterface
{
    private $username;
    private $password;
    private $salt;
    private $roles;
    private $idSysUsuario;
    public function __construct($username, $password, $salt, array $roles,$usuario)
    {
        $this->username = $username;
        $this->password = $password;
        $this->salt = $salt;
        $this->roles = $roles;
        if ($usuario)
        {
          $this->idSysPerfil=$usuario->getIdSysPerfil();
          $this->nombre=$usuario->getNombre();
          $this->apellido=$usuario->getApellido();
          $this->idSysUsuario=$usuario->getIdSysUsuario();
            
        }

    }

    public function setIdSysPerfil($idSysPerfil)
    {        
        $this->idSysPerfil=$idSysPerfil;
    }    
        public function getIdSysUsuario()
    {
        return $this->idSysUsuario;
    }
        public function getIdSysPerfil()
    {
        return $this->idSysPerfil;
    }

        public function getId()
    {
        return $this->idSysUsuario;
    }

       public function getNombre()
    {
        return $this->nombre;
    }
       public function getUsuario()
    {
        return $this->username;
    }
       public function getApellido()
    {
        return $this->apellido;
    }
    public function getRoles()
    {
        return $this->roles;
    }
      public function setRoles($roles)
    {
        return $this->roles=$roles;
    }
    public function getPassword()
    {
        return $this->password;
    }

    public function getSalt()
    {
        return $this->salt;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function eraseCredentials()
    {
    $this->password="";
    }

    public function isEqualTo(UserInterface $user)
    {
        
        if (!$user instanceof WebserviceUser) {
            return false;
        }

        if ($this->password !== $user->getPassword()) {
            return false;
        }

        if ($this->getSalt() !== $user->getSalt()) {
            return false;
        }

        if ($this->username !== $user->getUsername()) {
            return false;
        }

        return true;
    }
}