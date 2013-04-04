<?php

namespace PB\ComprasBundle\Entity;
use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Exception\ParseException;

use Doctrine\ORM\Mapping as ORM;

/**
 * PB\ComprasBundle\Entity\AlbaranCompra
 */
class AlbaranCompra
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
    public function setId($id)
    {
    	$this->id = $id;
    	return $this;
    }
    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return AlbaranCompra
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
    private $albarancompralineas;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->albarancompralineas = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set referencia
     *
     * @param string $referencia
     * @return AlbaranCompra
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
     * @return AlbaranCompra
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
     * @return AlbaranCompra
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
     * @return AlbaranCompra
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
     * Set iva
     *
     * @param float $iva
     * @return AlbaranCompra
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
     * @return AlbaranCompra
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
     * @return AlbaranCompra
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
     * @return AlbaranCompra
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
     * Add albarancompralineas
     *
     * @param PB\ComprasBundle\Entity\AlbaranCompraLinea $albarancompralineas
     * @return AlbaranCompra
     */
    public function addAlbarancompralinea(\PB\ComprasBundle\Entity\AlbaranCompraLinea $albarancompralineas)
    {
        $this->albarancompralineas[] = $albarancompralineas;
    
        return $this;
    }

    /**
     * Remove albarancompralineas
     *
     * @param PB\ComprasBundle\Entity\AlbaranCompraLinea $albarancompralineas
     */
    public function removeAlbarancompralinea(\PB\ComprasBundle\Entity\AlbaranCompraLinea $albarancompralineas)
    {
        $this->albarancompralineas->removeElement($albarancompralineas);
    }

    /**
     * Get albarancompralineas
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getAlbarancompralineas()
    {
        return $this->albarancompralineas;
    }
    /**
     * @var PB\ComprasBundle\Entity\Proveedor
     */
    private $proveedor;


    /**
     * Set proveedor
     *
     * @param PB\ComprasBundle\Entity\Proveedor $proveedor
     * @return AlbaranCompra
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
    public function __toString()
    {
    	$id = $this->id;
    	return (string)$id;
    }
    /**
     * @var \DateTime $fecha_recepcion
     */
    private $fecha_recepcion;


    /**
     * Set fecha_recepcion
     *
     * @param \DateTime $fechaRecepcion
     * @return AlbaranCompra
     */
    public function setFechaRecepcion($fechaRecepcion)
    {
        $this->fecha_recepcion = $fechaRecepcion;
    
        return $this;
    }

    /**
     * Get fecha_recepcion
     *
     * @return \DateTime 
     */
    public function getFechaRecepcion()
    {
        return $this->fecha_recepcion;
    }
    public function getEstadoText()
    {
    	$yaml = new Parser(); try {	$value = $yaml->parse(file_get_contents(__DIR__ . '/../Resources/config/compras.yml'));
    	} catch (ParseException $e) {
    		printf("Unable to parse the YAML string: %s", $e->getMessage());
    	}
    	return $value['estados'][$this->estado];
    }
    /**
     * @var PB\ComprasBundle\Entity\PedidoCompra
     */
    private $albarancompra_pedido;


    /**
     * Set albarancompra_pedido
     *
     * @param PB\ComprasBundle\Entity\PedidoCompra $albarancompraPedido
     * @return AlbaranCompra
     */
    public function setAlbarancompraPedido(\PB\ComprasBundle\Entity\PedidoCompra $albarancompraPedido = null)
    {
        $this->albarancompra_pedido = $albarancompraPedido;
    
        return $this;
    }

    /**
     * Get albarancompra_pedido
     *
     * @return PB\ComprasBundle\Entity\PedidoCompra 
     */
    public function getAlbarancompraPedido()
    {
        return $this->albarancompra_pedido;
    }
    
    public function getEstadoProcesado() {
        return $this->getEstadoProcesadoNum();
    }
    public function getEstadoProcesadoNum() {
    	$nuevo = false;
    	$parcial = false;
    	$total = false;
    	$count = $this->albarancompralineas;
    	$parciales = 0; $totales = 0;
    	foreach($this->albarancompralineas as $linea) {
    		$estado = $linea->getEstado();
    		if ($estado == 1) {
    			$nuevo = true;
    		} else if ($estado == 2) {
    			$parciales++; $parcial = true;
    		} else if ($estado == 3) {
    			$totales++; $total = true;
    		}
    	}
    	if ($nuevo && $parciales == 0 && $totales == 0) {
    		return 1;
    	}
    	if ($parcial) {
    		return 2;
    	}
    	/*
    	if((int)$totales < (int)$count){
    		return 2;
    	}*/
    	if (!$nuevo || !$parcial) {
    		return 3;
    	}
    }
    public function getEstadoProcesadoText()
    {
    	$yaml = new Parser(); try {	$value = $yaml->parse(file_get_contents(__DIR__ . '/../Resources/config/compras.yml'));
    	} catch (ParseException $e) {
    		printf("Unable to parse the YAML string: %s", $e->getMessage());
    	}
    	$estado = $this->getEstadoProcesadoNum();
    	return $value['estados_albarancompralinea'][$estado];
    }
}