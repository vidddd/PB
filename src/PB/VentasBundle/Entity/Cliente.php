<?php

namespace PB\VentasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 */
class Cliente
{
    /**
     * @var integer $id
     */
    private $id;


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
     * @var string $nombre
     */
    private $nombre;

    /**
     * @var string $nombrecomercial
     */
    private $nombrecomercial;

    /**
     * @var string $nif
     */
    private $nif;

    /**
     * @var date $fechaalta
     */
    private $fechaalta;

    /**
     * @var string $direccion
     */
    private $direccion;

    /**
     * @var string $localidad
     */
    private $localidad;

    /**
     * @var string $cp
     */
    private $cp;

    /**
     * @var integer $codprovincia
     */
    private $codprovincia;

    /**
     * @var string $provincia
     */
    private $provincia;

    /**
     * @var string $telefono
     */
    private $telefono;

    /**
     * @var string $fax
     */
    private $fax;

    /**
     * @var string $movil
     */
    private $movil;

    /**
     * @var string $web
     */
    private $web;

    /**
     * @var string $email
     */
    private $email;

    /**
     * @var string $cuenta
     */
    private $cuenta;

    /**
     * @var boolean $descuento
     */
    private $descuento;

    /**
     * @var string $recargo
     */
    private $recargo;

    /**
     * @var text $observaciones
     */
    private $observaciones;

    /**
     * @var integer $codfp
     */
    private $codfp;

    /**
     * @var decimal $facturaciona
     */
    private $facturaciona;

    /**
     * @var decimal $facturacionb
     */
    private $facturacionb;

    /**
     * @var decimal $debea
     */
    private $debea;

    /**
     * @var decimal $habera
     */
    private $habera;

    /**
     * @var decimal $saldoa
     */
    private $saldoa;

    /**
     * @var decimal $debeb
     */
    private $debeb;

    /**
     * @var decimal $haberb
     */
    private $haberb;

    /**
     * @var decimal $saldob
     */
    private $saldob;

    /**
     * @var decimal $albaranespendientes
     */
    private $albaranespendientes;

    /**
     * @var decimal $albaranespendientesa
     */
    private $albaranespendientesa;

    /**
     * @var decimal $albaranespendientesb
     */
    private $albaranespendientesb;

    /**
     * @var string $codigoultimafactura
     */
    private $codigoultimafactura;

    /**
     * @var datetime $fechaultimafactura
     */
    private $fechaultimafactura;

    /**
     * @var string $codigoultimoalbaran
     */
    private $codigoultimoalbaran;

    /**
     * @var datetime $fechaultimoalbaran
     */
    private $fechaultimoalbaran;
    
    public function __construct()
    {
    	//$this->codprovincia = new ArrayCollection();
    	$this->codprovincia_id = new \Doctrine\Common\Collections\ArrayCollection();
    	
    }
    

    /**
     * Set nombre
     *
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
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
     * Set nombrecomercial
     *
     * @param string $nombrecomercial
     */
    public function setNombrecomercial($nombrecomercial)
    {
        $this->nombrecomercial = $nombrecomercial;
    }

    /**
     * Get nombrecomercial
     *
     * @return string 
     */
    public function getNombrecomercial()
    {
        return $this->nombrecomercial;
    }

    /**
     * Set nif
     *
     * @param string $nif
     */
    public function setNif($nif)
    {
        $this->nif = $nif;
    }

    /**
     * Get nif
     *
     * @return string 
     */
    public function getNif()
    {
        return $this->nif;
    }

    /**
     * Set fechaalta
     *
     * @param date $fechaalta
     */
    public function setFechaalta($fechaalta)
    {
        $this->fechaalta = $fechaalta;
    }

    /**
     * Get fechaalta
     *
     * @return date 
     */
    public function getFechaalta()
    {
        return $this->fechaalta;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set localidad
     *
     * @param string $localidad
     */
    public function setLocalidad($localidad)
    {
        $this->localidad = $localidad;
    }

    /**
     * Get localidad
     *
     * @return string 
     */
    public function getLocalidad()
    {
        return $this->localidad;
    }

    /**
     * Set cp
     *
     * @param string $cp
     */
    public function setCp($cp)
    {
        $this->cp = $cp;
    }

    /**
     * Get cp
     *
     * @return string 
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set codprovincia
     *
     * @param string $codprovincia
     */
    //public function setCodprovincia(\PB\InicioBundle\Entity\Provincias $codprovincia)
    public function setCodprovincia($codprovincia)
    {
    	$this->codprovincia = $codprovincia->getId();
    }

    /**
     * Get codprovincia
     *
     * @return Doctrine\Common\Collections\Collection
     */ 
    public function getCodprovincia()
    {
        return $this->codprovincia;
    }

    /**
     * Set provincia
     *
     * @param string $provincia
     */
    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;
    }

