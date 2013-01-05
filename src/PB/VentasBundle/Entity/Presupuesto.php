<?php

namespace PB\VentasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PB\VentasBundle\Entity\Presupuesto
 */
class Presupuesto
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $cliente
     */
    private $cliente;

    /**
     * @var string $material
     */
    private $material;

    /**
     * @var string $color
     */
    private $color;


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
     * Set cliente
     *
     * @param string $cliente
     * @return Presupuesto
     */
    public function setCliente($cliente)
    {
        $this->cliente = $cliente;
    
        return $this;
    }

    /**
     * Get cliente
     *
     * @return string 
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Set material
     *
     * @param string $material
     * @return Presupuesto
     */
    public function setMaterial($material)
    {
        $this->material = $material;
    
        return $this;
    }

    /**
     * Get material
     *
     * @return string 
     */
    public function getMaterial()
    {
        return $this->material;
    }

    /**
     * Set color
     *
     * @param string $color
     * @return Presupuesto
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
     * @var integer $estado
     */
    private $estado;

    /**
     * @var string $codpresupuesto
     */
    private $codpresupuesto;

    /**
     * @var \DateTime $fecha
     */
    private $fecha;

    /**
     * @var string $cantidad
     */
    private $cantidad;

    /**
     * @var integer $tipotupo
     */
    private $tipotupo;

    /**
     * @var integer $tipobolsa
     */
    private $tipobolsa;

    /**
     * @var integer $bobinas
     */
    private $bobinas;

    /**
     * @var integer $mbobinas
     */
    private $mbobinas;

    /**
     * @var integer $kgbobinas
     */
    private $kgbobinas;

    /**
     * @var string $ancho
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
     * @var float $precio
     */
    private $precio;

    /**
     * @var string $impresion1
     */
    private $impresion1;

    /**
     * @var string $impresion2
     */
    private $impresion2;

    /**
     * @var string $impresioncolor1
     */
    private $impresioncolor1;

    /**
     * @var string $impresioncolor2
     */
    private $impresioncolor2;

    /**
     * @var integer $cliche
     */
    private $cliche;

    /**
     * @var float $preciocliche
     */
    private $preciocliche;

    /**
     * @var string $paquetes
     */
    private $paquetes;

    /**
     * @var string $sacos
     */
    private $sacos;

    /**
     * @var string $palets
     */
    private $palets;

    /**
     * @var string $observaciones
     */
    private $observaciones;


    /**
     * Set estado
     *
     * @param integer $estado
     * @return Presupuesto
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
     * Set codpresupuesto
     *
     * @param string $codpresupuesto
     * @return Presupuesto
     */
    public function setCodpresupuesto($codpresupuesto)
    {
        $this->codpresupuesto = $codpresupuesto;
    
        return $this;
    }

    /**
     * Get codpresupuesto
     *
     * @return string 
     */
    public function getCodpresupuesto()
    {
        return $this->codpresupuesto;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Presupuesto
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
     * Set cantidad
     *
     * @param string $cantidad
     * @return Presupuesto
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
     * Set tipotupo
     *
     * @param integer $tipotupo
     * @return Presupuesto
     */
    public function setTipotupo($tipotupo)
    {
        $this->tipotupo = $tipotupo;
    
        return $this;
    }

    /**
     * Get tipotupo
     *
     * @return integer 
     */
    public function getTipotupo()
    {
        return $this->tipotupo;
    }

    /**
     * Set tipobolsa
     *
     * @param integer $tipobolsa
     * @return Presupuesto
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
     * Set bobinas
     *
     * @param integer $bobinas
     * @return Presupuesto
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
     * Set mbobinas
     *
     * @param integer $mbobinas
     * @return Presupuesto
     */
    public function setMbobinas($mbobinas)
    {
        $this->mbobinas = $mbobinas;
    
        return $this;
    }

    /**
     * Get mbobinas
     *
     * @return integer 
     */
    public function getMbobinas()
    {
        return $this->mbobinas;
    }

    /**
     * Set kgbobinas
     *
     * @param integer $kgbobinas
     * @return Presupuesto
     */
    public function setKgbobinas($kgbobinas)
    {
        $this->kgbobinas = $kgbobinas;
    
        return $this;
    }

    /**
     * Get kgbobinas
     *
     * @return integer 
     */
    public function getKgbobinas()
    {
        return $this->kgbobinas;
    }

    /**
     * Set ancho
     *
     * @param string $ancho
     * @return Presupuesto
     */
    public function setAncho($ancho)
    {
        $this->ancho = $ancho;
    
        return $this;
    }

    /**
     * Get ancho
     *
     * @return string 
     */
    public function getAncho()
    {
        return $this->ancho;
    }

    /**
     * Set galga
     *
     * @param integer $galga
     * @return Presupuesto
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
     * @return Presupuesto
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
     * @return Presupuesto
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
     * Set impresion1
     *
     * @param string $impresion1
     * @return Presupuesto
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
     * @return Presupuesto
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
     * Set impresioncolor1
     *
     * @param string $impresioncolor1
     * @return Presupuesto
     */
    public function setImpresioncolor1($impresioncolor1)
    {
        $this->impresioncolor1 = $impresioncolor1;
    
        return $this;
    }

    /**
     * Get impresioncolor1
     *
     * @return string 
     */
    public function getImpresioncolor1()
    {
        return $this->impresioncolor1;
    }

    /**
     * Set impresioncolor2
     *
     * @param string $impresioncolor2
     * @return Presupuesto
     */
    public function setImpresioncolor2($impresioncolor2)
    {
        $this->impresioncolor2 = $impresioncolor2;
    
        return $this;
    }

    /**
     * Get impresioncolor2
     *
     * @return string 
     */
    public function getImpresioncolor2()
    {
        return $this->impresioncolor2;
    }

    /**
     * Set cliche
     *
     * @param integer $cliche
     * @return Presupuesto
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
     * Set preciocliche
     *
     * @param float $preciocliche
     * @return Presupuesto
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
     * Set paquetes
     *
     * @param string $paquetes
     * @return Presupuesto
     */
    public function setPaquetes($paquetes)
    {
        $this->paquetes = $paquetes;
    
        return $this;
    }

    /**
     * Get paquetes
     *
     * @return string 
     */
    public function getPaquetes()
    {
        return $this->paquetes;
    }

    /**
     * Set sacos
     *
     * @param string $sacos
     * @return Presupuesto
     */
    public function setSacos($sacos)
    {
        $this->sacos = $sacos;
    
        return $this;
    }

    /**
     * Get sacos
     *
     * @return string 
     */
    public function getSacos()
    {
        return $this->sacos;
    }

    /**
     * Set palets
     *
     * @param string $palets
     * @return Presupuesto
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
     * Set observaciones
     *
     * @param string $observaciones
     * @return Presupuesto
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
     * @var integer $largo
     */
    private $largo;


    /**
     * Set largo
     *
     * @param integer $largo
     * @return Presupuesto
     */
    public function setLargo($largo)
    {
        $this->largo = $largo;
    
        return $this;
    }

    /**
     * Get largo
     *
     * @return integer 
     */
    public function getLargo()
    {
        return $this->largo;
    }
}