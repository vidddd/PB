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
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $almacen;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->almacen = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add almacen
     *
     * @param PB\AlmacenBundle\Entity\Almacen $almacen
     * @return Producto
     */
    public function addAlmacen(\PB\AlmacenBundle\Entity\Almacen $almacen)
    {
        $this->almacen[] = $almacen;
    
        return $this;
    }

    /**
     * Remove almacen
     *
     * @param PB\AlmacenBundle\Entity\Almacen $almacen
     */
    public function removeAlmacen(\PB\AlmacenBundle\Entity\Almacen $almacen)
    {
        $this->almacen->removeElement($almacen);
    }

    /**
     * Get almacen
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getAlmacen()
    {
        return $this->almacen;
    }
    /**
     * @var integer $ancho
     */
    private $ancho;

    /**
     * @var integer $largo
     */
    private $largo;

    /**
     * @var integer $galga
     */
    private $galga;


    /**
     * Set ancho
     *
     * @param integer $ancho
     * @return Producto
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
     * Set largo
     *
     * @param integer $largo
     * @return Producto
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

    /**
     * Set galga
     *
     * @param integer $galga
     * @return Producto
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
    public function __toString()
    {
    	$id = $this->nombre;
    	return (string)$id;
    }
}