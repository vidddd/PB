<?php

namespace PB\VentasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PB\VentasBundle\Entity\Pedido
 */
class Pedido
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $codpedido
     */
    private $codpedido;

    /**
     * @var integer $codalbaran
     */
    private $codalbaran;

    /**
     * @var integer $codfactura
     */
    private $codfactura;

    /**
     * @var \DateTime $fecha
     */
    private $fecha;

    /**
     * @var \DateTime $fecha_entrega
     */
    private $fecha_entrega;

    /**
     * @var string $subcliente
     */
    private $subcliente;

    /**
     * @var integer $cantidad
     */
    private $cantidad;

    /**
     * @var string $mtycolor
     */
    private $mtycolor;

    /**
     * @var integer $tipomaterial
     */
    private $tipomaterial;

    /**
     * @var integer $ancho
     */
    private $ancho;

    /**
     * @var integer $galga
     */
    private $galga;

    /**
     * @var integer $plegado
     */
    private $plegado;

    /**
     * @var integer $bobinas
     */
    private $bobinas;

    /**
     * @var integer $metros
     */
    private $metros;

    /**
     * @var float $pesoteorico
     */
    private $pesoteorico;

    /**
     * @var string $tratado
     */
    private $tratado;

    /**
     * @var string $tipotubo
     */
    private $tipotubo;

    /**
     * @var integer $kilosimp
     */
    private $kilosimp;

    /**
     * @var string $cliche
     */
    private $cliche;

    /**
     * @var string $medidaimp
     */
    private $medidaimp;

    /**
     * @var string $soldadura
     */
    private $soldadura;

    /**
     * @var string $impresion
     */
    private $impresion;

    /**
     * @var string $colores
     */
    private $colores;

    /**
     * @var string $maquina
     */
    private $maquina;

    /**
     * @var string $cantidadc
     */
    private $cantidadc;

    /**
     * @var integer $anchoc
     */
    private $anchoc;

    /**
     * @var integer $largoc
     */
    private $largoc;

    /**
     * @var integer $solapa
     */
    private $solapa;

    /**
     * @var string $almacen
     */
    private $almacen;

    /**
     * @var string $operario
     */
    private $operario;

    /**
     * @var string $notasextrusion
     */
    private $notasextrusion;

    /**
     * @var string $notasimpresion
     */
    private $notasimpresion;

    /**
     * @var string $notascorte
     */
    private $notascorte;

    /**
     * @var float $precio
     */
    private $precio;

    /**
     * @var string $observacionmes
     */
    private $observacionmes;


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
     * Set codpedido
     *
     * @param string $codpedido
     * @return Pedido
     */
    public function setCodpedido($codpedido)
    {
        $this->codpedido = $codpedido;
    
        return $this;
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
     * Set codalbaran
     *
     * @param integer $codalbaran
     * @return Pedido
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
     * Set codfactura
     *
     * @param integer $codfactura
     * @return Pedido
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
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Pedido
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
     * @return Pedido
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
     * Set subcliente
     *
     * @param string $subcliente
     * @return Pedido
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
     * Set cantidad
     *
     * @param integer $cantidad
     * @return Pedido
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    
        return $this;
    }

    /**
     * Get cantidad
     *
     * @return integer 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set mtycolor
     *
     * @param string $mtycolor
     * @return Pedido
     */
    public function setMtycolor($mtycolor)
    {
        $this->mtycolor = $mtycolor;
    
        return $this;
    }

    /**
     * Get mtycolor
     *
     * @return string 
     */
    public function getMtycolor()
    {
        return $this->mtycolor;
    }

    /**
     * Set tipomaterial
     *
     * @param integer $tipomaterial
     * @return Pedido
     */
    public function setTipomaterial($tipomaterial)
    {
        $this->tipomaterial = $tipomaterial;
    
        return $this;
    }

    /**
     * Get tipomaterial
     *
     * @return integer 
     */
    public function getTipomaterial()
    {
        return $this->tipomaterial;
    }

    /**
     * Set ancho
     *
     * @param integer $ancho
     * @return Pedido
     */
    public function setAncho($ancho)
    {
        $this->ancho = $ancho;
    
        return $this;
    }

    /**
     * Get ancho
     *
     * @return integer 
     */
    public function getAncho()
    {
        return $this->ancho;
    }

    /**
     * Set galga
     *
     * @param integer $galga
     * @return Pedido
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
     * Set plegado
     *
     * @param integer $plegado
     * @return Pedido
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
     * Set bobinas
     *
     * @param integer $bobinas
     * @return Pedido
     */
    public function setBobinas($bobinas)
    {
        $this->bobinas = $bobinas;
    
        return $this;
    }

    /**
     * Get bobinas
     *
     * @return integer 
     */
    public function getBobinas()
    {
        return $this->bobinas;
    }

    /**
     * Set metros
     *
     * @param integer $metros
     * @return Pedido
     */
    public function setMetros($metros)
    {
        $this->metros = $metros;
    
        return $this;
    }

    /**
     * Get metros
     *
     * @return integer 
     */
    public function getMetros()
    {
        return $this->metros;
    }

    /**
     * Set pesoteorico
     *
     * @param float $pesoteorico
     * @return Pedido
     */
    public function setPesoteorico($pesoteorico)
    {
        $this->pesoteorico = $pesoteorico;
    
        return $this;
    }

    /**
     * Get pesoteorico
     *
     * @return float 
     */
    public function getPesoteorico()
    {
        return $this->pesoteorico;
    }

    /**
     * Set tratado
     *
     * @param string $tratado
     * @return Pedido
     */
    public function setTratado($tratado)
    {
        $this->tratado = $tratado;
    
        return $this;
    }

    /**
     * Get tratado
     *
     * @return string 
     */
    public function getTratado()
    {
        return $this->tratado;
    }

    /**
     * Set tipotubo
     *
     * @param string $tipotubo
     * @return Pedido
     */
    public function setTipotubo($tipotubo)
    {
        $this->tipotubo = $tipotubo;
    
        return $this;
    }

    /**
     * Get tipotubo
     *
     * @return string 
     */
    public function getTipotubo()
    {
        return $this->tipotubo;
    }

    /**
     * Set kilosimp
     *
     * @param integer $kilosimp
     * @return Pedido
     */
    public function setKilosimp($kilosimp)
    {
        $this->kilosimp = $kilosimp;
    
        return $this;
    }

    /**
     * Get kilosimp
     *
     * @return integer 
     */
    public function getKilosimp()
    {
        return $this->kilosimp;
    }

    /**
     * Set cliche
     *
     * @param string $cliche
     * @return Pedido
     */
    public function setCliche($cliche)
    {
        $this->cliche = $cliche;
    
        return $this;
    }

    /**
     * Get cliche
     *
     * @return string 
     */
    public function getCliche()
    {
        return $this->cliche;
    }

    /**
     * Set medidaimp
     *
     * @param string $medidaimp
     * @return Pedido
     */
    public function setMedidaimp($medidaimp)
    {
        $this->medidaimp = $medidaimp;
    
        return $this;
    }

    /**
     * Get medidaimp
     *
     * @return string 
     */
    public function getMedidaimp()
    {
        return $this->medidaimp;
    }

    /**
     * Set soldadura
     *
     * @param string $soldadura
     * @return Pedido
     */
    public function setSoldadura($soldadura)
    {
        $this->soldadura = $soldadura;
    
        return $this;
    }

    /**
     * Get soldadura
     *
     * @return string 
     */
    public function getSoldadura()
    {
        return $this->soldadura;
    }

    /**
     * Set impresion
     *
     * @param string $impresion
     * @return Pedido
     */
    public function setImpresion($impresion)
    {
        $this->impresion = $impresion;
    
        return $this;
    }

    /**
     * Get impresion
     *
     * @return string 
     */
    public function getImpresion()
    {
        return $this->impresion;
    }

    /**
     * Set colores
     *
     * @param string $colores
     * @return Pedido
     */
    public function setColores($colores)
    {
        $this->colores = $colores;
    
        return $this;
    }

    /**
     * Get colores
     *
     * @return string 
     */
    public function getColores()
    {
        return $this->colores;
    }

    /**
     * Set maquina
     *
     * @param string $maquina
     * @return Pedido
     */
    public function setMaquina($maquina)
    {
        $this->maquina = $maquina;
    
        return $this;
    }

    /**
     * Get maquina
     *
     * @return string 
     */
    public function getMaquina()
    {
        return $this->maquina;
    }

    /**
     * Set cantidadc
     *
     * @param string $cantidadc
     * @return Pedido
     */
    public function setCantidadc($cantidadc)
    {
        $this->cantidadc = $cantidadc;
    
        return $this;
    }

    /**
     * Get cantidadc
     *
     * @return string 
     */
    public function getCantidadc()
    {
        return $this->cantidadc;
    }

    /**
     * Set anchoc
     *
     * @param integer $anchoc
     * @return Pedido
     */
    public function setAnchoc($anchoc)
    {
        $this->anchoc = $anchoc;
    
        return $this;
    }

    /**
     * Get anchoc
     *
     * @return integer 
     */
    public function getAnchoc()
    {
        return $this->anchoc;
    }

    /**
     * Set largoc
     *
     * @param integer $largoc
     * @return Pedido
     */
    public function setLargoc($largoc)
    {
        $this->largoc = $largoc;
    
        return $this;
    }

    /**
     * Get largoc
     *
     * @return integer 
     */
    public function getLargoc()
    {
        return $this->largoc;
    }

    /**
     * Set solapa
     *
     * @param integer $solapa
     * @return Pedido
     */
    public function setSolapa($solapa)
    {
        $this->solapa = $solapa;
    
        return $this;
    }

    /**
     * Get solapa
     *
     * @return integer 
     */
    public function getSolapa()
    {
        return $this->solapa;
    }

    /**
     * Set almacen
     *
     * @param string $almacen
     * @return Pedido
     */
    public function setAlmacen($almacen)
    {
        $this->almacen = $almacen;
    
        return $this;
    }

    /**
     * Get almacen
     *
     * @return string 
     */
    public function getAlmacen()
    {
        return $this->almacen;
    }

    /**
     * Set operario
     *
     * @param string $operario
     * @return Pedido
     */
    public function setOperario($operario)
    {
        $this->operario = $operario;
    
        return $this;
    }

    /**
     * Get operario
     *
     * @return string 
     */
    public function getOperario()
    {
        return $this->operario;
    }

    /**
     * Set notasextrusion
     *
     * @param string $notasextrusion
     * @return Pedido
     */
    public function setNotasextrusion($notasextrusion)
    {
        $this->notasextrusion = $notasextrusion;
    
        return $this;
    }

    /**
     * Get notasextrusion
     *
     * @return string 
     */
    public function getNotasextrusion()
    {
        return $this->notasextrusion;
    }

    /**
     * Set notasimpresion
     *
     * @param string $notasimpresion
     * @return Pedido
     */
    public function setNotasimpresion($notasimpresion)
    {
        $this->notasimpresion = $notasimpresion;
    
        return $this;
    }

    /**
     * Get notasimpresion
     *
     * @return string 
     */
    public function getNotasimpresion()
    {
        return $this->notasimpresion;
    }

    /**
     * Set notascorte
     *
     * @param string $notascorte
     * @return Pedido
     */
    public function setNotascorte($notascorte)
    {
        $this->notascorte = $notascorte;
    
        return $this;
    }

    /**
     * Get notascorte
     *
     * @return string 
     */
    public function getNotascorte()
    {
        return $this->notascorte;
    }

    /**
     * Set precio
     *
     * @param float $precio
     * @return Pedido
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
     * Set observacionmes
     *
     * @param string $observacionmes
     * @return Pedido
     */
    public function setObservacionmes($observacionmes)
    {
        $this->observacionmes = $observacionmes;
    
        return $this;
    }

    /**
     * Get observacionmes
     *
     * @return string 
     */
    public function getObservacionmes()
    {
        return $this->observacionmes;
    }
    /**
     * @var integer $estado
     */
    private $estado;

    /**
     * @var PB\VentasBundle\Entity\Cliente
     */
    private $cliente;


    /**
     * Set estado
     *
     * @param integer $estado
     * @return Pedido
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
     * Set cliente
     *
     * @param PB\VentasBundle\Entity\Cliente $cliente
     * @return Pedido
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