<?php

namespace PB\VentasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PB\VentasBundle\Entity\PedidoCliente
 */
class PedidoCliente
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
     * @var string $subcliente
     */
    private $subcliente;

    /**
     * @var integer $estado
     */
    private $estado;


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
     * @return PedidoCliente
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
     * Set subcliente
     *
     * @param string $subcliente
     * @return PedidoCliente
     */
    public function setSubcliente($subcliente)
    {
        $this->subcliente = $subcliente;
    
        return $this;
    }

    /**
     * Get subcliente
     *
     * @return string 
     */
    public function getSubcliente()
    {
        return $this->subcliente;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     * @return PedidoCliente
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
     * @var string $cantidad
     */
    private $cantidad;

    /**
     * @var float $ancho
     */
    private $ancho;

    /**
     * @var float $largo
     */
    private $largo;

    /**
     * @var float $galga
     */
    private $galga;

    /**
     * @var integer $plegado
     */
    private $plegado;

    /**
     * @var float $precio
     */
    private $precio;

    /**
     * @var float $preciocliche
     */
    private $preciocliche;

    /**
     * @var integer $material
     */
    private $material;

    /**
     * @var string $color
     */
    private $color;

    /**
     * @var integer $tipotubo
     */
    private $tipotubo;

    /**
     * @var integer $tipobolsa
     */
    private $tipobolsa;

    /**
     * @var integer $bobinasnumero
     */
    private $bobinasnumero;

    /**
     * @var integer $bobinasmetros
     */
    private $bobinasmetros;

    /**
     * @var integer $bobinaskg
     */
    private $bobinaskg;

    /**
     * @var string $impresion1
     */
    private $impresion1;

    /**
     * @var string $impresion2
     */
    private $impresion2;

    /**
     * @var string $color1
     */
    private $color1;

    /**
     * @var string $color2
     */
    private $color2;

    /**
     * @var integer $cliche
     */
    private $cliche;

    /**
     * @var string $observaciones
     */
    private $observaciones;


    /**
     * Set cantidad
     *
     * @param string $cantidad
     * @return PedidoCliente
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
     * Set ancho
     *
     * @param float $ancho
     * @return PedidoCliente
     */
    public function setAncho($ancho)
    {
        $this->ancho = $ancho;
    
        return $this;
    }

    /**
     * Get ancho
     *
     * @return float 
     */
    public function getAncho()
    {
        return $this->ancho;
    }

    /**
     * Set largo
     *
     * @param float $largo
     * @return PedidoCliente
     */
    public function setLargo($largo)
    {
        $this->largo = $largo;
    
        return $this;
    }

    /**
     * Get largo
     *
     * @return float 
     */
    public function getLargo()
    {
        return $this->largo;
    }

    /**
     * Set galga
     *
     * @param float $galga
     * @return PedidoCliente
     */
    public function setGalga($galga)
    {
        $this->galga = $galga;
    
        return $this;
    }

    /**
     * Get galga
     *
     * @return float 
     */
    public function getGalga()
    {
        return $this->galga;
    }

    /**
     * Set plegado
     *
     * @param integer $plegado
     * @return PedidoCliente
     */
    public function setPlegado($plegado)
    {
        $this->plegado = $plegado;
    
        return $this;
    }

    /**
     * Get plegado
     *
     * @return integer 
     */
    public function getPlegado()
    {
        return $this->plegado;
    }

    /**
     * Set precio
     *
     * @param float $precio
     * @return PedidoCliente
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
     * Set preciocliche
     *
     * @param float $preciocliche
     * @return PedidoCliente
     */
    public function setPreciocliche($preciocliche)
    {
        $this->preciocliche = $preciocliche;
    
        return $this;
    }

    /**
     * Get preciocliche
     *
     * @return float 
     */
    public function getPreciocliche()
    {
        return $this->preciocliche;
    }

    /**
     * Set material
     *
     * @param integer $material
     * @return PedidoCliente
     */
    public function setMaterial($material)
    {
        $this->material = $material;
    
        return $this;
    }

    /**
     * Get material
     *
     * @return integer 
     */
    public function getMaterial()
    {
        return $this->material;
    }

    /**
     * Set color
     *
     * @param string $color
     * @return PedidoCliente
     */
    public function setColor($color)
    {
        $this->color = $color;
    
        return $this;
    }

    /**
     * Get color
     *
     * @return string 
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set tipotubo
     *
     * @param integer $tipotubo
     * @return PedidoCliente
     */
    public function setTipotubo($tipotubo)
    {
        $this->tipotubo = $tipotubo;
    
        return $this;
    }

    /**
     * Get tipotubo
     *
     * @return integer 
     */
    public function getTipotubo()
    {
        return $this->tipotubo;
    }

    /**
     * Set tipobolsa
     *
     * @param integer $tipobolsa
     * @return PedidoCliente
     */
    public function setTipobolsa($tipobolsa)
    {
        $this->tipobolsa = $tipobolsa;
    
        return $this;
    }

    /**
     * Get tipobolsa
     *
     * @return integer 
     */
    public function getTipobolsa()
    {
        return $this->tipobolsa;
    }

    /**
     * Set bobinasnumero
     *
     * @param integer $bobinasnumero
     * @return PedidoCliente
     */
    public function setBobinasnumero($bobinasnumero)
    {
        $this->bobinasnumero = $bobinasnumero;
    
        return $this;
    }

    /**
     * Get bobinasnumero
     *
     * @return integer 
     */
    public function getBobinasnumero()
    {
        return $this->bobinasnumero;
    }

    /**
     * Set bobinasmetros
     *
     * @param integer $bobinasmetros
     * @return PedidoCliente
     */
    public function setBobinasmetros($bobinasmetros)
    {
        $this->bobinasmetros = $bobinasmetros;
    
        return $this;
    }

    /**
     * Get bobinasmetros
     *
     * @return integer 
     */
    public function getBobinasmetros()
    {
        return $this->bobinasmetros;
    }

    /**
     * Set bobinaskg
     *
     * @param integer $bobinaskg
     * @return PedidoCliente
     */
    public function setBobinaskg($bobinaskg)
    {
        $this->bobinaskg = $bobinaskg;
    
        return $this;
    }

    /**
     * Get bobinaskg
     *
     * @return integer 
     */
    public function getBobinaskg()
    {
        return $this->bobinaskg;
    }

    /**
     * Set impresion1
     *
     * @param string $impresion1
     * @return PedidoCliente
     */
    public function setImpresion1($impresion1)
    {
        $this->impresion1 = $impresion1;
    
        return $this;
    }

    /**
     * Get impresion1
     *
     * @return string 
     */
    public function getImpresion1()
    {
        return $this->impresion1;
    }

    /**
     * Set impresion2
     *
     * @param string $impresion2
     * @return PedidoCliente
     */
    public function setImpresion2($impresion2)
    {
        $this->impresion2 = $impresion2;
    
        return $this;
    }

    /**
     * Get impresion2
     *
     * @return string 
     */
    public function getImpresion2()
    {
        return $this->impresion2;
    }

    /**
     * Set color1
     *
     * @param string $color1
     * @return PedidoCliente
     */
    public function setColor1($color1)
    {
        $this->color1 = $color1;
    
        return $this;
    }

    /**
     * Get color1
     *
     * @return string 
     */
    public function getColor1()
    {
        return $this->color1;
    }

    /**
     * Set color2
     *
     * @param string $color2
     * @return PedidoCliente
     */
    public function setColor2($color2)
    {
        $this->color2 = $color2;
    
        return $this;
    }

    /**
     * Get color2
     *
     * @return string 
     */
    public function getColor2()
    {
        return $this->color2;
    }

    /**
     * Set cliche
     *
     * @param integer $cliche
     * @return PedidoCliente
     */
    public function setCliche($cliche)
    {
        $this->cliche = $cliche;
    
        return $this;
    }

    /**
     * Get cliche
     *
     * @return integer 
     */
    public function getCliche()
    {
        return $this->cliche;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return PedidoCliente
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
     * @var PB\VentasBundle\Entity\Cliente
     */
    private $cliente;


    /**
     * Set cliente
     *
     * @param PB\VentasBundle\Entity\Cliente $cliente
     * @return PedidoCliente
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