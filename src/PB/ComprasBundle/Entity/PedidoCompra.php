<?php

namespace PB\ComprasBundle\Entity;
use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Exception\ParseException;

use Doctrine\ORM\Mapping as ORM;

/**
 * PB\ComprasBundle\Entity\PedidoCompra
 */
class PedidoCompra
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
     * @var string $referencia
     */
    private $referencia;

    /**
     * @var integer $forma_envio
     */
    private $forma_envio;

    /**
     * @var float $importe
     */
    private $importe;

    /**
     * @var float $total
     */
    private $total;

    /**
     * @var float $iva
     */
    private $iva;

    /**
     * @var float $descuento
     */
    private $descuento;

    /**
     * @var string $observaciones
     */
    private $observaciones;

    /**
     * @var integer $estado
     */
    private $estado;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $pedidocompralineas;

    /**
     * @var PB\ComprasBundle\Entity\Proveedor
     */
    private $proveedor;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pedidocompralineas = new \Doctrine\Common\Collections\ArrayCollection();
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
    public function setId($id)
    {
    	$this->id = $id;
    	return $this;
    }
    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return PedidoCompra
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
     * @return PedidoCompra
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
     * Set referencia
     *
     * @param string $referencia
     * @return PedidoCompra
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
     * Set forma_envio
     *
     * @param integer $formaEnvio
     * @return PedidoCompra
     */
    public function setFormaEnvio($formaEnvio)
    {
        $this->forma_envio = $formaEnvio;
    
        return $this;
    }

    /**
     * Get forma_envio
     *
     * @return integer 
     */
    public function getFormaEnvio()
    {
        return $this->forma_envio;
    }
    public function getFormaEnvioText(){
    	$yaml = new Parser(); try {	$value = $yaml->parse(file_get_contents(__DIR__ . '/../Resources/config/compras.yml'));
    	} catch (ParseException $e) {
    		printf("Unable to parse the YAML string: %s", $e->getMessage());
    	}
    	if($this->forma_envio != null) return $value['medio_envio'][$this->forma_envio];
    		else return $this->forma_envio;
    }
    
    /**
     * Set importe
     *
     * @param float $importe
     * @return PedidoCompra
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

    /**
     * Set total
     *
     * @param float $total
     * @return PedidoCompra
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
        if($this->total == '0') return ''; else return $this->total;
    }

    /**
     * Set iva
     *
     * @param float $iva
     * @return PedidoCompra
     */
    public function setIva($iva)
    {
        $this->iva = $iva;
    
        return $this;
    }

    /**
     * Get iva
     *
     * @return float 
     */
    public function getIva()
    {
        return $this->iva;
    }

    /**
     * Set descuento
     *
     * @param float $descuento
     * @return PedidoCompra
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
     * Set observaciones
     *
     * @param string $observaciones
     * @return PedidoCompra
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
     * Set estado
     *
     * @param integer $estado
     * @return PedidoCompra
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
     * Add pedidocompralineas
     *
     * @param PB\ComprasBundle\Entity\PedidoCompraLinea $pedidocompralineas
     * @return PedidoCompra
     */
    public function addPedidocompralinea(\PB\ComprasBundle\Entity\PedidoCompraLinea $pedidocompralineas)
    {
        $this->pedidocompralineas[] = $pedidocompralineas;
    
        return $this;
    }

    /**
     * Remove pedidocompralineas
     *
     * @param PB\ComprasBundle\Entity\PedidoCompraLinea $pedidocompralineas
     */
    public function removePedidocompralinea(\PB\ComprasBundle\Entity\PedidoCompraLinea $pedidocompralineas)
    {
        $this->pedidocompralineas->removeElement($pedidocompralineas);
    }

    /**
     * Get pedidocompralineas
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPedidocompralineas()
    {
        return $this->pedidocompralineas;
    }

    /**
     * Set proveedor
     *
     * @param PB\ComprasBundle\Entity\Proveedor $proveedor
     * @return PedidoCompra
     */
    public function setProveedor(\PB\ComprasBundle\Entity\Proveedor $proveedor = null)
    {
        $this->proveedor = $proveedor;
    
        return $this;
    }

    /**
     * Get proveedor
     *
     * @return PB\ComprasBundle\Entity\Proveedor 
     */
    public function getProveedor()
    {
        return $this->proveedor;
    }
    public function getEstadoText()
    {
        $yaml = new Parser(); try {	$value = $yaml->parse(file_get_contents(__DIR__ . '/../Resources/config/compras.yml'));
	    } catch (ParseException $e) { 	printf("Unable to parse the YAML string: %s", $e->getMessage());}
    	return $value['estados'][$this->estado];
    }
}