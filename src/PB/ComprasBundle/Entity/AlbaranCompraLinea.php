<?php

namespace PB\ComprasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Exception\ParseException;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * PB\ComprasBundle\Entity\AlbaranCompraLinea
 */
class AlbaranCompraLinea
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
    public function setId($id)
    {
    	$this->id = $id;
    	return $this;
    }
  
    /**
     * @var PB\ComprasBundle\Entity\AlbaranCompra
     */
    private $albarancompralinea;


    /**
     * Set albarancompralinea
     *
     * @param PB\ComprasBundle\Entity\AlbaranCompra $albarancompralinea
     * @return AlbaranCompraLinea
     */
    public function setAlbarancompralinea(\PB\ComprasBundle\Entity\AlbaranCompra $albarancompralinea = null)
    {
        $this->albarancompralinea = $albarancompralinea;
    
        return $this;
    }

    /**
     * Get albarancompralinea
     *
     * @return PB\ComprasBundle\Entity\AlbaranCompra 
     */
    public function getAlbarancompralinea()
    {
        return $this->albarancompralinea;
    }
    /**
     * @var string $referencia
     */
    private $referencia;

    /**
     * @var string $descripcion
     */
    private $descripcion;

    /**
     * @var float $cantidad
     */
    private $cantidad;

    /**
     * @var float $precio
     */
    private $precio;

    /**
     * @var float $descuento
     */
    private $descuento;

    /**
     * @var float $total
     */
    private $total;


    /**
     * Set referencia
     *
     * @param string $referencia
     * @return AlbaranCompraLinea
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
     * @return AlbaranCompraLinea
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
     * Set cantidad
     *
     * @param float $cantidad
     * @return AlbaranCompraLinea
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    
        return $this;
    }

    /**
     * Get cantidad
     *
     * @return float 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set precio
     *
     * @param float $precio
     * @return AlbaranCompraLinea
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
     * Set descuento
     *
     * @param float $descuento
     * @return AlbaranCompraLinea
     */
    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;
    
        return $this;
    }

    /**
     * Get descuento
     *
     * @return float 
     */
    public function getDescuento()
    {
        return $this->descuento;
    }

    /**
     * Set total
     *
     * @param float $total
     * @return AlbaranCompraLinea
     */
    public function setTotal($total)
    {
        $this->total = $total;
    
        return $this;
    }

    /**
     * Get total
     *
     * @return float 
     */
    public function getTotal()
    {
        return $this->total;
    }
    /**
     * @var integer $
     */
    private $estado;


    /**
     * Set estado
     *
     * @param integer $estado
     * @return AlbaranCompraLinea
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
    
    public function getEstadoText()
    {
    	$yaml = new Parser(); try {	$value = $yaml->parse(file_get_contents(__DIR__ . '/../Resources/config/compras.yml'));
    	} catch (ParseException $e) {
    		printf("Unable to parse the YAML string: %s", $e->getMessage());
    	}
    	if ($this->estado) return $value['estados_albarancompralinea'][$this->estado];
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
     * @return AlbaranCompraLinea
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
}