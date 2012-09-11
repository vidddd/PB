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
     * @var integer $codproveedor
     */
    private $codproveedor;

    /**
     * @var string $codpedido
     */
    private $codpedido;

    /**
     * @var date $fecha
     */
    private $fecha;

    /**
     * @var date $fecha_entrega
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
     * @var smallint $iva
     */
    private $iva;

    /**
     * @var float $total
     */
    private $total;

    /**
     * @var float $descuento
     */
    private $descuento;

    /**
     * @ORM\OneToMany(targetEntity="PedidoCompraLinea", mappedBy="codpedido")
     */
    protected $pedidocompralineas;
    
    public function __construct()
    {
    	$this->pedidocompralineas = new ArrayCollection();
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
     * Set codproveedor
     *
     * @param integer $codproveedor
     */
    public function setCodproveedor($codproveedor)
    {
        $this->codproveedor = $codproveedor;
    }

    /**
     * Get codproveedor
     *
     * @return integer 
     */
    public function getCodproveedor()
    {
        return $this->codproveedor;
    }

    /**
     * Set codpedido
     *
     * @param string $codpedido
     */
    public function setCodpedido($codpedido)
    {
        $this->codpedido = $codpedido;
    }

    /**
     * Get codpedido
     *
     * @return string 
     */
    public function getCodpedido()
    {
        return $this->codpedido;
    }

    /**
     * Set fecha
     *
     * @param date $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * Get fecha
     *
     * @return date 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set fecha_entrega
     *
     * @param date $fechaEntrega
     */
    public function setFechaEntrega($fechaEntrega)
    {
        $this->fecha_entrega = $fechaEntrega;
    }

    /**
     * Get fecha_entrega
     *
     * @return date 
     */
    public function getFechaEntrega()
    {
        return $this->fecha_entrega;
    }

    /**
     * Set referencia
     *
     * @param string $referencia
     */
    public function setReferencia($referencia)
    {
        $this->referencia = $referencia;
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
     */
    public function setFormaEnvio($formaEnvio)
    {
        $this->forma_envio = $formaEnvio;
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
     */
    public function setImporte($importe)
    {
        $this->importe = $importe;
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
     * Set iva
     *
     * @param smallint $iva
     */
    public function setIva($iva)
    {
        $this->iva = $iva;
    }

    /**
     * Get iva
     *
     * @return smallint 
     */
    public function getIva()
    {
        return $this->iva;
    }

    /**
     * Set total
     *
     * @param float $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
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
     */
    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;
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
     * @var PB\ComprasBundle\Entity\PedidoCompraLinea
     */
    private $pedidoscompralinea;


    /**
     * Add pedidoscompralinea
     *
     * @param PB\ComprasBundle\Entity\PedidoCompraLinea $pedidoscompralinea
     */
    public function addPedidoCompraLinea(\PB\ComprasBundle\Entity\PedidoCompraLinea $pedidoscompralinea)
    {
        $this->pedidoscompralinea[] = $pedidoscompralinea;
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
}