<?php

namespace PB\VentasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Exception\ParseException;

/**
 * PB\VentasBundle\Entity\Albaran
 */
class Albaran
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
     * @var \DateTime $fecha_entrega
     */
    private $fecha_entrega;

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
     * @return Albaran
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
     * Set fecha_entrega
     *
     * @param \DateTime $fechaEntrega
     * @return Albaran
     */
    public function setFechaEntrega($fechaEntrega)
    {
        $this->fecha_entrega = $fechaEntrega;
    
        return $this;
    }

    /**
     * Get fecha_entrega
     *
     * @return \DateTime 
     */
    public function getFechaEntrega()
    {
        return $this->fecha_entrega;
    }

    /**
     * Set tipo
     *
     * @param integer $tipo
     * @return Albaran
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
    public function getTipoText(){
    	$yaml = new Parser(); try {	$value = $yaml->parse(file_get_contents(__DIR__ . '/../Resources/config/ventas.yml'));
    	} catch (ParseException $e) {
    		printf("Unable to parse the YAML string: %s", $e->getMessage());
    	}
    	if($this->tipo != null) return $value['tipos'][$this->tipo];
    }
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $lineas;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->lineas = new \Doctrine\Common\Collections\ArrayCollection();
        $this->albaranlineas = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add lineas
     *
     * @param PB\VentasBundle\Entity\AlbaranLinea $lineas
     * @return Albaran
     */
    public function addLinea(\PB\VentasBundle\Entity\AlbaranLinea $lineas)
    {
        $this->lineas[] = $lineas;
    
        return $this;
    }

    /**
     * Remove lineas
     *
     * @param PB\VentasBundle\Entity\AlbaranLinea $lineas
     */
    public function removeLinea(\PB\VentasBundle\Entity\AlbaranLinea $lineas)
    {
        $this->lineas->removeElement($lineas);
    }

    /**
     * Get lineas
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getLineas()
    {
        return $this->lineas;
    }
    /**
     * @var integer $codalbaran
     */
    private $codalbaran;

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
     * @var string $obervaciones
     */
    private $obervaciones;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $albaranlineas;

    /**
     * @var PB\VentasBundle\Entity\Cliente
     */
    private $cliente;


    /**
     * Set codalbaran
     *
     * @param integer $codalbaran
     * @return Albaran
     */
    public function setCodalbaran($codalbaran)
    {
        $this->codalbaran = $codalbaran;
    
        return $this;
    }

    /**
     * Get codalbaran
     *
     * @return integer 
     */
    public function getCodalbaran()
    {
        return $this->codalbaran;
    }

    /**
     * Set iva
     *
     * @param integer $iva
     * @return Albaran
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
     * @return Albaran
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
     * @return Albaran
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
     * @return Albaran
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
     * @return Albaran
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
     * Set obervaciones
     *
     * @param string $obervaciones
     * @return Albaran
     */
    public function setObervaciones($obervaciones)
    {
        $this->obervaciones = $obervaciones;
    
        return $this;
    }

    /**
     * Get obervaciones
     *
     * @return string 
     */
    public function getObervaciones()
    {
        return $this->obervaciones;
    }
    
    /**
     * Add albaranlineas
     *
     * @param PB\VentasBundle\Entity\AlbaranLinea $albaranlineas
     * @return Albaran
     */
    public function addAlbaranlinea(\PB\VentasBundle\Entity\AlbaranLinea $albaranlineas)
    {
        $this->albaranlineas[] = $albaranlineas;
    
        return $this;
    }

    /**
     * Remove albaranlineas
     *
     * @param PB\VentasBundle\Entity\AlbaranLinea $albaranlineas
     */
    public function removeAlbaranlinea(\PB\VentasBundle\Entity\AlbaranLinea $albaranlineas)
    {
        $this->albaranlineas->removeElement($albaranlineas);
    }

    /**
     * Get albaranlineas
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getAlbaranlineas()
    {
        return $this->albaranlineas;
    }

    /**
     * Set cliente
     *
     * @param PB\VentasBundle\Entity\Cliente $cliente
     * @return Albaran
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
    /**
     * @var integer $codfactura
     */
    private $codfactura;


    /**
     * Set codfactura
     *
     * @param integer $codfactura
     * @return Albaran
     */
    public function setCodfactura($codfactura)
    {
        $this->codfactura = $codfactura;
    
        return $this;
    }

    /**
     * Get codfactura
     *
     * @return integer 
     */
    public function getCodfactura()
    {
        return $this->codfactura;
    }
    /**
     * @var string $observaciones
     */
    private $observaciones;


    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return Albaran
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
    public function setAnyoPre()
    {
    	$this->anyo = date('Y');
    }
    public function getNeto(){
    	$neto = 0;
    	foreach ($this->albaranlineas as $key){
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
    	if($this->tipo == '1'){
	    	$iva = $this->getBaseimponible() * $this->iva / 100;
	    	return $iva;
    	} else {
    		return 0;
    	}
    }
    public function getIvatotalf(){
    	return number_format($this->getIvatotal(),2,",",".");
    }
    public function getRecargototal(){
    	if($this->recargo == '1' && $this->tipo == '1')
    	return $this->getBaseimponible() * 5.2 / 100;
    	else return 0;
    }
    public function getRecargototalf(){
    	return number_format($this->getRecargototal(),2,",",".");
    }
    
}