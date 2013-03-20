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
    public function __toString()
    {
    	return $this->codigo." - ".$this->nombre;
    }
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $orden;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->orden = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add orden
     *
     * @param PB\ProduccionBundle\Entity\Orden $orden
     * @return Maquina
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
    private $orden2;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $orden3;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $orden4;


    /**
     * Add orden2
     *
     * @param PB\ProduccionBundle\Entity\Orden $orden2
     * @return Maquina
     */
    public function addOrden2(\PB\ProduccionBundle\Entity\Orden $orden2)
    {
        $this->orden2[] = $orden2;
    
        return $this;
    }

    /**
     * Remove orden2
     *
     * @param PB\ProduccionBundle\Entity\Orden $orden2
     */
    public function removeOrden2(\PB\ProduccionBundle\Entity\Orden $orden2)
    {
        $this->orden2->removeElement($orden2);
    }

    /**
     * Get orden2
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getOrden2()
    {
        return $this->orden2;
    }

    /**
     * Add orden3
     *
     * @param PB\ProduccionBundle\Entity\Orden $orden3
     * @return Maquina
     */
    public function addOrden3(\PB\ProduccionBundle\Entity\Orden $orden3)
    {
        $this->orden3[] = $orden3;
    
        return $this;
    }

    /**
     * Remove orden3
     *
     * @param PB\ProduccionBundle\Entity\Orden $orden3
     */
    public function removeOrden3(\PB\ProduccionBundle\Entity\Orden $orden3)
    {
        $this->orden3->removeElement($orden3);
    }

    /**
     * Get orden3
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getOrden3()
    {
        return $this->orden3;
    }

    /**
     * Add orden4
     *
     * @param PB\ProduccionBundle\Entity\Orden $orden4
     * @return Maquina
     */
    public function addOrden4(\PB\ProduccionBundle\Entity\Orden $orden4)
    {
        $this->orden4[] = $orden4;
    
        return $this;
    }

    /**
     * Remove orden4
     *
     * @param PB\ProduccionBundle\Entity\Orden $orden4
     */
    public function removeOrden4(\PB\ProduccionBundle\Entity\Orden $orden4)
    {
        $this->orden4->removeElement($orden4);
    }

    /**
     * Get orden4
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getOrden4()
    {
        return $this->orden4;
    }
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $extrusion;


    /**
     * Add extrusion
     *
     * @param PB\ProduccionBundle\Entity\Extrusion $extrusion
     * @return Maquina
     */
    public function addExtrusion(\PB\ProduccionBundle\Entity\Extrusion $extrusion)
    {
        $this->extrusion[] = $extrusion;
    
        return $this;
    }

    /**
     * Remove extrusion
     *
     * @param PB\ProduccionBundle\Entity\Extrusion $extrusion
     */
    public function removeExtrusion(\PB\ProduccionBundle\Entity\Extrusion $extrusion)
    {
        $this->extrusion->removeElement($extrusion);
    }

    /**
     * Get extrusion
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getExtrusion()
    {
        return $this->extrusion;
    }
}