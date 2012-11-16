<?php

namespace PB\VentasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PB\VentasBundle\Entity\FacturaBLinea
 */
class FacturaBLinea
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
     * @var string $referencia
     */
    private $referencia;

    /**
     * @var integer $numlinea
     */
    private $numlinea;

    /**
     * @var integer $codpedido
     */
    private $codpedido;

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
     * @var PB\VentasBundle\Entity\FacturaB
     */
    private $facturaB;


    /**
     * Set referencia
     *
     * @param string $referencia
     * @return FacturaBLinea
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
     * @return FacturaBLinea
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
     * Set codpedido
     *
     * @param integer $codpedido
     * @return FacturaBLinea
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

    /**
     * Set ancho
     *
     * @param integer $ancho
     * @return FacturaBLinea
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
     * @return FacturaBLinea
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
     * @return FacturaBLinea
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
     * @return FacturaBLinea
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
     * @return FacturaBLinea
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
     * @return FacturaBLinea
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
     * @return FacturaBLinea
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
     * @return FacturaBLinea
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
     * @return FacturaBLinea
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
     * Set facturaB
     *
     * @param PB\VentasBundle\Entity\FacturaB $facturaB
     * @return FacturaBLinea
     */
    public function setFacturaB(\PB\VentasBundle\Entity\FacturaB $facturaB = null)
    {
        $this->facturaB = $facturaB;
    
        return $this;
    }

    /**
     * Get facturaB
     *
     * @return PB\VentasBundle\Entity\FacturaB 
     */
    public function getFacturaB()
    {
        return $this->facturaB;
    }
}