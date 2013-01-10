<?php

namespace PB\AlmacenBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PB\AlmacenBundle\Entity\Almacen
 */
class Almacen
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $referencia
     */
    private $referencia;

    /**
     * @var string $descripcion
     */
    private $descripcion;

    /**
     * @var string $cantidad
     */
    private $cantidad;

    /**
     * @var string $paquete
     */
    private $paquete;

    /**
     * @var string $serie
     */
    private $serie;

    /**
     * @var \DateTime $fecha_entrada
     */
    private $fecha_entrada;


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
     * Set referencia
     *
     * @param string $referencia
     * @return Almacen
     */
    public function setReferencia($referencia)
    {
        $this->referencia = $referencia;
    
        return $this;
    }

    /**
     * Get referencia
     *
     * @return string 
     */
    public function getReferencia()
    {
        return $this->referencia;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Almacen
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
     * Set cantidad
     *
     * @param string $cantidad
     * @return Almacen
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    
        return $this;
    }

    /**
     * Get cantidad
     *
     * @return string 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set paquete
     *
     * @param string $paquete
     * @return Almacen
     */
    public function setPaquete($paquete)
    {
        $this->paquete = $paquete;
    
        return $this;
    }

    /**
     * Get paquete
     *
     * @return string 
     */
    public function getPaquete()
    {
        return $this->paquete;
    }

    /**
     * Set serie
     *
     * @param string $serie
     * @return Almacen
     */
    public function setSerie($serie)
    {
        $this->serie = $serie;
    
        return $this;
    }

    /**
     * Get serie
     *
     * @return string 
     */
    public function getSerie()
    {
        return $this->serie;
    }

    /**
     * Set fecha_entrada
     *
     * @param \DateTime $fechaEntrada
     * @return Almacen
     */
    public function setFechaEntrada($fechaEntrada)
    {
        $this->fecha_entrada = $fechaEntrada;
    
        return $this;
    }

    /**
     * Get fecha_entrada
     *
     * @return \DateTime 
     */
    public function getFechaEntrada()
    {
        return $this->fecha_entrada;
    }
    /**
     * @var PB\AlmacenBundle\Entity\Prodcuto
     */
    private $producto;


    /**
     * Set producto
     *
     * @param PB\AlmacenBundle\Entity\Prodcuto $producto
     * @return Almacen
     */
    public function setProducto(\PB\AlmacenBundle\Entity\Producto $producto = null)
    {
        $this->producto = $producto;
    
        return $this;
    }

    /**
     * Get producto
     *
     * @return PB\AlmacenBundle\Entity\Producto 
     */
    public function getProducto()
    {
        return $this->producto;
    }
    /**
     * @var integer $ancho
     */
    private $ancho;

    /**
     * @var integer $largo
     */
    private $largo;

    /**
     * @var integer $galga
     */
    private $galga;


    /**
     * Set ancho
     *
     * @param integer $ancho
     * @return Almacen
     */
    public function setAncho($ancho)
    {
        $this->ancho = $ancho;
    
        return $this;
    }

    /**
     * Get ancho
     *
     * @return integer 
     */
    public function getAncho()
    {
        return $this->ancho;
    }

    /**
     * Set largo
     *
     * @param integer $largo
     * @return Almacen
     */
    public function setLargo($largo)
    {
        $this->largo = $largo;
    
        return $this;
    }

    /**
     * Get largo
     *
     * @return integer 
     */
    public function getLargo()
    {
        return $this->largo;
    }

    /**
     * Set galga
     *
     * @param integer $galga
     * @return Almacen
     */
    public function setGalga($galga)
    {
        $this->galga = $galga;
    
        return $this;
    }

    /**
     * Get galga
     *
     * @return integer 
     */
    public function getGalga()
    {
        return $this->galga;
    }
}