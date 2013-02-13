<?php

namespace PB\InicioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PB\InicioBundle\Entity\Usuario
 */
class Usuario
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $usuario
     */
    private $usuario;

    /**
     * @var string $password
     */
    private $password;

    /**
     * @var string $nombrecompleto
     */
    private $nombrecompleto;

    /**
     * @var string $direccion
     */
    private $direccion;

    /**
     * @var integer $telefono
     */
    private $telefono;

    /**
     * @var string $salt
     */
    private $salt;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $roles;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->roles = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
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
     * Set usuario
     *
     * @param string $usuario
     * @return Usuario
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
     * @return Usuario
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
     * Set nombrecompleto
     *
     * @param string $nombrecompleto
     * @return Usuario
     */
    public function setNombrecompleto($nombrecompleto)
    {
        $this->nombrecompleto = $nombrecompleto;
    
        return $this;
    }

    /**
     * Get nombrecompleto
     *
     * @return string 
     */
    public function getNombrecompleto()
    {
        return $this->nombrecompleto;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Usuario
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    
        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set telefono
     *
     * @param integer $telefono
     * @return Usuario
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    
        return $this;
    }

    /**
     * Get telefono
     *
     * @return integer 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return Usuario
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
     * Add roles
     *
     * @param PB\InicioBundle\Entity\Rol $roles
     * @return Usuario
     */
    public function addRole(\PB\InicioBundle\Entity\Rol $roles)
    {
        $this->roles[] = $roles;
    
        return $this;
    }

    /**
     * Remove roles
     *
     * @param PB\InicioBundle\Entity\Rol $roles
     */
    public function removeRole(\PB\InicioBundle\Entity\Rol $roles)
    {
        $this->roles->removeElement($roles);
    }

    /**
     * Get roles
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getRoles()
    {
        return $this->roles;
    }
}