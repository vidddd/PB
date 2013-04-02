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
    /**
     * @var PB\ComprasBundle\Entity\AlbaranCompraLinea
     */
    private $albarancompralinea;


    /**
     * Set albarancompralinea
     *
     * @param PB\ComprasBundle\Entity\AlbaranCompraLinea $albarancompralinea
     * @return Almacen
     */
    public function setAlbarancompralinea(\PB\ComprasBundle\Entity\AlbaranCompraLinea $albarancompralinea = null)
    {
        $this->albarancompralinea = $albarancompralinea;
    
        return $this;
    }

    /**
     * Get albarancompralinea
     *
     * @return PB\ComprasBundle\Entity\AlbaranCompraLinea 
     */
    public function getAlbarancompralinea()
    {
        return $this->albarancompralinea;
    }
    /**
     * @var string $ubicacion
     */
    private $ubicacion;

    /**
     * @var string $estanteria
     */
    private $estanteria;

    /**
     * @var string $nivel
     */
    private $nivel;

    /**
     * @var string $posicion
     */
    private $posicion;


    /**
     * Set ubicacion
     *
     * @param string $ubicacion
     * @return Almacen
     */
    public function setUbicacion($ubicacion)
    {
        $this->ubicacion = $ubicacion;
    
        return $this;
    }

    /**
     * Get ubicacion
     *
     * @return string 
     */
    public function getUbicacion()
    {
        return $this->ubicacion;
    }

    /**
     * Set estanteria
     *
     * @param string $estanteria
     * @return Almacen
     */
    public function setEstanteria($estanteria)
    {
        $this->estanteria = $estanteria;
    
        return $this;
    }

    /**
     * Get estanteria
     *
     * @return string 
     */
    public function getEstanteria()
    {
        return $this->estanteria;
    }

    /**
     * Set nivel
     *
     * @param string $nivel
     * @return Almacen
     */
    public function setNivel($nivel)
    {
        $this->nivel = $nivel;
    
        return $this;
    }

    /**
     * Get nivel
     *
     * @return string 
     */
    public function getNivel()
    {
        return $this->nivel;
    }

    /**
     * Set posicion
     *
     * @param string $posicion
     * @return Almacen
     */
    public function setPosicion($posicion)
    {
        $this->posicion = $posicion;
    
        return $this;
    }

    /**
     * Get posicion
     *
     * @return string 
     */
    public function getPosicion()
    {
        return $this->posicion;
    }
}