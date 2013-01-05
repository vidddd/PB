<?php

namespace PB\ComprasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PB\ComprasBundle\Entity\AlbaranCompraLinea
 */
class AlbaranCompraLinea
{
    /**
     * @var integer $id
     */
    private $id;


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
     * @var string $lifecycleCallbacks
     */
    private $lifecycleCallbacks;


    /**
     * Set lifecycleCallbacks
     *
     * @param string $lifecycleCallbacks
     * @return AlbaranCompraLinea
     */
    public function setLifecycleCallbacks($lifecycleCallbacks)
    {
        $this->lifecycleCallbacks = $lifecycleCallbacks;
    
        return $this;
    }

    /**
     * Get lifecycleCallbacks
     *
     * @return string 
     */
    public function getLifecycleCallbacks()
    {
        return $this->lifecycleCallbacks;
    }
    /**
     * @var PB\ComprasBundle\Entity\AlbaranCompra
     */
    private $albarancompralinea;


    /**
     * Set albarancompralinea
     *
     * @param PB\ComprasBundle\Entity\AlbaranCompra $albarancompralinea
     * @return AlbaranCompraLinea
     */
    public function setAlbarancompralinea(\PB\ComprasBundle\Entity\AlbaranCompra $albarancompralinea = null)
    {
        $this->albarancompralinea = $albarancompralinea;
    
        return $this;
    }

    /**
     * Get albarancompralinea
     *
     * @return PB\ComprasBundle\Entity\AlbaranCompra 
     */
    public function getAlbarancompralinea()
    {
        return $this->albarancompralinea;
    }
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
     * @var float $precio
     */
    private $precio;

    /**
     * @var float $descuento
     */
    private $descuento;

    /**
     * @var float $total
     */
    private $total;


    /**
     * Set referencia
     *
     * @param string $referencia
     * @return AlbaranCompraLinea
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
     * @return AlbaranCompraLinea
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
     * @return AlbaranCompraLinea
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
     * Set precio
     *
     * @param float $precio
     * @return AlbaranCompraLinea
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    
        return $this;
    }

    /**
     * Get precio
     *
     * @return float 
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set descuento
     *
     * @param float $descuento
     * @return AlbaranCompraLinea
     */
    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;
    
        return $this;
    }

    /**
     * Get descuento
     *
     * @return float 
     */
    public function getDescuento()
    {
        return $this->descuento;
    }

    /**
     * Set total
     *
     * @param float $total
     * @return AlbaranCompraLinea
     */
    public function setTotal($total)
    {
        $this->total = $total;
    
        return $this;
    }

    /**
     * Get total
     *
     * @return float 
     */
    public function getTotal()
    {
        return $this->total;
    }
}