<?php

namespace PB\ComprasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PB\ComprasBundle\Entity\PedidoCompraLinea
 */
class PedidoCompraLinea
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
     * @var PB\ComprasBundle\Entity\PedidoCompra
     */
    private $pedidocompralinea;


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
     * @return PedidoCompraLinea
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
     * @return PedidoCompraLinea
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
     * @return PedidoCompraLinea
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
     * @return PedidoCompraLinea
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
     * @return PedidoCompraLinea
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
     * @return PedidoCompraLinea
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

    /**
     * Set pedidocompralinea
     *
     * @param PB\ComprasBundle\Entity\PedidoCompra $pedidocompralinea
     * @return PedidoCompraLinea
     */
    public function setPedidocompralinea(\PB\ComprasBundle\Entity\PedidoCompra $pedidocompralinea = null)
    {
        $this->pedidocompralinea = $pedidocompralinea;
      // $pedidocompralinea->setPedidocompralinea($this);
        return $this;
    }

    /**
     * Get pedidocompralinea
     *
     * @return PB\ComprasBundle\Entity\PedidoCompra 
     */
    public function getPedidocompralinea()
    {
        return $this->pedidocompralinea;
    }
}