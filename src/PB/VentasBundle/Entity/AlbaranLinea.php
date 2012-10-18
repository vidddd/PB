<?php

namespace PB\VentasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PB\VentasBundle\Entity\AlbaranLinea
 */
class AlbaranLinea
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
     * @var float $cantidad
     */
    private $cantidad;


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
     * @return AlbaranLinea
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
     * @return AlbaranLinea
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
     * @param float $cantidad
     * @return AlbaranLinea
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    
        return $this;
    }

    /**
     * Get cantidad
     *
     * @return float 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }
    /**
     * @var PB\VentasBundle\Entity\Albaran
     */
    private $albaran;


    /**
     * Set albaran
     *
     * @param PB\VentasBundle\Entity\Albaran $albaran
     * @return AlbaranLinea
     */
    public function setAlbaran(\PB\VentasBundle\Entity\Albaran $albaran = null)
    {
        $this->albaran = $albaran;
    
        return $this;
    }

    /**
     * Get albaran
     *
     * @return PB\VentasBundle\Entity\Albaran 
     */
    public function getAlbaran()
    {
        return $this->albaran;
    }
}