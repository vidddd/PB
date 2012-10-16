<?php

namespace PB\ComprasBundle\Entity;

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
     * @var float $descuento
     */
    private $descuento;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $pedidoscompralinea;

    /**
     * @var PB\ComprasBundle\Entity\Proveedor
     */
    private $proveedor;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pedidoscompralinea = new \Doctrine\Common\Collections\ArrayCollection();
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
        return $this->total;
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
     * Add pedidoscompralinea
     *
     * @param PB\ComprasBundle\Entity\PedidoCompraLinea $pedidoscompralinea
     * @return PedidoCompra
     */
    public function addPedidoscompralinea(\PB\ComprasBundle\Entity\PedidoCompraLinea $pedidoscompralinea)
    {
        $this->pedidoscompralinea[] = $pedidoscompralinea;
    
        return $this;
    }

    /**
     * Remove pedidoscompralinea
     *
     * @param PB\ComprasBundle\Entity\PedidoCompraLinea $pedidoscompralinea
     */
    public function removePedidoscompralinea(\PB\ComprasBundle\Entity\PedidoCompraLinea $pedidoscompralinea)
    {
        $this->pedidoscompralinea->removeElement($pedidoscompralinea);
    }

    /**
     * Get pedidoscompralinea
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPedidoscompralinea()
    {
        return $this->pedidoscompralinea;
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
    /**
     * @var integer $iva
     */
    private $iva;


    /**
     * Set iva
     *
     * @param integer $iva
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
     * @return integer 
     */
    public function getIva()
    {
        return $this->iva;
    }
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $pedidocompralineas;


    /**
     * Add pedidocompralineas
     *
     * @param PB\ComprasBundle\Entity\PedidoCompraLinea $pedidocompralineas
     * @return PedidoCompra
     */
    public function addPedidocompralinea(\PB\ComprasBundle\Entity\PedidoCompraLinea $pedidocompralineas)
    {
        $this->pedidocompralineas[] = $pedidocompralineas;
        $pedidocompralineas->setPedidocompralinea($this);
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
    
    function setPedidocompralineas(ArrayCollection $lineas){

    	foreach ($lineas as $linea) {
    		$linea->addPedidoCompra($this);
    	}
    	
    	$this->pedidocompralineas = $lineas;
    	
    }
}