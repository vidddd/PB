<?php

namespace PB\InicioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PB\InicioBundle\Entity\Rol
 */
class Rol
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $nombre
     */
    private $nombre;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $usuarios;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->usuarios = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nombre
     *
     * @param string $nombre
     * @return Rol
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
     * Add usuarios
     *
     * @param PB\InicioBundle\Entity\Usuario $usuarios
     * @return Rol
     */
    public function addUsuario(\PB\InicioBundle\Entity\Usuario $usuarios)
    {
        $this->usuarios[] = $usuarios;
    
        return $this;
    }

    /**
     * Remove usuarios
     *
     * @param PB\InicioBundle\Entity\Usuario $usuarios
     */
    public function removeUsuario(\PB\InicioBundle\Entity\Usuario $usuarios)
    {
        $this->usuarios->removeElement($usuarios);
    }

    /**
     * Get usuarios
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }
}