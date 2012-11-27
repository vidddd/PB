<?php

namespace PB\VentasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PB\VentasBundle\Entity\FacturaLinea
 */
class FacturaLinea
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var \DateTime $fecha
     */
    private $fecha;


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
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return FacturaLinea
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    
        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }
    /**
     * @var string $referencia
     */
    private $referencia;

    /**
     * @var integer $numlinea
     */
    private $numlinea;

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
     * @var integer $solapa
     */
    private $solapa;

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
     * @var float $importe
     */
    private $importe;

    /**
     * @var PB\VentasBundle\Entity\Factura
     */
    private $factura;


    /**
     * Set referencia
     *
     * @param string $referencia
     * @return FacturaLinea
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
     * Set numlinea
     *
     * @param integer $numlinea
     * @return FacturaLinea
     */
    public function setNumlinea($numlinea)
    {
        $this->numlinea = $numlinea;
    
        return $this;
    }

    /**
     * Get numlinea
     *
     * @return integer 
     */
    public function getNumlinea()
    {
        return $this->numlinea;
    }

    /**
     * Set ancho
     *
     * @param integer $ancho
     * @return FacturaLinea
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
     * @return FacturaLinea
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
     * @return FacturaLinea
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
     * Set solapa
     *
     * @param integer $solapa
     * @return FacturaLinea
     */
    public function setSolapa($solapa)
    {
        $this->solapa = $solapa;
    
        return $this;
    }

    /**
     * Get solapa
     *
     * @return integer 
     */
    public function getSolapa()
    {
        return $this->solapa;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return FacturaLinea
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
     * @return FacturaLinea
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
    public function getCantidadf()
    {
    	//return $this->cantidad;
    	return number_format($this->cantidad,3,",",".");
    }
    /**
     * Set precio
     *
     * @param float $precio
     * @return FacturaLinea
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
    public function getPreciof()
    {
    	//return $this->precio;
    	return number_format($this->precio,2,",",".");
    }

    /**
     * Set descuento
     *
     * @param float $descuento
     * @return FacturaLinea
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
     * Set importe
     *
     * @param float $importe
     * @return FacturaLinea
     */
    public function setImporte($importe)
    {
        $this->importe = $importe;
    
        return $this;
    }

    /**
     * Get importe
     *
     * @return float 
     */
    public function getImporte()
    {
        return $this->importe;
    }
    public function getImportef()
    {
    	//return $this->importe;
    	return number_format($this->importe,2,",",".");
    }
    /**
     * Set factura
     *
     * @param PB\VentasBundle\Entity\Factura $factura
     * @return FacturaLinea
     */
    public function setFactura(\PB\VentasBundle\Entity\Factura $factura = null)
    {
        $this->factura = $factura;
    
        return $this;
    }

    /**
     * Get factura
     *
     * @return PB\VentasBundle\Entity\Factura 
     */
    public function getFactura()
    {
        return $this->factura;
    }
    /**
     * @var integer $codpedido
     */
    private $codpedido;


    /**
     * Set codpedido
     *
     * @param integer $codpedido
     * @return FacturaLinea
     */
    public function setCodpedido($codpedido)
    {
        $this->codpedido = $codpedido;
    
        return $this;
    }

    /**
     * Get codpedido
     *
     * @return integer 
     */
    public function getCodpedido()
    {
        return $this->codpedido;
    }
}