    /**
     * Get provincia
     *
     * @return string 
     */
    public function getProvincia()
    {
        return $this->provincia;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set fax
     *
     * @param string $fax
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
    }

    /**
     * Get fax
     *
     * @return string 
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set movil
     *
     * @param string $movil
     */
    public function setMovil($movil)
    {
        $this->movil = $movil;
    }

    /**
     * Get movil
     *
     * @return string 
     */
    public function getMovil()
    {
        return $this->movil;
    }

    /**
     * Set web
     *
     * @param string $web
     */
    public function setWeb($web)
    {
        $this->web = $web;
    }

    /**
     * Get web
     *
     * @return string 
     */
    public function getWeb()
    {
        return $this->web;
    }

    /**
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set cuenta
     *
     * @param string $cuenta
     */
    public function setCuenta($cuenta)
    {
        $this->cuenta = $cuenta;
    }

    /**
     * Get cuenta
     *
     * @return string 
     */
    public function getCuenta()
    {
        return $this->cuenta;
    }

    /**
     * Set descuento
     *
     * @param boolean $descuento
     */
    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;
    }

    /**
     * Get descuento
     *
     * @return boolean 
     */
    public function getDescuento()
    {
        return $this->descuento;
    }

    /**
     * Set recargo
     *
     * @param string $recargo
     */
    public function setRecargo($recargo)
    {
        $this->recargo = $recargo;
    }

    /**
     * Get recargo
     *
     * @return string 
     */
    public function getRecargo()
    {
        return $this->recargo;
    }

    /**
     * Set observaciones
     *
     * @param text $observaciones
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;
    }

    /**
     * Get observaciones
     *
     * @return text 
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set codfp
     *
     * @param integer $codfp
     */
    public function setCodfp($codfp)
    {
        $this->codfp = $codfp;
    }

    /**
     * Get codfp
     *
     * @return integer 
     */
    public function getCodfp()
    {
        return $this->codfp;
    }

    /**
     * Set facturaciona
     *
     * @param decimal $facturaciona
     */
    public function setFacturaciona($facturaciona)
    {
        $this->facturaciona = $facturaciona;
    }

    /**
     * Get facturaciona
     *
     * @return decimal 
     */
    public function getFacturaciona()
    {
        return $this->facturaciona;
    }

    /**
     * Set facturacionb
     *
     * @param decimal $facturacionb
     */
    public function setFacturacionb($facturacionb)
    {
        $this->facturacionb = $facturacionb;
    }

    /**
     * Get facturacionb
     *
     * @return decimal 
     */
    public function getFacturacionb()
    {
        return $this->facturacionb;
    }

    /**
     * Set debea
     *
     * @param decimal $debea
     */
    public function setDebea($debea)
    {
        $this->debea = $debea;
    }

    /**
     * Get debea
     *
     * @return decimal 
     */
    public function getDebea()
    {
        return $this->debea;
    }

    /**
     * Set habera
     *
     * @param decimal $habera
     */
    public function setHabera($habera)
    {
        $this->habera = $habera;
    }

    /**
     * Get habera
     *
     * @return decimal 
     */
    public function getHabera()
    {
        return $this->habera;
    }

    /**
     * Set saldoa
     *
     * @param decimal $saldoa
     */
    public function setSaldoa($saldoa)
    {
        $this->saldoa = $saldoa;
    }

    /**
     * Get saldoa
     *
     * @return decimal 
     */
    public function getSaldoa()
    {
        return $this->saldoa;
    }

    /**
     * Set debeb
     *
     * @param decimal $debeb
     */
    public function setDebeb($debeb)
    {
        $this->debeb = $debeb;
    }

    /**
     * Get debeb
     *
     * @return decimal 
     */
    public function getDebeb()
    {
        return $this->debeb;
    }

    /**
     * Set haberb
     *
     * @param decimal $haberb
     */
    public function setHaberb($haberb)
    {
        $this->haberb = $haberb;
    }

    /**
     * Get haberb
     *
     * @return decimal 
     */
    public function getHaberb()
    {
        return $this->haberb;
    }

    /**
     * Set saldob
     *
     * @param decimal $saldob
     */
    public function setSaldob($saldob)
    {
        $this->saldob = $saldob;
    }

    /**
     * Get saldob
     *
     * @return decimal 
     */
    public function getSaldob()
    {
        return $this->saldob;
    }

    /**
     * Set albaranespendientes
     *
     * @param decimal $albaranespendientes
     */
    public function setAlbaranespendientes($albaranespendientes)
    {
        $this->albaranespendientes = $albaranespendientes;
    }

    /**
     * Get albaranespendientes
     *
     * @return decimal 
     */
    public function getAlbaranespendientes()
    {
        return $this->albaranespendientes;
    }

    /**
     * Set albaranespendientesa
     *
     * @param decimal $albaranespendientesa
     */
    public function setAlbaranespendientesa($albaranespendientesa)
    {
        $this->albaranespendientesa = $albaranespendientesa;
    }

    /**
     * Get albaranespendientesa
     *
     * @return decimal 
     */
    public function getAlbaranespendientesa()
    {
        return $this->albaranespendientesa;
    }

    /**
     * Set albaranespendientesb
     *
     * @param decimal $albaranespendientesb
     */
    public function setAlbaranespendientesb($albaranespendientesb)
    {
        $this->albaranespendientesb = $albaranespendientesb;
    }

    /**
     * Get albaranespendientesb
     *
     * @return decimal 
     */
    public function getAlbaranespendientesb()
    {
        return $this->albaranespendientesb;
    }

    /**
     * Set codigoultimafactura
     *
     * @param string $codigoultimafactura
     */
    public function setCodigoultimafactura($codigoultimafactura)
    {
        $this->codigoultimafactura = $codigoultimafactura;
    }

    /**
     * Get codigoultimafactura
     *
     * @return string 
     */
    public function getCodigoultimafactura()
    {
        return $this->codigoultimafactura;
    }

    /**
     * Set fechaultimafactura
     *
     * @param datetime $fechaultimafactura
     */
    public function setFechaultimafactura($fechaultimafactura)
    {
        $this->fechaultimafactura = $fechaultimafactura;
    }

    /**
     * Get fechaultimafactura
     *
     * @return datetime 
     */
    public function getFechaultimafactura()
    {
        return $this->fechaultimafactura;
    }

    /**
     * Set codigoultimoalbaran
     *
     * @param string $codigoultimoalbaran
     */
    public function setCodigoultimoalbaran($codigoultimoalbaran)
    {
        $this->codigoultimoalbaran = $codigoultimoalbaran;
    }

    /**
     * Get codigoultimoalbaran
     *
     * @return string 
     */
    public function getCodigoultimoalbaran()
    {
        return $this->codigoultimoalbaran;
    }

    /**
     * Set fechaultimoalbaran
     *
     * @param datetime $fechaultimoalbaran
     */
    public function setFechaultimoalbaran($fechaultimoalbaran)
    {
        $this->fechaultimoalbaran = $fechaultimoalbaran;
    }

    /**
     * Get fechaultimoalbaran
     *
     * @return datetime 
     */
    public function getFechaultimoalbaran()
    {
        return $this->fechaultimoalbaran;
    }
    /**
     * @var bigint $codpedido
     */
    private $codpedido;


    /**
     * Set codpedido
     *
     * @param bigint $codpedido
     */
    public function setCodpedido($codpedido)
    {
        $this->codpedido = $codpedido;
    }

    /**
     * Get codpedido
     *
     * @return bigint 
     */
    public function getCodpedido()
    {
        return $this->codpedido;
    }
    /**
     * @var bigint $codcliente
     */
    private $codcliente;


    /**
     * Set codcliente
     *
     * @param bigint $codcliente
     */
    public function setCodcliente($codcliente)
    {
        $this->codcliente = $codcliente;
    }

    /**
     * Get codcliente
     *
     * @return bigint 
     */
    public function getCodcliente()
    {
        return $this->codcliente;
    }
    /**
     * @var string $pais
     */
    private $pais;


    /**
     * Set pais
     *
     * @param string $pais
     */
    public function setPais($pais)
    {
        $this->pais = $pais;
    }

    /**
     * Get pais
     *
     * @return string 
     */
    public function getPais()
    {
        return $this->pais;
    }
    public function setFechaAltaPre()
    {
    	$this->fechaalta = new \DateTime("now");
    }
    /**
     * @var PB\InicioBundle\Entity\Provincia
     */
    private $Provincia;


    /**
     * @var PB\InicioBundle\Entity\Provincias
     */
    private $provincias;


    /**
     * Set provincias
     *
     * @param PB\InicioBundle\Entity\Provincias $provincias
     */
    public function setProvincias(\PB\InicioBundle\Entity\Provincias $provincias)
    {
        $this->provincias = $provincias;
    }

    /**
     * Get provincias
     *
     * @return PB\InicioBundle\Entity\Provincias 
     */
    public function getProvincias()
    {
        return $this->provincias;
    }
    /**
     * @var PB\InicioBundle\Entity\Provincias
     */
    private $cliente_provincias;


    /**
     * Set cliente_provincias
     *
     * @param PB\InicioBundle\Entity\Provincias $clienteProvincias
     */
    public function setClienteProvincias(\PB\InicioBundle\Entity\Provincias $clienteProvincias)
    {
        $this->cliente_provincias = $clienteProvincias;
    }

    /**
     * Get cliente_provincias
     *
     * @return PB\InicioBundle\Entity\Provincias 
     */
    public function getClienteProvincias()
    {
        return $this->cliente_provincias;
    }
}