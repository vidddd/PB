<?php

namespace PB\ProduccionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Exception\ParseException;

/**
 * PB\ProduccionBundle\Entity\Orden
 */
class Orden
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $subcliente
     */
    private $subcliente;

    /**
     * @var \DateTime $fecha
     */
    private $fecha;

    /**
     * @var integer $estado
     */
    private $estado;

    /**
     * @var string $cantidad
     */
    private $cantidad;

    /**
     * @var integer $cantidaduni
     */
    private $cantidaduni;

    /**
     * @var string $espesor
     */
    private $espesor;

    /**
     * @var integer $espesoruni
     */
    private $espesoruni;

    /**
     * @var integer $tipomaterial
     */
    private $tipomaterial;

    /**
     * @var integer $producto
     */
    private $producto;

    /**
     * @var boolean $extrusion
     */
    private $extrusion;

    /**
     * @var string $color
     */
    private $color;

    /**
     * @var float $ancho
     */
    private $ancho;

    /**
     * @var float $galga
     */
    private $galga;

    /**
     * @var float $plegado
     */
    private $plegado;

    /**
     * @var float $bobinas
     */
    private $bobinas;

    /**
     * @var float $pesoteorico
     */
    private $pesoteorico;

    /**
     * @var integer $tratado
     */
    private $tratado;

    /**
     * @var integer $tipotubo
     */
    private $tipotubo;

    /**
     * @var string $notasextrusion
     */
    private $notasextrusion;

    /**
     * @var \DateTime $fecha_extrusion
     */
    private $fecha_extrusion;

    /**
     * @var string $operario_extrusion
     */
    private $operario_extrusion;

    /**
     * @var float $kgfinal
     */
    private $kgfinal;

    /**
     * @var \DateTime $tiempo_extrusion
     */
    private $tiempo_extrusion;

    /**
     * @var float $kilosimp
     */
    private $kilosimp;

    /**
     * @var boolean $impresion
     */
    private $impresion;

    /**
     * @var string $medidaimp
     */
    private $medidaimp;

    /**
     * @var string $anverso
     */
    private $anverso;

    /**
     * @var string $reverso
     */
    private $reverso;

    /**
     * @var string $coloresa
     */
    private $coloresa;

    /**
     * @var string $coloresr
     */
    private $coloresr;

    /**
     * @var integer $cliche
     */
    private $cliche;

    /**
     * @var string $carpeta
     */
    private $carpeta;

    /**
     * @var integer $soldadura
     */
    private $soldadura;

    /**
     * @var string $notasimpresion
     */
    private $notasimpresion;

    /**
     * @var \DateTime $fecha_impresion
     */
    private $fecha_impresion;

    /**
     * @var string $operario_impresion
     */
    private $operario_impresion;

    /**
     * @var string $tiempo_impresion
     */
    private $tiempo_impresion;

    /**
     * @var boolean $corte
     */
    private $corte;

    /**
     * @var string $cantidadc
     */
    private $cantidadc;

    /**
     * @var string $anchoc
     */
    private $anchoc;

    /**
     * @var string $largoc
     */
    private $largoc;

    /**
     * @var integer $solapa
     */
    private $solapa;

    /**
     * @var string $paquete
     */
    private $paquete;

    /**
     * @var string $saco
     */
    private $saco;

    /**
     * @var string $palets
     */
    private $palets;

    /**
     * @var string $notascorte
     */
    private $notascorte;
    
    /**
     * @var \DateTime $fecha_corte
     */
    private $fecha_corte;

    /**
     * @var string $tiempo_corte
     */
    private $tiempo_corte;

    /**
     * @var string $operario_corte
     */
    private $operario_corte;

    /**
     * @var PB\VentasBundle\Entity\Cliente
     */
    private $cliente;


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
     * Set subcliente
     *
     * @param string $subcliente
     * @return Orden
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
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Orden
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
     * Set estado
     *
     * @param integer $estado
     * @return Orden
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
     * Set cantidad
     *
     * @param string $cantidad
     * @return Orden
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
     * Set cantidaduni
     *
     * @param integer $cantidaduni
     * @return Orden
     */
    public function setCantidaduni($cantidaduni)
    {
        $this->cantidaduni = $cantidaduni;
    
        return $this;
    }

    /**
     * Get cantidaduni
     *
     * @return integer 
     */
    public function getCantidaduni()
    {
        return $this->cantidaduni;
    }

    /**
     * Set espesor
     *
     * @param string $espesor
     * @return Orden
     */
    public function setEspesor($espesor)
    {
        $this->espesor = $espesor;
    
        return $this;
    }

    /**
     * Get espesor
     *
     * @return string 
     */
    public function getEspesor()
    {
        return $this->espesor;
    }

    /**
     * Set espesoruni
     *
     * @param integer $espesoruni
     * @return Orden
     */
    public function setEspesoruni($espesoruni)
    {
        $this->espesoruni = $espesoruni;
    
        return $this;
    }

    /**
     * Get espesoruni
     *
     * @return integer 
     */
    public function getEspesoruni()
    {
        return $this->espesoruni;
    }

    /**
     * Set tipomaterial
     *
     * @param integer $tipomaterial
     * @return Orden
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
     * Set producto
     *
     * @param integer $producto
     * @return Orden
     */
    public function setProducto($producto)
    {
        $this->producto = $producto;
    
        return $this;
    }

    /**
     * Get producto
     *
     * @return integer 
     */
    public function getProducto()
    {
        return $this->producto;
    }

    /**
     * Set extrusion
     *
     * @param boolean $extrusion
     * @return Orden
     */
    public function setExtrusion($extrusion)
    {
        $this->extrusion = $extrusion;
    
        return $this;
    }

    /**
     * Get extrusion
     *
     * @return boolean 
     */
    public function getExtrusion()
    {
        return $this->extrusion;
    }

    /**
     * Set color
     *
     * @param string $color
     * @return Orden
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
     * Set ancho
     *
     * @param float $ancho
     * @return Orden
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
     * Set galga
     *
     * @param float $galga
     * @return Orden
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
     * @param float $plegado
     * @return Orden
     */
    public function setPlegado($plegado)
    {
        $this->plegado = $plegado;
    
        return $this;
    }

    /**
     * Get plegado
     *
     * @return float 
     */
    public function getPlegado()
    {
        return $this->plegado;
    }

    /**
     * Set bobinas
     *
     * @param float $bobinas
     * @return Orden
     */
    public function setBobinas($bobinas)
    {
        $this->bobinas = $bobinas;
    
        return $this;
    }

    /**
     * Get bobinas
     *
     * @return float 
     */
    public function getBobinas()
    {
        return $this->bobinas;
    }

    /**
     * Set pesoteorico
     *
     * @param float $pesoteorico
     * @return Orden
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
     * @param integer $tratado
     * @return Orden
     */
    public function setTratado($tratado)
    {
        $this->tratado = $tratado;
        return $this;
    }

    /**
     * Get tratado
     *
     * @return integer 
     */
    public function getTratado()
    {
        return $this->tratado;
    }

    /**
     * Set tipotubo
     *
     * @param integer $tipotubo
     * @return Orden
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
     * Set notasextrusion
     *
     * @param string $notasextrusion
     * @return Orden
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
     * Set fecha_extrusion
     *
     * @param \DateTime $fechaExtrusion
     * @return Orden
     */
    public function setFechaExtrusion($fechaExtrusion)
    {
        $this->fecha_extrusion = $fechaExtrusion;
        return $this;
    }

    /**
     * Get fecha_extrusion
     *
     * @return \DateTime 
     */
    public function getFechaExtrusion()
    {
        return $this->fecha_extrusion;
    }

    /**
     * Set operario_extrusion
     *
     * @param string $operarioExtrusion
     * @return Orden
     */
    public function setOperarioExtrusion($operarioExtrusion)
    {
        $this->operario_extrusion = $operarioExtrusion;
    
        return $this;
    }

    /**
     * Get operario_extrusion
     *
     * @return string 
     */
    public function getOperarioExtrusion()
    {
        return $this->operario_extrusion;
    }

    /**
     * Set kgfinal
     *
     * @param float $kgfinal
     * @return Orden
     */
    public function setKgfinal($kgfinal)
    {
        $this->kgfinal = $kgfinal;
    
        return $this;
    }

    /**
     * Get kgfinal
     *
     * @return float 
     */
    public function getKgfinal()
    {
        return $this->kgfinal;
    }

    /**
     * Set tiempo_extrusion
     *
     * @param \DateTime $tiempoExtrusion
     * @return Orden
     */
    public function setTiempoExtrusion($tiempoExtrusion)
    {
        $this->tiempo_extrusion = $tiempoExtrusion;
    
        return $this;
    }

    /**
     * Get tiempo_extrusion
     *
     * @return \DateTime 
     */
    public function getTiempoExtrusion()
    {
        return $this->tiempo_extrusion;
    }

    /**
     * Set kilosimp
     *
     * @param float $kilosimp
     * @return Orden
     */
    public function setKilosimp($kilosimp)
    {
        $this->kilosimp = $kilosimp;
    
        return $this;
    }

    /**
     * Get kilosimp
     *
     * @return float 
     */
    public function getKilosimp()
    {
        return $this->kilosimp;
    }

    /**
     * Set impresion
     *
     * @param boolean $impresion
     * @return Orden
     */
    public function setImpresion($impresion)
    {
        $this->impresion = $impresion;
    
        return $this;
    }

    /**
     * Get impresion
     *
     * @return boolean 
     */
    public function getImpresion()
    {
        return $this->impresion;
    }

    /**
     * Set medidaimp
     *
     * @param string $medidaimp
     * @return Orden
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
     * Set anverso
     *
     * @param string $anverso
     * @return Orden
     */
    public function setAnverso($anverso)
    {
        $this->anverso = $anverso;
    
        return $this;
    }

    /**
     * Get anverso
     *
     * @return string 
     */
    public function getAnverso()
    {
        return $this->anverso;
    }

    /**
     * Set reverso
     *
     * @param string $reverso
     * @return Orden
     */
    public function setReverso($reverso)
    {
        $this->reverso = $reverso;
    
        return $this;
    }

    /**
     * Get reverso
     *
     * @return string 
     */
    public function getReverso()
    {
        return $this->reverso;
    }

    /**
     * Set coloresa
     *
     * @param string $coloresa
     * @return Orden
     */
    public function setColoresa($coloresa)
    {
        $this->coloresa = $coloresa;
    
        return $this;
    }

    /**
     * Get coloresa
     *
     * @return string 
     */
    public function getColoresa()
    {
        return $this->coloresa;
    }

    /**
     * Set coloresr
     *
     * @param string $coloresr
     * @return Orden
     */
    public function setColoresr($coloresr)
    {
        $this->coloresr = $coloresr;
    
        return $this;
    }

    /**
     * Get coloresr
     *
     * @return string 
     */
    public function getColoresr()
    {
        return $this->coloresr;
    }

    /**
     * Set cliche
     *
     * @param integer $cliche
     * @return Orden
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
     * Set carpeta
     *
     * @param string $carpeta
     * @return Orden
     */
    public function setCarpeta($carpeta)
    {
        $this->carpeta = $carpeta;
    
        return $this;
    }

    /**
     * Get carpeta
     *
     * @return string 
     */
    public function getCarpeta()
    {
        return $this->carpeta;
    }

    /**
     * Set soldadura
     *
     * @param integer $soldadura
     * @return Orden
     */
    public function setSoldadura($soldadura)
    {
        $this->soldadura = $soldadura;
    
        return $this;
    }

    /**
     * Get soldadura
     *
     * @return integer 
     */
    public function getSoldadura()
    {
        return $this->soldadura;
    }

    /**
     * Set notasimpresion
     *
     * @param string $notasimpresion
     * @return Orden
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
     * Set fecha_impresion
     *
     * @param \DateTime $fechaImpresion
     * @return Orden
     */
    public function setFechaImpresion($fechaImpresion)
    {
        $this->fecha_impresion = $fechaImpresion;
    
        return $this;
    }

    /**
     * Get fecha_impresion
     *
     * @return \DateTime 
     */
    public function getFechaImpresion()
    {
        return $this->fecha_impresion;
    }

    /**
     * Set operario_impresion
     *
     * @param string $operarioImpresion
     * @return Orden
     */
    public function setOperarioImpresion($operarioImpresion)
    {
        $this->operario_impresion = $operarioImpresion;
    
        return $this;
    }

    /**
     * Get operario_impresion
     *
     * @return string 
     */
    public function getOperarioImpresion()
    {
        return $this->operario_impresion;
    }

    /**
     * Set tiempo_impresion
     *
     * @param string $tiempoImpresion
     * @return Orden
     */
    public function setTiempoImpresion($tiempoImpresion)
    {
        $this->tiempo_impresion = $tiempoImpresion;
    
        return $this;
    }

    /**
     * Get tiempo_impresion
     *
     * @return string 
     */
    public function getTiempoImpresion()
    {
        return $this->tiempo_impresion;
    }

    /**
     * Set corte
     *
     * @param boolean $corte
     * @return Orden
     */
    public function setCorte($corte)
    {
        $this->corte = $corte;
    
        return $this;
    }

    /**
     * Get corte
     *
     * @return boolean 
     */
    public function getCorte()
    {
        return $this->corte;
    }

    /**
     * Set cantidadc
     *
     * @param string $cantidadc
     * @return Orden
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
     * @param string $anchoc
     * @return Orden
     */
    public function setAnchoc($anchoc)
    {
        $this->anchoc = $anchoc;
    
        return $this;
    }

    /**
     * Get anchoc
     *
     * @return string 
     */
    public function getAnchoc()
    {
        return $this->anchoc;
    }

    /**
     * Set largoc
     *
     * @param string $largoc
     * @return Orden
     */
    public function setLargoc($largoc)
    {
        $this->largoc = $largoc;
    
        return $this;
    }

    /**
     * Get largoc
     *
     * @return string 
     */
    public function getLargoc()
    {
        return $this->largoc;
    }

    /**
     * Set solapa
     *
     * @param integer $solapa
     * @return Orden
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
     * Set paquete
     *
     * @param string $paquete
     * @return Orden
     */
    public function setPaquete($paquete)
    {
        $this->paquete = $paquete;
    
        return $this;
    }

    /**
     * Get paquete
     *
     * @return string 
     */
    public function getPaquete()
    {
        return $this->paquete;
    }

    /**
     * Set saco
     *
     * @param string $saco
     * @return Orden
     */
    public function setSaco($saco)
    {
        $this->saco = $saco;
    
        return $this;
    }

    /**
     * Get saco
     *
     * @return string 
     */
    public function getSaco()
    {
        return $this->saco;
    }

    /**
     * Set palets
     *
     * @param string $palets
     * @return Orden
     */
    public function setPalets($palets)
    {
        $this->palets = $palets;
    
        return $this;
    }

    /**
     * Get palets
     *
     * @return string 
     */
    public function getPalets()
    {
        return $this->palets;
    }

    /**
     * Set notascorte
     *
     * @param string $notascorte
     * @return Orden
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
     * Set fecha_corte
     *
     * @param \DateTime $fechaCorte
     * @return Orden
     */
    public function setFechaCorte($fechaCorte)
    {
        $this->fecha_corte = $fechaCorte;
    
        return $this;
    }

    /**
     * Get fecha_corte
     *
     * @return \DateTime 
     */
    public function getFechaCorte()
    {
        return $this->fecha_corte;
    }

    /**
     * Set tiempo_corte
     *
     * @param string $tiempoCorte
     * @return Orden
     */
    public function setTiempoCorte($tiempoCorte)
    {
        $this->tiempo_corte = $tiempoCorte;
    
        return $this;
    }

    /**
     * Get tiempo_corte
     *
     * @return string 
     */
    public function getTiempoCorte()
    {
        return $this->tiempo_corte;
    }

    /**
     * Set operario_corte
     *
     * @param string $operarioCorte
     * @return Orden
     */
    public function setOperarioCorte($operarioCorte)
    {
        $this->operario_corte = $operarioCorte;
    
        return $this;
    }

    /**
     * Get operario_corte
     *
     * @return string 
     */
    public function getOperarioCorte()
    {
        return $this->operario_corte;
    }

    /**
     * Set cliente
     *
     * @param PB\VentasBundle\Entity\Cliente $cliente
     * @return Orden
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
    
    public function getEstadoText(){
    	$yaml = new Parser(); try {	$value = $yaml->parse(file_get_contents(__DIR__ . '/../../VentasBundle/Resources/config/ventas.yml'));
    	} catch (ParseException $e) { printf("Unable to parse the YAML string: %s", $e->getMessage()); }
    	if($this->estado != null) return $value['estados_orden'][$this->estado];
    }
    public function getCantidaduniText(){
    	$ar = array('1'   => 'Bolsas','2' => 'Kg', '3' => 'Metros');
    	if($this->cantidaduni != null) return $ar[$this->cantidaduni];
    }
    public function getEspesoruniText(){
    	$ar = array('1'   => 'Galgas','2' => 'Micras');
    	if($this->espesoruni != null) return $ar[$this->espesoruni];
    }
    public function getTipotuboText(){
    	$yaml = new Parser(); try {	$value = $yaml->parse(file_get_contents(__DIR__ . '/../../VentasBundle/Resources/config/ventas.yml'));
    	} catch (ParseException $e) { printf("Unable to parse the YAML string: %s", $e->getMessage()); }
    	if($this->tipotubo != null) return $value['tipo_tubo'][$this->tipotubo];
    }
    public function getTipomaterialText(){
    	$yaml = new Parser(); try {	$value = $yaml->parse(file_get_contents(__DIR__ . '/../../VentasBundle/Resources/config/ventas.yml'));
    	} catch (ParseException $e) {		printf("Unable to parse the YAML string: %s", $e->getMessage());}
    	if($this->tipomaterial != null) return $value['tipo_material'][$this->tipomaterial];
    }
    public function getProductoText(){
    	$yaml = new Parser(); try {	$value = $yaml->parse(file_get_contents(__DIR__ . '/../../VentasBundle/Resources/config/ventas.yml'));
    	} catch (ParseException $e) {	printf("Unable to parse the YAML string: %s", $e->getMessage()); }
    	if($this->producto != null) return $value['producto'][$this->producto];
    }
    public function getTratadoText(){
    	$yaml = new Parser(); try {	$value = $yaml->parse(file_get_contents(__DIR__ . '/../../VentasBundle/Resources/config/ventas.yml'));
    	} catch (ParseException $e) { printf("Unable to parse the YAML string: %s", $e->getMessage()); }
    	if($this->tratado != null) return $value['tratado'][$this->tratado];
    }
    public function getClicheText(){
    	$yaml = new Parser(); try {	$value = $yaml->parse(file_get_contents(__DIR__ . '/../../VentasBundle/Resources/config/ventas.yml'));
    	} catch (ParseException $e) {
    		printf("Unable to parse the YAML string: %s", $e->getMessage());
    	}
    	if($this->cliche != null) return $value['cliches'][$this->cliche];
    }
    public function getTipoBolsaText(){
    	$yaml = new Parser(); try {	$value = $yaml->parse(file_get_contents(__DIR__ . '/../../VentasBundle/Resources/config/ventas.yml'));
    	} catch (ParseException $e) {
    		printf("Unable to parse the YAML string: %s", $e->getMessage());
    	}
    	if($this->tipobolsa != null) return $value['soldadura'][$this->tipobolsa];
    }
    public function getAsaText(){
    	$yaml = new Parser(); try {	$value = $yaml->parse(file_get_contents(__DIR__ . '/../../VentasBundle/Resources/config/ventas.yml'));
    	} catch (ParseException $e) {
    		printf("Unable to parse the YAML string: %s", $e->getMessage());
    	}
    	if($this->asa != null) return $value['asas'][$this->asa];
    }
    /**
     * @var PB\VentasBundle\Entity\PedidoCliente
     */
    private $pedidocliente;


    /**
     * Set pedidocliente
     *
     * @param PB\VentasBundle\Entity\PedidoCliente $pedidocliente
     * @return Orden
     */
    public function setPedidocliente(\PB\VentasBundle\Entity\PedidoCliente $pedidocliente = null)
    {
        $this->pedidocliente = $pedidocliente;
        return $this;
    }

    /**
     * Get pedidocliente
     *
     * @return PB\VentasBundle\Entity\PedidoCliente 
     */
    public function getPedidocliente()
    {
        return $this->pedidocliente;
    }
    public function getPedidoclienteId()
    {
    	foreach ($this->pedidocliente as $pe) {
    	 			return $pe->getId();
    	
    	}
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pedidocliente = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add pedidocliente
     *
     * @param PB\VentasBundle\Entity\Pedidocliente $pedidocliente
     * @return Orden
     */
    public function addPedidocliente(\PB\VentasBundle\Entity\Pedidocliente $pedidocliente)
    {
        $this->pedidocliente[] = $pedidocliente;
    
        return $this;
    }

    /**
     * Remove pedidocliente
     *
     * @param PB\VentasBundle\Entity\Pedidocliente $pedidocliente
     */
    public function removePedidocliente(\PB\VentasBundle\Entity\Pedidocliente $pedidocliente)
    {
        $this->pedidocliente->removeElement($pedidocliente);
    }
    /**
     * @var integer $tipobolsa
     */
    private $tipobolsa;

    /**
     * @var integer $asa
     */
    private $asa;


    /**
     * Set tipobolsa
     *
     * @param integer $tipobolsa
     * @return Orden
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
     * Set asa
     *
     * @param integer $asa
     * @return Orden
     */
    public function setAsa($asa)
    {
        $this->asa = $asa;
    
        return $this;
    }

    /**
     * Get asa
     *
     * @return integer 
     */
    public function getAsa()
    {
        return $this->asa;
    }
    /**
     * @var integer $rebobinado
     */
    private $rebobinado;

    /**
     * @var float $bobinasr
     */
    private $bobinasr;

    /**
     * @var float $metrosr
     */
    private $metrosr;

    /**
     * @var float $kgr
     */
    private $kgr;

    /**
     * @var float $totalrebobinado
     */
    private $totalrebobinado;

    /**
     * @var string $notasrebobinado
     */
    private $notasrebobinado;

    /**
     * @var \DateTime $fecha_rebobinado
     */
    private $fecha_rebobinado;

    /**
     * @var string $tiempo_rebobinado
     */
    private $tiempo_rebobinado;

    /**
     * @var string $operario_rebobinado
     */
    private $operario_rebobinado;


    /**
     * Set rebobinado
     *
     * @param integer $rebobinado
     * @return Orden
     */
    public function setRebobinado($rebobinado)
    {
        $this->rebobinado = $rebobinado;
    
        return $this;
    }

    /**
     * Get rebobinado
     *
     * @return integer 
     */
    public function getRebobinado()
    {
        return $this->rebobinado;
    }

    /**
     * Set bobinasr
     *
     * @param float $bobinasr
     * @return Orden
     */
    public function setBobinasr($bobinasr)
    {
        $this->bobinasr = $bobinasr;
    
        return $this;
    }

    /**
     * Get bobinasr
     *
     * @return float 
     */
    public function getBobinasr()
    {
        return $this->bobinasr;
    }

    /**
     * Set metrosr
     *
     * @param float $metrosr
     * @return Orden
     */
    public function setMetrosr($metrosr)
    {
        $this->metrosr = $metrosr;
    
        return $this;
    }

    /**
     * Get metrosr
     *
     * @return float 
     */
    public function getMetrosr()
    {
        return $this->metrosr;
    }

    /**
     * Set kgr
     *
     * @param float $kgr
     * @return Orden
     */
    public function setKgr($kgr)
    {
        $this->kgr = $kgr;
    
        return $this;
    }

    /**
     * Get kgr
     *
     * @return float 
     */
    public function getKgr()
    {
        return $this->kgr;
    }

    /**
     * Set totalrebobinado
     *
     * @param float $totalrebobinado
     * @return Orden
     */
    public function setTotalrebobinado($totalrebobinado)
    {
        $this->totalrebobinado = $totalrebobinado;
    
        return $this;
    }

    /**
     * Get totalrebobinado
     *
     * @return float 
     */
    public function getTotalrebobinado()
    {
        return $this->totalrebobinado;
    }

    /**
     * Set notasrebobinado
     *
     * @param string $notasrebobinado
     * @return Orden
     */
    public function setNotasrebobinado($notasrebobinado)
    {
        $this->notasrebobinado = $notasrebobinado;
    
        return $this;
    }

    /**
     * Get notasrebobinado
     *
     * @return string 
     */
    public function getNotasrebobinado()
    {
        return $this->notasrebobinado;
    }
    
    /**
     * Set fecha_rebobinado
     *
     * @param \DateTime $fechaRebobinado
     * @return Orden
     */
    public function setFechaRebobinado($fechaRebobinado)
    {
        $this->fecha_rebobinado = $fechaRebobinado;
    
        return $this;
    }

    /**
     * Get fecha_rebobinado
     *
     * @return \DateTime 
     */
    public function getFechaRebobinado()
    {
        return $this->fecha_rebobinado;
    }

    /**
     * Set tiempo_rebobinado
     *
     * @param string $tiempoRebobinado
     * @return Orden
     */
    public function setTiempoRebobinado($tiempoRebobinado)
    {
        $this->tiempo_rebobinado = $tiempoRebobinado;
    
        return $this;
    }

    /**
     * Get tiempo_rebobinado
     *
     * @return string 
     */
    public function getTiempoRebobinado()
    {
        return $this->tiempo_rebobinado;
    }

    /**
     * Set operario_rebobinado
     *
     * @param string $operarioRebobinado
     * @return Orden
     */
    public function setOperarioRebobinado($operarioRebobinado)
    {
        $this->operario_rebobinado = $operarioRebobinado;
    
        return $this;
    }

    /**
     * Get operario_rebobinado
     *
     * @return string 
     */
    public function getOperarioRebobinado()
    {
        return $this->operario_rebobinado;
    }
    /**
     * @var PB\ProduccionBundle\Entity\Maquina
     */
    private $maquinaextrusion;


    /**
     * Set maquinaextrusion
     *
     * @param PB\ProduccionBundle\Entity\Maquina $maquinaextrusion
     * @return Orden
     */
    public function setMaquinaextrusion(\PB\ProduccionBundle\Entity\Maquina $maquinaextrusion = null)
    {
        $this->maquinaextrusion = $maquinaextrusion;
    
        return $this;
    }

    /**
     * Get maquinaextrusion
     *
     * @return PB\ProduccionBundle\Entity\Maquina 
     */
    public function getMaquinaextrusion()
    {
        return $this->maquinaextrusion;
    }
    /**
     * @var PB\ProduccionBundle\Entity\Maquina
     */
    private $maquinaimpresion;

    /**
     * @var PB\ProduccionBundle\Entity\Maquina
     */
    private $maquinacorte;

    /**
     * @var PB\ProduccionBundle\Entity\Maquina
     */
    private $maquinarebobinado;


    /**
     * Set maquinaimpresion
     *
     * @param PB\ProduccionBundle\Entity\Maquina $maquinaimpresion
     * @return Orden
     */
    public function setMaquinaimpresion(\PB\ProduccionBundle\Entity\Maquina $maquinaimpresion = null)
    {
        $this->maquinaimpresion = $maquinaimpresion;
    
        return $this;
    }

    /**
     * Get maquinaimpresion
     *
     * @return PB\ProduccionBundle\Entity\Maquina 
     */
    public function getMaquinaimpresion()
    {
        return $this->maquinaimpresion;
    }

    /**
     * Set maquinacorte
     *
     * @param PB\ProduccionBundle\Entity\Maquina $maquinacorte
     * @return Orden
     */
    public function setMaquinacorte(\PB\ProduccionBundle\Entity\Maquina $maquinacorte = null)
    {
        $this->maquinacorte = $maquinacorte;
    
        return $this;
    }

    /**
     * Get maquinacorte
     *
     * @return PB\ProduccionBundle\Entity\Maquina 
     */
    public function getMaquinacorte()
    {
        return $this->maquinacorte;
    }

    /**
     * Set maquinarebobinado
     *
     * @param PB\ProduccionBundle\Entity\Maquina $maquinarebobinado
     * @return Orden
     */
    public function setMaquinarebobinado(\PB\ProduccionBundle\Entity\Maquina $maquinarebobinado = null)
    {
        $this->maquinarebobinado = $maquinarebobinado;
    
        return $this;
    }

    /**
     * Get maquinarebobinado
     *
     * @return PB\ProduccionBundle\Entity\Maquina 
     */
    public function getMaquinarebobinado()
    {
        return $this->maquinarebobinado;
    }
    /**
     * @var integer $metrose
     */
    private $metrose;


    /**
     * Set metrose
     *
     * @param integer $metrose
     * @return Orden
     */
    public function setMetrose($metrose)
    {
        $this->metrose = $metrose;
    
        return $this;
    }

    /**
     * Get metrose
     *
     * @return integer 
     */
    public function getMetrose()
    {
        return $this->metrose;
    }
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $extrusion_orden;


    /**
     * Add extrusion_orden
     *
     * @param PB\ProduccionBundle\Entity\Extrusion $extrusionOrden
     * @return Orden
     */
    public function addExtrusionOrden(\PB\ProduccionBundle\Entity\Extrusion $extrusionOrden)
    {
        $this->extrusion_orden[] = $extrusionOrden;
    
        return $this;
    }

    /**
     * Remove extrusion_orden
     *
     * @param PB\ProduccionBundle\Entity\Extrusion $extrusionOrden
     */
    public function removeExtrusionOrden(\PB\ProduccionBundle\Entity\Extrusion $extrusionOrden)
    {
        $this->extrusion_orden->removeElement($extrusionOrden);
    }

    /**
     * Get extrusion_orden
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getExtrusionOrden()
    {
        return $this->extrusion_orden;
    }

    /**
     * Set extrusion_orden
     *
     * @param PB\ProduccionBundle\Entity\Extrusion $extrusionOrden
     * @return Orden
     */
    public function setExtrusionOrden(\PB\ProduccionBundle\Entity\Extrusion $extrusionOrden = null)
    {
        $this->extrusion_orden = $extrusionOrden;
    
        return $this;
    }
    /**
     * @var float $largo
     */
    private $largo;


    /**
     * Set largo
     *
     * @param float $largo
     * @return Orden
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
    public function getClienteNombre()
    {
    	return $this->cliente->getNombre();
    }
}