<?php

namespace PB\VentasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PB\VentasBundle\Entity\PrecioLinea
 */
class PrecioLinea
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var integer $codcliente
     */
    private $codcliente;

    /**
     * @var string $cantidad
     */
    private $cantidad;

    /**
     * @var string $concepto
     */
    private $concepto;

    /**
     * @var string $medida
     */
    private $medida;

    /**
     * @var integer $galga
     */
    private $galga;

    /**
     * @var float $precio
     */
    private $precio;

    /**
     * @var PB\VentasBundle\Entity\Precio
     */
    private $precios;


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
     * Set codcliente
     *
     * @param integer $codcliente
     * @return PrecioLinea
     */
    public function setCodcliente($codcliente)
    {
        $this->codcliente = $codcliente;
    
        return $this;
    }

    /**
     * Get codcliente
     *
     * @return integer 
     */
    public function getCodcliente()
    {
        return $this->codcliente;
    }

    /**
     * Set cantidad
     *
     * @param string $cantidad
     * @return PrecioLinea
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
     * Set concepto
     *
     * @param string $concepto
     * @return PrecioLinea
     */
    public function setConcepto($concepto)
    {
        $this->concepto = $concepto;
    
        return $this;
    }

    /**
     * Get concepto
     *
     * @return string 
     */
    public function getConcepto()
    {
        return $this->concepto;
    }

    /**
     * Set medida
     *
     * @param string $medida
     * @return PrecioLinea
     */
    public function setMedida($medida)
    {
        $this->medida = $medida;
    
        return $this;
    }

    /**
     * Get medida
     *
     * @return string 
     */
    public function getMedida()
    {
        return $this->medida;
    }

    /**
     * Set galga
     *
     * @param integer $galga
     * @return PrecioLinea
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
        if($this->galga == '0') return ''; else return $this->galga;
    }

    /**
     * Set precio
     *
     * @param float $precio
     * @return PrecioLinea
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
     * Set precios
     *
     * @param PB\VentasBundle\Entity\Precio $precios
     * @return PrecioLinea
     */
    public function setPrecios(\PB\VentasBundle\Entity\Precio $precios = null)
    {
        $this->precios = $precios;
    
        return $this;
    }

    /**
     * Get precios
     *
     * @return PB\VentasBundle\Entity\Precio 
     */
    public function getPrecios()
    {
        return $this->precios;
    }
}