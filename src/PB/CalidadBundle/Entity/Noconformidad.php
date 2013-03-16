<?php

namespace PB\CalidadBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Exception\ParseException;

/**
 * PB\CalidadBundle\Entity\Noconformidad
 */
class Noconformidad
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var \DateTime $fecha_apertura
     */
    private $fecha_apertura;

    /**
     * @var string $descripcion
     */
    private $descripcion;

    /**
     * @var string $acciones_inmediatas
     */
    private $acciones_inmediatas;

    /**
     * @var string $analisis_causas
     */
    private $analisis_causas;

    /**
     * @var string $acciones
     */
    private $acciones;

    /**
     * @var string $responsable
     */
    private $responsable;

    /**
     * @var string $plazo
     */
    private $plazo;

    /**
     * @var \DateTime $fecha_cierre
     */
    private $fecha_cierre;

    /**
     * @var string $explicacion
     */
    private $explicacion;


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
     * Set fecha_apertura
     *
     * @param \DateTime $fechaApertura
     * @return Noconformidad
     */
    public function setFechaApertura($fechaApertura)
    {
        $this->fecha_apertura = $fechaApertura;
    
        return $this;
    }

    /**
     * Get fecha_apertura
     *
     * @return \DateTime 
     */
    public function getFechaApertura()
    {
        return $this->fecha_apertura;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Noconformidad
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    
        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set acciones_inmediatas
     *
     * @param string $accionesInmediatas
     * @return Noconformidad
     */
    public function setAccionesInmediatas($accionesInmediatas)
    {
        $this->acciones_inmediatas = $accionesInmediatas;
    
        return $this;
    }

    /**
     * Get acciones_inmediatas
     *
     * @return string 
     */
    public function getAccionesInmediatas()
    {
        return $this->acciones_inmediatas;
    }

    /**
     * Set analisis_causas
     *
     * @param string $analisisCausas
     * @return Noconformidad
     */
    public function setAnalisisCausas($analisisCausas)
    {
        $this->analisis_causas = $analisisCausas;
    
        return $this;
    }

    /**
     * Get analisis_causas
     *
     * @return string 
     */
    public function getAnalisisCausas()
    {
        return $this->analisis_causas;
    }

    /**
     * Set acciones
     *
     * @param string $acciones
     * @return Noconformidad
     */
    public function setAcciones($acciones)
    {
        $this->acciones = $acciones;
    
        return $this;
    }

    /**
     * Get acciones
     *
     * @return string 
     */
    public function getAcciones()
    {
        return $this->acciones;
    }

    /**
     * Set responsable
     *
     * @param string $responsable
     * @return Noconformidad
     */
    public function setResponsable($responsable)
    {
        $this->responsable = $responsable;
    
        return $this;
    }

    /**
     * Get responsable
     *
     * @return string 
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * Set plazo
     *
     * @param string $plazo
     * @return Noconformidad
     */
    public function setPlazo($plazo)
    {
        $this->plazo = $plazo;
    
        return $this;
    }

    /**
     * Get plazo
     *
     * @return string 
     */
    public function getPlazo()
    {
        return $this->plazo;
    }

    /**
     * Set fecha_cierre
     *
     * @param \DateTime $fechaCierre
     * @return Noconformidad
     */
    public function setFechaCierre($fechaCierre)
    {
        $this->fecha_cierre = $fechaCierre;
    
        return $this;
    }

    /**
     * Get fecha_cierre
     *
     * @return \DateTime 
     */
    public function getFechaCierre()
    {
        return $this->fecha_cierre;
    }

    /**
     * Set explicacion
     *
     * @param string $explicacion
     * @return Noconformidad
     */
    public function setExplicacion($explicacion)
    {
        $this->explicacion = $explicacion;
    
        return $this;
    }

    /**
     * Get explicacion
     *
     * @return string 
     */
    public function getExplicacion()
    {
        return $this->explicacion;
    }
    /**
     * @var PB\VentasBundle\Entity\Cliente
     */
    private $cliente;

    /**
     * @var PB\VentasBundle\Entity\Cliente
     */
    private $pedidiocliente;


    /**
     * Set cliente
     *
     * @param PB\VentasBundle\Entity\Cliente $cliente
     * @return Noconformidad
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

    /**
     * Set pedidiocliente
     *
     * @param PB\VentasBundle\Entity\Cliente $pedidiocliente
     * @return Noconformidad
     */
    public function setPedidiocliente(\PB\VentasBundle\Entity\Cliente $pedidiocliente = null)
    {
        $this->pedidiocliente = $pedidiocliente;
    
        return $this;
    }

    /**
     * Get pedidiocliente
     *
     * @return PB\VentasBundle\Entity\Cliente 
     */
    public function getPedidiocliente()
    {
        return $this->pedidiocliente;
    }
    /**
     * @var PB\VentasBundle\Entity\PedidoCliente
     */
    private $pedidocliente;


    /**
     * Set pedidocliente
     *
     * @param PB\VentasBundle\Entity\PedidoCliente $pedidocliente
     * @return Noconformidad
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
    /**
     * @var integer $estado
     */
    private $estado;


    /**
     * Set estado
     *
     * @param integer $estado
     * @return Noconformidad
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
    public function getEstadoText(){
    	$yaml = new Parser(); try {	$value = $yaml->parse(file_get_contents(__DIR__ . '/../../VentasBundle/Resources/config/ventas.yml'));
    	} catch (ParseException $e) {
    		printf("Unable to parse the YAML string: %s", $e->getMessage());
    	}
    	if($this->estado != null) return $value['estados_incidencias'][$this->estado];
    }
}