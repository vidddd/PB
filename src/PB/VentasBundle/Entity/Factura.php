<?php

namespace PB\VentasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PB\VentasBundle\Entity\Factura
 */
class Factura
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
     * @var \DateTime $fecha_cobro
     */
    private $fecha_cobro;

    /**
     * @var integer $tipo
     */
    private $tipo;


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
     * @return Factura
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
     * Set fecha_cobro
     *
     * @param \DateTime $fechaCobro
     * @return Factura
     */
    public function setFechaCobro($fechaCobro)
    {
        $this->fecha_cobro = $fechaCobro;
    
        return $this;
    }

    /**
     * Get fecha_cobro
     *
     * @return \DateTime 
     */
    public function getFechaCobro()
    {
        return $this->fecha_cobro;
    }

    /**
     * Set tipo
     *
     * @param integer $tipo
     * @return Factura
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    
        return $this;
    }

    /**
     * Get tipo
     *
     * @return integer 
     */
    public function getTipo()
    {
        return $this->tipo;
    }
    /**
     * @var integer $iva
     */
    private $iva;

    /**
     * @var integer $descuento
     */
    private $descuento;

    /**
     * @var boolean $recargo
     */
    private $recargo;

    /**
     * @var integer $anyo
     */
    private $anyo;

    /**
     * @var float $importetotal
     */
    private $importetotal;

    /**
     * @var integer $estado
     */
    private $estado;

    /**
     * @var string $observaciones
     */
    private $observaciones;


    /**
     * Set iva
     *
     * @param integer $iva
     * @return Factura
     */
    public function setIva($iva)
    {
        $this->iva = $iva;
    
        return $this;
    }

    /**
     * Get iva
     *
     * @return integer 
     */
    public function getIva()
    {
        return $this->iva;
    }

    /**
     * Set descuento
     *
     * @param integer $descuento
     * @return Factura
     */
    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;
    
        return $this;
    }

    /**
     * Get descuento
     *
     * @return integer 
     */
    public function getDescuento()
    {
        return $this->descuento;
    }

    /**
     * Set recargo
     *
     * @param boolean $recargo
     * @return Factura
     */
    public function setRecargo($recargo)
    {
        $this->recargo = $recargo;
    
        return $this;
    }

    /**
     * Get recargo
     *
     * @return boolean 
     */
    public function getRecargo()
    {
        return $this->recargo;
    }

    /**
     * Set anyo
     *
     * @param integer $anyo
     * @return Factura
     */
    public function setAnyo($anyo)
    {
        $this->anyo = $anyo;
    
        return $this;
    }

    /**
     * Get anyo
     *
     * @return integer 
     */
    public function getAnyo()
    {
        return $this->anyo;
    }

    /**
     * Set importetotal
     *
     * @param float $importetotal
     * @return Factura
     */
    public function setImportetotal($importetotal)
    {
        $this->importetotal = $importetotal;
    
        return $this;
    }

    /**
     * Get importetotal
     *
     * @return float 
     */
    public function getImportetotal()
    {
        return $this->importetotal;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     * @return Factura
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    
        return $this;
    }

    /**
     * Get estado
     *
     * @return integer 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return Factura
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;
    
        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string 
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $facturalineas;

    /**
     * @var PB\VentasBundle\Entity\Cliente
     */
    private $cliente;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->facturalineas = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add facturalineas
     *
     * @param PB\VentasBundle\Entity\FacturaLinea $facturalineas
     * @return Factura
     */
    public function addFacturalinea(\PB\VentasBundle\Entity\FacturaLinea $facturalineas)
    {
        $this->facturalineas[] = $facturalineas;
    
        return $this;
    }

    /**
     * Remove facturalineas
     *
     * @param PB\VentasBundle\Entity\FacturaLinea $facturalineas
     */
    public function removeFacturalinea(\PB\VentasBundle\Entity\FacturaLinea $facturalineas)
    {
        $this->facturalineas->removeElement($facturalineas);
    }

    /**
     * Get facturalineas
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getFacturalineas()
    {
        return $this->facturalineas;
    }

    /**
     * Set cliente
     *
     * @param PB\VentasBundle\Entity\Cliente $cliente
     * @return Factura
     */
    public function setCliente(\PB\VentasBundle\Entity\Cliente $cliente = null)
    {
        $this->cliente = $cliente;
    
        return $this;
    }

    /**
     * Get cliente
     *
     * @return PB\VentasBundle\Entity\Cliente 
     */
    public function getCliente()
    {
        return $this->cliente;
    }
}