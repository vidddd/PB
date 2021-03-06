<?php

namespace PB\VentasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


class Cliente
{
    /**
     * @var integer $id
     */
    private $id;

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
    

    /**
     * @var bigint $codcliente
     */
    private $codcliente;

    /**
     * @var string $pais
     */
    private $pais;
	
    /**
     * @var PB\InicioBundle\Entity\Provincias
     */
    private $provincia_cliente;

    public function setFechaAltaPre()
    {
    	$this->fechaalta = new \DateTime("now");
    }
    public function __construct()
    {
    
    }
    
    public function __toString()
    {
    	return $this->nombre;
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
     * Set codcliente
     *
     * @param integer $codcliente
     * @return Cliente
     */
    public function setCodcliente($codcliente)
    {
        $this->codcliente = $codcliente;
    
        return $this;
    }

    /**
     * Get codcliente
     *
     * @return integer 
     */
    public function getCodcliente()
    {
        return $this->codcliente;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Cliente
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
     * Set nombrecomercial
     *
     * @param string $nombrecomercial
     * @return Cliente
     */
    public function setNombrecomercial($nombrecomercial)
    {
        $this->nombrecomercial = $nombrecomercial;
    
        return $this;
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
     * @return Cliente
     */
    public function setNif($nif)
    {
        $this->nif = $nif;
    
        return $this;
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
     * @param \DateTime $fechaalta
     * @return Cliente
     */
    public function setFechaalta($fechaalta)
    {
        $this->fechaalta = $fechaalta;
    
        return $this;
    }

    /**
     * Get fechaalta
     *
     * @return \DateTime 
     */
    public function getFechaalta()
    {
        return $this->fechaalta;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Cliente
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    
        return $this;
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
     * @return Cliente
     */
    public function setLocalidad($localidad)
    {
        $this->localidad = $localidad;
    
        return $this;
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
     * @return Cliente
     */
    public function setCp($cp)
    {
        $this->cp = $cp;
    
        return $this;
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
     * Set pais
     *
     * @param string $pais
     * @return Cliente
     */
    public function setPais($pais)
    {
        $this->pais = $pais;
    
        return $this;
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

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return Cliente
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    
        return $this;
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
     * @return Cliente
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
    
        return $this;
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
     * @return Cliente
     */
    public function setMovil($movil)
    {
        $this->movil = $movil;
    
        return $this;
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
     * @return Cliente
     */
    public function setWeb($web)
    {
        $this->web = $web;
    
        return $this;
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
     * @return Cliente
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
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
     * @return Cliente
     */
    public function setCuenta($cuenta)
    {
        $this->cuenta = $cuenta;
    
        return $this;
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
     * @param integer $descuento
     * @return Cliente
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
     * @return Cliente
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
     * Set observaciones
     *
     * @param string $observaciones
     * @return Cliente
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
     * Set codfp
     *
     * @param integer $codfp
     * @return Cliente
     */
    public function setCodfp($codfp)
    {
        $this->codfp = $codfp;
    
        return $this;
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
     * @param float $facturaciona
     * @return Cliente
     */
    public function setFacturaciona($facturaciona)
    {
        $this->facturaciona = $facturaciona;
    
        return $this;
    }

    /**
     * Get facturaciona
     *
     * @return float 
     */
    public function getFacturaciona()
    {
        return $this->facturaciona;
    }

    /**
     * Set facturacionb
     *
     * @param float $facturacionb
     * @return Cliente
     */
    public function setFacturacionb($facturacionb)
    {
        $this->facturacionb = $facturacionb;
    
        return $this;
    }

    /**
     * Get facturacionb
     *
     * @return float 
     */
    public function getFacturacionb()
    {
        return $this->facturacionb;
    }

    /**
     * Set debea
     *
     * @param float $debea
     * @return Cliente
     */
    public function setDebea($debea)
    {
        $this->debea = $debea;
    
        return $this;
    }

    /**
     * Get debea
     *
     * @return float 
     */
    public function getDebea()
    {
        return $this->debea;
    }

    /**
     * Set habera
     *
     * @param float $habera
     * @return Cliente
     */
    public function setHabera($habera)
    {
        $this->habera = $habera;
    
        return $this;
    }

    /**
     * Get habera
     *
     * @return float 
     */
    public function getHabera()
    {
        return $this->habera;
    }

    /**
     * Set saldoa
     *
     * @param float $saldoa
     * @return Cliente
     */
    public function setSaldoa($saldoa)
    {
        $this->saldoa = $saldoa;
    
        return $this;
    }

    /**
     * Get saldoa
     *
     * @return float 
     */
    public function getSaldoa()
    {
        return $this->saldoa;
    }

    /**
     * Set debeb
     *
     * @param float $debeb
     * @return Cliente
     */
    public function setDebeb($debeb)
    {
        $this->debeb = $debeb;
    
        return $this;
    }

    /**
     * Get debeb
     *
     * @return float 
     */
    public function getDebeb()
    {
        return $this->debeb;
    }

    /**
     * Set haberb
     *
     * @param float $haberb
     * @return Cliente
     */
    public function setHaberb($haberb)
    {
        $this->haberb = $haberb;
    
        return $this;
    }

    /**
     * Get haberb
     *
     * @return float 
     */
    public function getHaberb()
    {
        return $this->haberb;
    }

    /**
     * Set saldob
     *
     * @param float $saldob
     * @return Cliente
     */
    public function setSaldob($saldob)
    {
        $this->saldob = $saldob;
    
        return $this;
    }

    /**
     * Get saldob
     *
     * @return float 
     */
    public function getSaldob()
    {
        return $this->saldob;
    }

    /**
     * Set albaranespendientes
     *
     * @param float $albaranespendientes
     * @return Cliente
     */
    public function setAlbaranespendientes($albaranespendientes)
    {
        $this->albaranespendientes = $albaranespendientes;
    
        return $this;
    }

    /**
     * Get albaranespendientes
     *
     * @return float 
     */
    public function getAlbaranespendientes()
    {
        return $this->albaranespendientes;
    }

    /**
     * Set albaranespendientesa
     *
     * @param float $albaranespendientesa
     * @return Cliente
     */
    public function setAlbaranespendientesa($albaranespendientesa)
    {
        $this->albaranespendientesa = $albaranespendientesa;
    
        return $this;
    }

    /**
     * Get albaranespendientesa
     *
     * @return float 
     */
    public function getAlbaranespendientesa()
    {
        return $this->albaranespendientesa;
    }

    /**
     * Set albaranespendientesb
     *
     * @param float $albaranespendientesb
     * @return Cliente
     */
    public function setAlbaranespendientesb($albaranespendientesb)
    {
        $this->albaranespendientesb = $albaranespendientesb;
    
        return $this;
    }

    /**
     * Get albaranespendientesb
     *
     * @return float 
     */
    public function getAlbaranespendientesb()
    {
        return $this->albaranespendientesb;
    }

    /**
     * Set codigoultimafactura
     *
     * @param string $codigoultimafactura
     * @return Cliente
     */
    public function setCodigoultimafactura($codigoultimafactura)
    {
        $this->codigoultimafactura = $codigoultimafactura;
    
        return $this;
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
     * @param \DateTime $fechaultimafactura
     * @return Cliente
     */
    public function setFechaultimafactura($fechaultimafactura)
    {
        $this->fechaultimafactura = $fechaultimafactura;
    
        return $this;
    }

    /**
     * Get fechaultimafactura
     *
     * @return \DateTime 
     */
    public function getFechaultimafactura()
    {
        return $this->fechaultimafactura;
    }

    /**
     * Set codigoultimoalbaran
     *
     * @param string $codigoultimoalbaran
     * @return Cliente
     */
    public function setCodigoultimoalbaran($codigoultimoalbaran)
    {
        $this->codigoultimoalbaran = $codigoultimoalbaran;
    
        return $this;
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
     * @param \DateTime $fechaultimoalbaran
     * @return Cliente
     */
    public function setFechaultimoalbaran($fechaultimoalbaran)
    {
        $this->fechaultimoalbaran = $fechaultimoalbaran;
    
        return $this;
    }

    /**
     * Get fechaultimoalbaran
     *
     * @return \DateTime 
     */
    public function getFechaultimoalbaran()
    {
        return $this->fechaultimoalbaran;
    }

    /**
     * Set provincia_cliente
     *
     * @param PB\InicioBundle\Entity\Provincias $provinciaCliente
     * @return Cliente
     */
    public function setProvinciaCliente(\PB\InicioBundle\Entity\Provincias $provinciaCliente = null)
    {
        $this->provincia_cliente = $provinciaCliente;
    
        return $this;
    }

    /**
     * Get provincia_cliente
     *
     * @return PB\InicioBundle\Entity\Provincias 
     */
    public function getProvinciaCliente()
    {
        return $this->provincia_cliente;
    }
    /**
     * @var PB\GeneralBundle\Entity\FormaPago
     */
    private $formapago_cliente;


    /**
     * Set formapago_cliente
     *
     * @param PB\GeneralBundle\Entity\FormaPago $formapagoCliente
     * @return Cliente
     */
    public function setFormapagoCliente(\PB\GeneralBundle\Entity\FormaPago $formapagoCliente = null)
    {
        $this->formapago_cliente = $formapagoCliente;
    
        return $this;
    }

    /**
     * Get formapago_cliente
     *
     * @return PB\GeneralBundle\Entity\FormaPago 
     */
    public function getFormapagoCliente()
    {
        return $this->formapago_cliente;
    }
    /**
     * @var PB\VentasBundle\Entity\Comercial
     */
    private $comercial_cliente;


    /**
     * Set comercial_cliente
     *
     * @param PB\VentasBundle\Entity\comercial $comercialCliente
     * @return Cliente
     */
    public function setComercialCliente(\PB\VentasBundle\Entity\Comercial $comercialCliente = null)
    {
        $this->comercial_cliente = $comercialCliente;
    
        return $this;
    }

    /**
     * Get comercial_cliente
     *
     * @return PB\VentasBundle\Entity\Comercial 
     */
    public function getComercialCliente()
    {
        return $this->comercial_cliente;
    }
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $precio;


    /**
     * Add precio
     *
     * @param PB\VentasBundle\Entity\Precio $precio
     * @return Cliente
     */
    public function addPrecio(\PB\VentasBundle\Entity\Precio $precio)
    {
        $this->precio[] = $precio;
    
        return $this;
    }

    /**
     * Remove precio
     *
     * @param PB\VentasBundle\Entity\Precio $precio
     */
    public function removePrecio(\PB\VentasBundle\Entity\Precio $precio)
    {
        $this->precio->removeElement($precio);
    }

    /**
     * Get precio
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPrecio()
    {
        return $this->precio;
    }
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $albaran;


    /**
     * Add albaran
     *
     * @param PB\VentasBundle\Entity\Albaran $albaran
     * @return Cliente
     */
    public function addAlbaran(\PB\VentasBundle\Entity\Albaran $albaran)
    {
        $this->albaran[] = $albaran;
    
        return $this;
    }

    /**
     * Remove albaran
     *
     * @param PB\VentasBundle\Entity\Albaran $albaran
     */
    public function removeAlbaran(\PB\VentasBundle\Entity\Albaran $albaran)
    {
        $this->albaran->removeElement($albaran);
    }

    /**
     * Get albaran
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getAlbaran()
    {
        return $this->albaran;
    }
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $factura;


    /**
     * Add factura
     *
     * @param PB\VentasBundle\Entity\Factura $factura
     * @return Cliente
     */
    public function addFactura(\PB\VentasBundle\Entity\Factura $factura)
    {
        $this->factura[] = $factura;
    
        return $this;
    }

    /**
     * Remove factura
     *
     * @param PB\VentasBundle\Entity\Factura $factura
     */
    public function removeFactura(\PB\VentasBundle\Entity\Factura $factura)
    {
        $this->factura->removeElement($factura);
    }

    /**
     * Get factura
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getFactura()
    {
        return $this->factura;
    }
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $facturaB;


    /**
     * Add facturaB
     *
     * @param PB\VentasBundle\Entity\FacturaB $facturaB
     * @return Cliente
     */
    public function addFacturaB(\PB\VentasBundle\Entity\FacturaB $facturaB)
    {
        $this->facturaB[] = $facturaB;
    
        return $this;
    }

    /**
     * Remove facturaB
     *
     * @param PB\VentasBundle\Entity\FacturaB $facturaB
     */
    public function removeFacturaB(\PB\VentasBundle\Entity\FacturaB $facturaB)
    {
        $this->facturaB->removeElement($facturaB);
    }

    /**
     * Get facturaB
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getFacturaB()
    {
        return $this->facturaB;
    }
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $pedido;


    /**
     * Add pedido
     *
     * @param PB\VentasBundle\Entity\Pedido $pedido
     * @return Cliente
     */
    public function addPedido(\PB\VentasBundle\Entity\Pedido $pedido)
    {
        $this->pedido[] = $pedido;
    
        return $this;
    }

    /**
     * Remove pedido
     *
     * @param PB\VentasBundle\Entity\Pedido $pedido
     */
    public function removePedido(\PB\VentasBundle\Entity\Pedido $pedido)
    {
        $this->pedido->removeElement($pedido);
    }

    /**
     * Get pedido
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPedido()
    {
        return $this->pedido;
    }
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $presupuesto;


    /**
     * Add presupuesto
     *
     * @param PB\VentasBundle\Entity\Presupuesto $presupuesto
     * @return Cliente
     */
    public function addPresupuesto(\PB\VentasBundle\Entity\Presupuesto $presupuesto)
    {
        $this->presupuesto[] = $presupuesto;
    
        return $this;
    }

    /**
     * Remove presupuesto
     *
     * @param PB\VentasBundle\Entity\Presupuesto $presupuesto
     */
    public function removePresupuesto(\PB\VentasBundle\Entity\Presupuesto $presupuesto)
    {
        $this->presupuesto->removeElement($presupuesto);
    }

    /**
     * Get presupuesto
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPresupuesto()
    {
        return $this->presupuesto;
    }
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $orden;


    /**
     * Add orden
     *
     * @param PB\ProduccionBundle\Entity\Orden $orden
     * @return Cliente
     */
    public function addOrden(\PB\ProduccionBundle\Entity\Orden $orden)
    {
        $this->orden[] = $orden;
    
        return $this;
    }

    /**
     * Remove orden
     *
     * @param PB\ProduccionBundle\Entity\Orden $orden
     */
    public function removeOrden(\PB\ProduccionBundle\Entity\Orden $orden)
    {
        $this->orden->removeElement($orden);
    }

    /**
     * Get orden
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getOrden()
    {
        return $this->orden;
    }
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $pedidocliente;


    /**
     * Add pedidocliente
     *
     * @param PB\VentasBundle\Entity\PedidoCliente $pedidocliente
     * @return Cliente
     */
    public function addPedidocliente(\PB\VentasBundle\Entity\PedidoCliente $pedidocliente)
    {
        $this->pedidocliente[] = $pedidocliente;
    
        return $this;
    }

    /**
     * Remove pedidocliente
     *
     * @param PB\VentasBundle\Entity\PedidoCliente $pedidocliente
     */
    public function removePedidocliente(\PB\VentasBundle\Entity\PedidoCliente $pedidocliente)
    {
        $this->pedidocliente->removeElement($pedidocliente);
    }

    /**
     * Get pedidocliente
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPedidocliente()
    {
        return $this->pedidocliente;
    }
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $noconformidad;


    /**
     * Add noconformidad
     *
     * @param PB\CalidadBundle\Entity\Noconformidad $noconformidad
     * @return Cliente
     */
    public function addNoconformidad(\PB\CalidadBundle\Entity\Noconformidad $noconformidad)
    {
        $this->noconformidad[] = $noconformidad;
    
        return $this;
    }

    /**
     * Remove noconformidad
     *
     * @param PB\CalidadBundle\Entity\Noconformidad $noconformidad
     */
    public function removeNoconformidad(\PB\CalidadBundle\Entity\Noconformidad $noconformidad)
    {
        $this->noconformidad->removeElement($noconformidad);
    }

    /**
     * Get noconformidad
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getNoconformidad()
    {
        return $this->noconformidad;
    }
}