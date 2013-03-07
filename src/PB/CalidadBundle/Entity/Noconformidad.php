<?php

namespace PB\CalidadBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PB\CalidadBundle\Entity\Noconformidad
 */
class Noconformidad
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var \DateTime $fecha_apertura
     */
    private $fecha_apertura;

    /**
     * @var string $descripcion
     */
    private $descripcion;

    /**
     * @var string $acciones_inmediatas
     */
    private $acciones_inmediatas;

    /**
     * @var string $analisis_causas
     */
    private $analisis_causas;

    /**
     * @var string $acciones
     */
    private $acciones;

    /**
     * @var string $responsable
     */
    private $responsable;

    /**
     * @var string $plazo
     */
    private $plazo;

    /**
     * @var \DateTime $fecha_cierre
     */
    private $fecha_cierre;

    /**
     * @var string $explicacion
     */
    private $explicacion;


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
     * Set fecha_apertura
     *
     * @param \DateTime $fechaApertura
     * @return Noconformidad
     */
    public function setFechaApertura($fechaApertura)
    {
        $this->fecha_apertura = $fechaApertura;
    
        return $this;
    }

    /**
     * Get fecha_apertura
     *
     * @return \DateTime 
     */
    public function getFechaApertura()
    {
        return $this->fecha_apertura;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Noconformidad
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
     * Set acciones_inmediatas
     *
     * @param string $accionesInmediatas
     * @return Noconformidad
     */
    public function setAccionesInmediatas($accionesInmediatas)
    {
        $this->acciones_inmediatas = $accionesInmediatas;
    
        return $this;
    }

    /**
     * Get acciones_inmediatas
     *
     * @return string 
     */
    public function getAccionesInmediatas()
    {
        return $this->acciones_inmediatas;
    }

    /**
     * Set analisis_causas
     *
     * @param string $analisisCausas
     * @return Noconformidad
     */
    public function setAnalisisCausas($analisisCausas)
    {
        $this->analisis_causas = $analisisCausas;
    
        return $this;
    }

    /**
     * Get analisis_causas
     *
     * @return string 
     */
    public function getAnalisisCausas()
    {
        return $this->analisis_causas;
    }

    /**
     * Set acciones
     *
     * @param string $acciones
     * @return Noconformidad
     */
    public function setAcciones($acciones)
    {
        $this->acciones = $acciones;
    
        return $this;
    }

    /**
     * Get acciones
     *
     * @return string 
     */
    public function getAcciones()
    {
        return $this->acciones;
    }

    /**
     * Set responsable
     *
     * @param string $responsable
     * @return Noconformidad
     */
    public function setResponsable($responsable)
    {
        $this->responsable = $responsable;
    
        return $this;
    }

    /**
     * Get responsable
     *
     * @return string 
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * Set plazo
     *
     * @param string $plazo
     * @return Noconformidad
     */
    public function setPlazo($plazo)
    {
        $this->plazo = $plazo;
    
        return $this;
    }

    /**
     * Get plazo
     *
     * @return string 
     */
    public function getPlazo()
    {
        return $this->plazo;
    }

    /**
     * Set fecha_cierre
     *
     * @param \DateTime $fechaCierre
     * @return Noconformidad
     */
    public function setFechaCierre($fechaCierre)
    {
        $this->fecha_cierre = $fechaCierre;
    
        return $this;
    }

    /**
     * Get fecha_cierre
     *
     * @return \DateTime 
     */
    public function getFechaCierre()
    {
        return $this->fecha_cierre;
    }

    /**
     * Set explicacion
     *
     * @param string $explicacion
     * @return Noconformidad
     */
    public function setExplicacion($explicacion)
    {
        $this->explicacion = $explicacion;
    
        return $this;
    }

    /**
     * Get explicacion
     *
     * @return string 
     */
    public function getExplicacion()
    {
        return $this->explicacion;
    }
}