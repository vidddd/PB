<?php

namespace PB\VentasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PB\VentasBundle\Entity\Albaran
 */
class Albaran
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var \DateTime $fecha
     */
    private $fecha;

    /**
     * @var \DateTime $fecha_entrega
     */
    private $fecha_entrega;

    /**
     * @var integer $tipo
     */
    private $tipo;


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
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Albaran
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
     * Set fecha_entrega
     *
     * @param \DateTime $fechaEntrega
     * @return Albaran
     */
    public function setFechaEntrega($fechaEntrega)
    {
        $this->fecha_entrega = $fechaEntrega;
    
        return $this;
    }

    /**
     * Get fecha_entrega
     *
     * @return \DateTime 
     */
    public function getFechaEntrega()
    {
        return $this->fecha_entrega;
    }

    /**
     * Set tipo
     *
     * @param integer $tipo
     * @return Albaran
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    
        return $this;
    }

    /**
     * Get tipo
     *
     * @return integer 
     */
    public function getTipo()
    {
        return $this->tipo;
    }
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $lineas;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->lineas = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add lineas
     *
     * @param PB\VentasBundle\Entity\AlbaranLinea $lineas
     * @return Albaran
     */
    public function addLinea(\PB\VentasBundle\Entity\AlbaranLinea $lineas)
    {
        $this->lineas[] = $lineas;
    
        return $this;
    }

    /**
     * Remove lineas
     *
     * @param PB\VentasBundle\Entity\AlbaranLinea $lineas
     */
    public function removeLinea(\PB\VentasBundle\Entity\AlbaranLinea $lineas)
    {
        $this->lineas->removeElement($lineas);
    }

    /**
     * Get lineas
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getLineas()
    {
        return $this->lineas;
    }
}