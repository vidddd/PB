<?php

namespace PB\VentasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PB\VentasBundle\Entity\PresupuestoLinea
 */
class PresupuestoLinea
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
     * @var string $medidda
     */
    private $medidda;

    /**
     * @var integer $galga
     */
    private $galga;

    /**
     * @var float $cantidad
     */
    private $cantidad;

    /**
     * @var float $precio
     */
    private $precio;

    /**
     * @var float $importe
     */
    private $importe;


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
     * @return PresupuestoLinea
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
     * @return PresupuestoLinea
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
     * Set medidda
     *
     * @param string $medidda
     * @return PresupuestoLinea
     */
    public function setMedidda($medidda)
    {
        $this->medidda = $medidda;
    
        return $this;
    }

    /**
     * Get medidda
     *
     * @return string 
     */
    public function getMedidda()
    {
        return $this->medidda;
    }

    /**
     * Set galga
     *
     * @param integer $galga
     * @return PresupuestoLinea
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
     * Set cantidad
     *
     * @param float $cantidad
     * @return PresupuestoLinea
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
     * @return PresupuestoLinea
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
     * Set importe
     *
     * @param float $importe
     * @return PresupuestoLinea
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
     * @var string $medida
     */
    private $medida;

    /**
     * @var PB\VentasBundle\Entity\Presupuesto
     */
    private $presupuesto;


    /**
     * Set medida
     *
     * @param string $medida
     * @return PresupuestoLinea
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
     * Set presupuesto
     *
     * @param PB\VentasBundle\Entity\Presupuesto $presupuesto
     * @return PresupuestoLinea
     */
    public function setPresupuesto(\PB\VentasBundle\Entity\Presupuesto $presupuesto = null)
    {
        $this->presupuesto = $presupuesto;
    
        return $this;
    }

    /**
     * Get presupuesto
     *
     * @return PB\VentasBundle\Entity\Presupuesto 
     */
    public function getPresupuesto()
    {
        return $this->presupuesto;
    }
}