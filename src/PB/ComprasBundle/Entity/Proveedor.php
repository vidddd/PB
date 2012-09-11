<?php

namespace PB\ComprasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Exception\ParseException;

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
     * @var smallint $provincia
     */
    private $provincia;
    
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
     * @var smallint $codigo_formapago
     */
    private $codigo_formapago;
    
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
     * Set provincia
     *
     * @param smallint $provincia
     */
    public function setProvincia($provincia)
    {
        //var_dump($provincia); die;
        
    	$this->provincia = $provincia->getId();
    }
    /**
     * Get provincia
     *
     * @return smallint 
     */
    public function getProvincia()
    {
    	return $this->provincia;
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
     * Set codigo_formapago
     *
     * @param smallint $codigoFormapago
     */
    public function setCodigoFormapago($codigoFormapago)
    {
        $this->codigo_formapago = $codigoFormapago;
    }

    /**
     * Get codigo_formapago
     *
     * @return smallint 
     */
    public function getCodigoFormapago()
    {
        return $this->codigo_formapago;
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
}