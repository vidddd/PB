<?php

namespace PB\AlmacenBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Exception\ParseException;

/**
 * PB\AlmacenBundle\Entity\Producto
 */
class Producto
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
     * @var boolean $vendido
     */
    private $vendido;

    /**
     * @var boolean $comprado
     */
    private $comprado;

    /**
     * @var integer $tipoproducto
     */
    private $tipoproducto;

    /**
     * @var integer $metodo_suministro
     */
    private $metodo_suministro;

    /**
     * @var string $preciocompra
     */
    private $preciocompra;

    /**
     * @var string $precioventa
     */
    private $precioventa;

    /**
     * @var string $referencia
     */
    private $referencia;

    /**
     * @var string $descripcion
     */
    private $descripcion;


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
     * @return Producto
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
     * Set vendido
     *
     * @param boolean $vendido
     * @return Producto
     */
    public function setVendido($vendido)
    {
        $this->vendido = $vendido;
    
        return $this;
    }

    /**
     * Get vendido
     *
     * @return boolean 
     */
    public function getVendido()
    {
        return $this->vendido;
    }

    /**
     * Set comprado
     *
     * @param boolean $comprado
     * @return Producto
     */
    public function setComprado($comprado)
    {
        $this->comprado = $comprado;
    
        return $this;
    }

    /**
     * Get comprado
     *
     * @return boolean 
     */
    public function getComprado()
    {
        return $this->comprado;
    }

    /**
     * Set tipoproducto
     *
     * @param integer $tipoproducto
     * @return Producto
     */
    public function setTipoproducto($tipoproducto)
    {
        $this->tipoproducto = $tipoproducto;
    
        return $this;
    }

    /**
     * Get tipoproducto
     *
     * @return integer 
     */
    public function getTipoproducto()
    {
        return $this->tipoproducto;
    }
    public function getTipoProductoText()
    {
    	$yaml = new Parser(); try {	$value = $yaml->parse(file_get_contents(__DIR__ . '/../Resources/config/almacen.yml'));
    	} catch (ParseException $e) {
    		printf("Unable to parse the YAML string: %s", $e->getMessage());
    	}
    	return $value['tipo_producto'][$this->tipoproducto];
    }
    /**
     * Set metodo_suministro
     *
     * @param integer $metodoSuministro
     * @return Producto
     */
    public function setMetodoSuministro($metodoSuministro)
    {
        $this->metodo_suministro = $metodoSuministro;
    
        return $this;
    }

    /**
     * Get metodo_suministro
     *
     * @return integer 
     */
    public function getMetodoSuministro()
    {
        return $this->metodo_suministro;
    }

    /**
     * Set preciocompra
     *
     * @param string $preciocompra
     * @return Producto
     */
    public function setPreciocompra($preciocompra)
    {
        $this->preciocompra = $preciocompra;
    
        return $this;
    }

    /**
     * Get preciocompra
     *
     * @return string 
     */
    public function getPreciocompra()
    {
        return $this->preciocompra;
    }

    /**
     * Set precioventa
     *
     * @param string $precioventa
     * @return Producto
     */
    public function setPrecioventa($precioventa)
    {
        $this->precioventa = $precioventa;
    
        return $this;
    }

    /**
     * Get precioventa
     *
     * @return string 
     */
    public function getPrecioventa()
    {
        return $this->precioventa;
    }

    /**
     * Set referencia
     *
     * @param string $referencia
     * @return Producto
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return Producto
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
}