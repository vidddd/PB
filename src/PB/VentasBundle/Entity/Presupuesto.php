<?php

namespace PB\VentasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PB\VentasBundle\Entity\Presupuesto
 */
class Presupuesto
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
     * @var integer $coutaiva
     */
    private $coutaiva;

    /**
     * @var integer $iva
     */
    private $iva;

    /**
     * @var string $nombre
     */
    private $nombre;

    /**
     * @var integer $descuento
     */
    private $descuento;

    /**
     * @var float $importetotal
     */
    private $importetotal;

    /**
     * @var string $observaciones
     */
    private $observaciones;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $presupuestolineas;

    /**
     * @var PB\VentasBundle\Entity\Cliente
     */
    private $cliente;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->presupuestolineas = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
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
     * @return Presupuesto
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
     * Set coutaiva
     *
     * @param integer $coutaiva
     * @return Presupuesto
     */
    public function setCoutaiva($coutaiva)
    {
        $this->coutaiva = $coutaiva;
    
        return $this;
    }

    /**
     * Get coutaiva
     *
     * @return integer 
     */
    public function getCoutaiva()
    {
        return $this->coutaiva;
    }

    /**
     * Set iva
     *
     * @param integer $iva
     * @return Presupuesto
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
     * Set nombre
     *
     * @param string $nombre
     * @return Presupuesto
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set descuento
     *
     * @param integer $descuento
     * @return Presupuesto
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
     * Set importetotal
     *
     * @param float $importetotal
     * @return Presupuesto
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
    public function getImportetotalf()
    {
    	return number_format($this->getImportetotal(),2,",",".");
    }
    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return Presupuesto
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
     * Add presupuestolineas
     *
     * @param PB\VentasBundle\Entity\PresupuestoLinea $presupuestolineas
     * @return Presupuesto
     */
    public function addPresupuestolinea(\PB\VentasBundle\Entity\PresupuestoLinea $presupuestolineas)
    {
        $this->presupuestolineas[] = $presupuestolineas;
    
        return $this;
    }

    /**
     * Remove presupuestolineas
     *
     * @param PB\VentasBundle\Entity\PresupuestoLinea $presupuestolineas
     */
    public function removePresupuestolinea(\PB\VentasBundle\Entity\PresupuestoLinea $presupuestolineas)
    {
        $this->presupuestolineas->removeElement($presupuestolineas);
    }

    /**
     * Get presupuestolineas
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPresupuestolineas()
    {
        return $this->presupuestolineas;
    }

    /**
     * Set cliente
     *
     * @param PB\VentasBundle\Entity\Cliente $cliente
     * @return Presupuesto
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
    
    public function getNeto(){
    	$neto = 0;
    	foreach ($this->presupuestolineas as $key){
    		$neto = $neto + $key->getImporte();
    	}
    	return $neto;
    }
    public function getNetof(){
    	return number_format($this->getNeto(),2,",",".");
    }
    
    public function getDescuentototal(){
    	$dto = $this->getNeto() * $this->descuento / 100;
    	return $dto;
    }
    public function getDescuentototalf(){
    	return number_format($this->getDescuentototal(),2,",",".");
    }
    public function getBaseimponible(){
    	return $this->getNeto() - $this->getDescuentototal();
    }
    public function getBaseimponiblef(){
    	return number_format($this->getBaseimponible(),2,",",".");
    }
    public function getIvatotal(){
    	$iva = $this->getBaseimponible() * $this->iva / 100;
    	return $iva;
    	
    }
    public function getIvatotalf(){
    	return number_format($this->getIvatotal(),2,",",".");
    }

}