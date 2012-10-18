<?php

namespace PB\VentasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PB\VentasBundle\Entity\Comercial
 */
class Comercial
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
     * @var string $nif
     */
    private $nif;

    /**
     * @var string $direccion
     */
    private $direccion;

    /**
     * @var integer $cp
     */
    private $cp;

    /**
     * @var integer $telefono
     */
    private $telefono;

    /**
     * @var integer $porcentaje
     */
    private $porcentaje;

    /**
     * @var integer $es_cliente
     */
    private $es_cliente;


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
     * @return Comercial
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
     * Set nif
     *
     * @param string $nif
     * @return Comercial
     */
    public function setNif($nif)
    {
        $this->nif = $nif;
    
        return $this;
    }

    /**
     * Get nif
     *
     * @return string 
     */
    public function getNif()
    {
        return $this->nif;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Comercial
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
     * Set cp
     *
     * @param integer $cp
     * @return Comercial
     */
    public function setCp($cp)
    {
        $this->cp = $cp;
    
        return $this;
    }

    /**
     * Get cp
     *
     * @return integer 
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set telefono
     *
     * @param integer $telefono
     * @return Comercial
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
     * Set porcentaje
     *
     * @param integer $porcentaje
     * @return Comercial
     */
    public function setPorcentaje($porcentaje)
    {
        $this->porcentaje = $porcentaje;
    
        return $this;
    }

    /**
     * Get porcentaje
     *
     * @return integer 
     */
    public function getPorcentaje()
    {
        return $this->porcentaje;
    }

    /**
     * Set es_cliente
     *
     * @param integer $esCliente
     * @return Comercial
     */
    public function setEsCliente($esCliente)
    {
        $this->es_cliente = $esCliente;
    
        return $this;
    }

    /**
     * Get es_cliente
     *
     * @return integer 
     */
    public function getEsCliente()
    {
        return $this->es_cliente;
    }
    /**
     * @var string $localidad
     */
    private $localidad;


    /**
     * Set localidad
     *
     * @param string $localidad
     * @return Comercial
     */
    public function setLocalidad($localidad)
    {
        $this->localidad = $localidad;
    
        return $this;
    }

    /**
     * Get localidad
     *
     * @return string 
     */
    public function getLocalidad()
    {
        return $this->localidad;
    }
    /**
     * @var string $observaciones
     */
    private $observaciones;

    /**
     * @var PB\InicioBundle\Entity\Provincias
     */
    private $provincia_comercial;


    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return Comercial
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;
    
        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string 
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set provincia_comercial
     *
     * @param PB\InicioBundle\Entity\Provincias $provinciaComercial
     * @return Comercial
     */
    public function setProvinciaComercial(\PB\InicioBundle\Entity\Provincias $provinciaComercial = null)
    {
        $this->provincia_comercial = $provinciaComercial;
    
        return $this;
    }

    /**
     * Get provincia_comercial
     *
     * @return PB\InicioBundle\Entity\Provincias 
     */
    public function getProvinciaComercial()
    {
        return $this->provincia_comercial;
    }
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $comercial;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->comercial = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add comercial
     *
     * @param PB\VentasBundle\Entity\Cliente $comercial
     * @return Comercial
     */
    public function addComercial(\PB\VentasBundle\Entity\Cliente $comercial)
    {
        $this->comercial[] = $comercial;
    
        return $this;
    }

    /**
     * Remove comercial
     *
     * @param PB\VentasBundle\Entity\Cliente $comercial
     */
    public function removeComercial(\PB\VentasBundle\Entity\Cliente $comercial)
    {
        $this->comercial->removeElement($comercial);
    }

    /**
     * Get comercial
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getComercial()
    {
        return $this->comercial;
    }
    public function __toString()
    {
    	return $this->nombre;
    }
}