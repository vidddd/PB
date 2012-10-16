<?php

namespace PB\ComprasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Exception\ParseException;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * PB\ComprasBundle\Entity\Proveedor
 */
class Proveedor
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
     * @var string $nombrecontacto
     */
    private $nombrecontacto;

    /**
     * @var integer $telefono_contacto
     */
    private $telefono_contacto;

    /**
     * @var string $email_contacto
     */
    private $email_contacto;

    /**
     * @var integer $telefono
     */
    private $telefono;
    /**
     * @var string $localidad
     */
    private $localidad;
    
    /**
     * @var smallint $pais
     */
    private $pais;
    
    /**
     * @var smallint $tipo_proveedor
     */
    private $tipo_proveedor;
    
    /**
     * @var boolean $es_cliente
     */
    private $es_cliente;
    
    /**
     * @var boolean $activo
     */
    private $activo;
    
    /**
     * @var text $observaciones
     */
    private $observaciones;
    
    /**
     * @var smallint $medio_envio
     */
    private $medio_envio;
    
    /**
     * @var boolean $paga_iva
     */
    private $paga_iva;
    
    /**
     * @var boolean $irpf
     */
    private $irpf;
    
    /**
     * @var smallint $codigo_externo
     */
    private $codigo_externo;
    
    /**
     * @var string $cuenta_bancaria
     */
    private $cuenta_bancaria;
    
    /**
     * @var string $codigo_contabilidad
     */
    private $codigo_contabilidad;

    /**
     * @var bigint $fax
     */
    private $fax;
    
    /**
     * @var string $email
     */
    private $email;
    
    /**
     * @var string $direccion
     */
    private $direccion;
    
    /**
     * @var integer $cp
     */
    private $cp;
    

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
     * Set nombrecontacto
     *
     * @param string $nombrecontacto
     */
    public function setNombrecontacto($nombrecontacto)
    {
        $this->nombrecontacto = $nombrecontacto;
    }

    /**
     * Get nombrecontacto
     *
     * @return string 
     */
    public function getNombrecontacto()
    {
        return $this->nombrecontacto;
    }

    /**
     * Set telefono_contacto
     *
     * @param integer $telefonoContacto
     */
    public function setTelefonoContacto($telefonoContacto)
    {
        $this->telefono_contacto = $telefonoContacto;
    }

    /**
     * Get telefono_contacto
     *
     * @return integer 
     */
    public function getTelefonoContacto()
    {
        return $this->telefono_contacto;
    }

    /**
     * Set email_contacto
     *
     * @param string $emailContacto
     */
    public function setEmailContacto($emailContacto)
    {
        $this->email_contacto = $emailContacto;
    }

    /**
     * Get email_contacto
     *
     * @return string 
     */
    public function getEmailContacto()
    {
        return $this->email_contacto;
    }

    /**
     * Set telefono
     *
     * @param integer $telefono
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    /**
     * Get telefono
     *
     * @return integer 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }


    /**
     * Set fax
     *
     * @param bigint $fax
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
    }

    /**
     * Get fax
     *
     * @return bigint 
     */
    public function getFax()
    {
        return $this->fax;
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
     * Set cp
     *
     * @param integer $cp
     */
    public function setCp($cp)
    {
        $this->cp = $cp;
    }

    /**
     * Get cp
     *
     * @return integer 
     */
    public function getCp()
    {
        return $this->cp;
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
     * Set pais
     *
     * @param smallint $pais
     */
    public function setPais($pais)
    {
        $this->pais = $pais;
    }

    /**
     * Get pais
     *
     * @return smallint 
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * Set tipo_proveedor
     *
     * @param smallint $tipoProveedor
     */
    public function setTipoProveedor($tipoProveedor)
    {
        $this->tipo_proveedor = $tipoProveedor;
    }

    /**
     * Get tipo_proveedor
     *
     * @return smallint 
     */
    public function getTipoProveedor()
    {
		/*
    	$yaml = new Parser();
		$value = array();
		try {
			$value = $yaml->parse(file_get_contents(__DIR__ . '/../Resources/config/compras.yml'));
			
		} catch (ParseException $e) {
			printf("Unable to parse the YAML string: %s", $e->getMessage());
		}
		$tipos = $value['tipo_proveedor'];
		if(!is_null($this->tipo_proveedor))
			return $tipos[$this->tipo_proveedor];
		else
			return $this->tipo_proveedor; 
		*/	
    	return $this->tipo_proveedor;
    }

    /**
     * Set es_cliente
     *
     * @param boolean $esCliente
     */
    public function setEsCliente($esCliente)
    {
        $this->es_cliente = $esCliente;
    }

    /**
     * Get es_cliente
     *
     * @return boolean 
     */
    public function getEsCliente()
    {
        return $this->es_cliente;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;
    }

    /**
     * Get activo
     *
     * @return boolean 
     */
    public function getActivo()
    {
        return $this->activo;
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
     * Set medio_envio
     *
     * @param smallint $medioEnvio
     */
    public function setMedioEnvio($medioEnvio)
    {
        $this->medio_envio = $medioEnvio;
    }

    /**
     * Get medio_envio
     *
     * @return smallint 
     */
    public function getMedioEnvio()
    {
        return $this->medio_envio;
    }

    /**
     * Set paga_iva
     *
     * @param boolean $pagaIva
     */
    public function setPagaIva($pagaIva)
    {
        $this->paga_iva = $pagaIva;
    }

    /**
     * Get paga_iva
     *
     * @return boolean 
     */
    public function getPagaIva()
    {
        return $this->paga_iva;
    }

    /**
     * Set irpf
     *
     * @param boolean $irpf
     */
    public function setIrpf($irpf)
    {
        $this->irpf = $irpf;
    }

    /**
     * Get irpf
     *
     * @return boolean 
     */
    public function getIrpf()
    {
        return $this->irpf;
    }
    /**
     * Set codigo_externo
     *
     * @param smallint $codigoExterno
     */
    public function setCodigoExterno($codigoExterno)
    {
        $this->codigo_externo = $codigoExterno;
    }

    /**
     * Get codigo_externo
     *
     * @return smallint 
     */
    public function getCodigoExterno()
    {
        return $this->codigo_externo;
    }

    /**
     * Set cuenta_bancaria
     *
     * @param string $cuentaBancaria
     */
    public function setCuentaBancaria($cuentaBancaria)
    {
        $this->cuenta_bancaria = $cuentaBancaria;
    }

    /**
     * Get cuenta_bancaria
     *
     * @return string 
     */
    public function getCuentaBancaria()
    {
        return $this->cuenta_bancaria;
    }

    /**
     * Set codigo_contabilidad
     *
     * @param string $codigoContabilidad
     */
    public function setCodigoContabilidad($codigoContabilidad)
    {
        $this->codigo_contabilidad = $codigoContabilidad;
    }

    /**
     * Get codigo_contabilidad
     *
     * @return string 
     */
    public function getCodigoContabilidad()
    {
        return $this->codigo_contabilidad;
    }
    /**
     * @var date $fechaalta
     */
    private $fechaalta;


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
     * @var integer $codproveedor
     */
    private $codproveedor;


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
     * @var string $oneToOne
     */
    private $oneToOne;


    /**
     * Set oneToOne
     *
     * @param string $oneToOne
     * @return Proveedor
     */
    public function setOneToOne($oneToOne)
    {
        $this->oneToOne = $oneToOne;
    
        return $this;
    }

    /**
     * Get oneToOne
     *
     * @return string 
     */
    public function getOneToOne()
    {
        return $this->oneToOne;
    }
    /**
     * @var PB\GeneralBundle\Entity\FormaPago
     */
    private $formapago;


    /**
     * Set formapago
     *
     * @param PB\GeneralBundle\Entity\FormaPago $formapago
     * @return Proveedor
     */
    public function setFormapago(\PB\GeneralBundle\Entity\FormaPago $formapago = null)
    {
        $this->formapago = $formapago;
    
        return $this;
    }

    /**
     * Get formapago
     *
     * @return PB\GeneralBundle\Entity\FormaPago 
     */
    public function getFormapago()
    {
        return $this->formapago;
    }
    /**
     * @var PB\GeneralBundle\Entity\FormaPago
     */
    private $formapago_proveedor;


    /**
     * Set formapago_proveedor
     *
     * @param PB\GeneralBundle\Entity\FormaPago $formapagoProveedor
     * @return Proveedor
     */
    public function setFormapagoProveedor(\PB\GeneralBundle\Entity\FormaPago $formapagoProveedor = null)
    {
        $this->formapago_proveedor = $formapagoProveedor;
    
        return $this;
    }

    /**
     * Get formapago_proveedor
     *
     * @return PB\GeneralBundle\Entity\FormaPago 
     */
    public function getFormapagoProveedor()
    {
        return $this->formapago_proveedor;
    }
    /**
     * @var PB\InicioBundle\Entity\Provincias
     */
    private $provincia_proveedor;
    
    /**
     * @var integer $provincia
     */
    private $provincia;

    /**
     * Set provincia_proveedor
     *
     * @param PB\InicioBundle\Entity\Provincias $provinciaProveedor
     * @return Proveedor
     */
    public function setProvinciaProveedor(\PB\InicioBundle\Entity\Provincias $provinciaProveedor = null)
    {
        $this->provincia_proveedor = $provinciaProveedor;
    
        return $this;
    }

    /**
     * Get provincia_proveedor
     *
     * @return PB\InicioBundle\Entity\Provincias 
     */
    public function getProvinciaProveedor()
    {
        return $this->provincia_proveedor;
    }
    function __construct() {
    	//$this->provincia_proveecdor = new ArrayCollection();
    	//$this->formapago_proveedor = new ArrayCollection();
     }
    /**
     * @var string $web
     */
    private $web;


    /**
     * Set web
     *
     * @param string $web
     * @return Proveedor
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
     * @var integer $telefono2
     */
    private $telefono2;


    /**
     * Set telefono2
     *
     * @param integer $telefono2
     * @return Proveedor
     */
    public function setTelefono2($telefono2)
    {
        $this->telefono2 = $telefono2;
    
        return $this;
    }

    /**
     * Get telefono2
     *
     * @return integer 
     */
    public function getTelefono2()
    {
        return $this->telefono2;
    }
    /**
     * @var PB\ComprasBundle\Entity\PedidoCompra
     */
    private $proveedor;


    /**
     * Set proveedor
     *
     * @param PB\ComprasBundle\Entity\PedidoCompra $proveedor
     * @return Proveedor
     */
    public function setProveedor(\PB\ComprasBundle\Entity\PedidoCompra $proveedor = null)
    {
        $this->proveedor = $proveedor;
    
        return $this;
    }

    /**
     * Get proveedor
     *
     * @return PB\Compras\Entity\PedidoCompra 
     */
    public function getProveedor()
    {
        return $this->proveedor;
    }
    /**
     * @var PB\ComprasBundle\Entity\PedidoCompra
     */
    private $pedidocompras;


    /**
     * Set pedidocompras
     *
     * @param PB\ComprasBundle\Entity\PedidoCompra $pedidocompras
     * @return Proveedor
     */
    public function setPedidocompras(\PB\ComprasBundle\Entity\PedidoCompra $pedidocompras = null)
    {
        $this->pedidocompras = $pedidocompras;
    
        return $this;
    }

    /**
     * Get pedidocompras
     *
     * @return PB\ComprasBundle\Entity\PedidoCompra 
     */
    public function getPedidocompras()
    {
        return $this->pedidocompras;
    }
    /**
     * @var PB\ComprasBundle\Entity\PedidoCompra
     */
    private $pedidocompra;


    /**
     * Set pedidocompra
     *
     * @param PB\ComprasBundle\Entity\PedidoCompra $pedidocompra
     * @return Proveedor
     */
    public function setPedidocompra(\PB\ComprasBundle\Entity\PedidoCompra $pedidocompra = null)
    {
        $this->pedidocompra = $pedidocompra;
    
        return $this;
    }

    /**
     * Get pedidocompra
     *
     * @return PB\ComprasBundle\Entity\PedidoCompra 
     */
    public function getPedidocompra()
    {
        return $this->pedidocompra;
    }
    public function __toString()
    {
    	return $this->nombre;
    }
    public function setFechaAltaPre()
    {
    	$this->fechaalta = new \DateTime("now");
    }

    /**
     * Add pedidocompra
     *
     * @param PB\ComprasBundle\Entity\PedidoCompra $pedidocompra
     * @return Proveedor
     */
    public function addPedidocompra(\PB\ComprasBundle\Entity\PedidoCompra $pedidocompra)
    {
        $this->pedidocompra[] = $pedidocompra;
    
        return $this;
    }

    /**
     * Remove pedidocompra
     *
     * @param PB\ComprasBundle\Entity\PedidoCompra $pedidocompra
     */
    public function removePedidocompra(\PB\ComprasBundle\Entity\PedidoCompra $pedidocompra)
    {
        $this->pedidocompra->removeElement($pedidocompra);
    }
    
    private $tipoproveedor_show;
    
    public function getTipoproveedor_show(){
         return $this->getTipoProveedor()."Preubaaaaaaa";
    }
}