<?php

namespace PB\ProduccionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PB\ProduccionBundle\Entity\Maquina
 */
class Maquina
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $codigo
     */
    private $codigo;

    /**
     * @var string $nombre
     */
    private $nombre;

    /**
     * @var integer $tipo
     */
    private $tipo;

    /**
     * @var integer $capacidad_ciclo
     */
    private $capacidad_ciclo;


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
     * Set codigo
     *
     * @param string $codigo
     * @return Maquina
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    
        return $this;
    }

    /**
     * Get codigo
     *
     * @return string 
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Maquina
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
     * Set tipo
     *
     * @param integer $tipo
     * @return Maquina
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
     * Set capacidad_ciclo
     *
     * @param integer $capacidadCiclo
     * @return Maquina
     */
    public function setCapacidadCiclo($capacidadCiclo)
    {
        $this->capacidad_ciclo = $capacidadCiclo;
    
        return $this;
    }

    /**
     * Get capacidad_ciclo
     *
     * @return integer 
     */
    public function getCapacidadCiclo()
    {
        return $this->capacidad_ciclo;
    }
    /**
     * @var integer $tiempo_ciclo
     */
    private $tiempo_ciclo;

    /**
     * @var \DateTime $tiempo_antes
     */
    private $tiempo_antes;

    /**
     * @var \DateTime $tiempo_despues
     */
    private $tiempo_despues;

    /**
     * @var string $lifecycleCallbacks
     */
    private $lifecycleCallbacks;


    /**
     * Set tiempo_ciclo
     *
     * @param integer $tiempoCiclo
     * @return Maquina
     */
    public function setTiempoCiclo($tiempoCiclo)
    {
        $this->tiempo_ciclo = $tiempoCiclo;
    
        return $this;
    }

    /**
     * Get tiempo_ciclo
     *
     * @return integer 
     */
    public function getTiempoCiclo()
    {
        return $this->tiempo_ciclo;
    }

    /**
     * Set tiempo_antes
     *
     * @param \DateTime $tiempoAntes
     * @return Maquina
     */
    public function setTiempoAntes($tiempoAntes)
    {
        $this->tiempo_antes = $tiempoAntes;
    
        return $this;
    }

    /**
     * Get tiempo_antes
     *
     * @return \DateTime 
     */
    public function getTiempoAntes()
    {
        return $this->tiempo_antes;
    }

    /**
     * Set tiempo_despues
     *
     * @param \DateTime $tiempoDespues
     * @return Maquina
     */
    public function setTiempoDespues($tiempoDespues)
    {
        $this->tiempo_despues = $tiempoDespues;
    
        return $this;
    }

    /**
     * Get tiempo_despues
     *
     * @return \DateTime 
     */
    public function getTiempoDespues()
    {
        return $this->tiempo_despues;
    }

    /**
     * Set lifecycleCallbacks
     *
     * @param string $lifecycleCallbacks
     * @return Maquina
     */
    public function setLifecycleCallbacks($lifecycleCallbacks)
    {
        $this->lifecycleCallbacks = $lifecycleCallbacks;
    
        return $this;
    }

    /**
     * Get lifecycleCallbacks
     *
     * @return string 
     */
    public function getLifecycleCallbacks()
    {
        return $this->lifecycleCallbacks;
    }
    /**
     * @var string $observaciones
     */
    private $observaciones;


    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return Maquina
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
}