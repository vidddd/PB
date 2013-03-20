<?php

namespace PB\ProduccionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PB\ProduccionBundle\Entity\Extrusion
 */
class Extrusion
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var integer $ancho
     */
    private $ancho;

    /**
     * @var integer $galga
     */
    private $galga;


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
     * Set ancho
     *
     * @param integer $ancho
     * @return Extrusion
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
     * Set galga
     *
     * @param integer $galga
     * @return Extrusion
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
     * @var \DateTime $fecha
     */
    private $fecha;

    /**
     * @var integer $plegado
     */
    private $plegado;

    /**
     * @var integer $metros
     */
    private $metros;

    /**
     * @var integer $bobinas
     */
    private $bobinas;

    /**
     * @var integer $tratado
     */
    private $tratado;

    /**
     * @var float $pesoneto
     */
    private $pesoneto;

    /**
     * @var float $pesoteorico
     */
    private $pesoteorico;

    /**
     * @var PB\ProduccionBundle\Entity\Maquina
     */
    private $maquina;

    /**
     * @var PB\ProduccionBundle\Entity\Orden
     */
    private $orden;


    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Extrusion
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
     * Set plegado
     *
     * @param integer $plegado
     * @return Extrusion
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
     * Set metros
     *
     * @param integer $metros
     * @return Extrusion
     */
    public function setMetros($metros)
    {
        $this->metros = $metros;
    
        return $this;
    }

    /**
     * Get metros
     *
     * @return integer 
     */
    public function getMetros()
    {
        return $this->metros;
    }

    /**
     * Set bobinas
     *
     * @param integer $bobinas
     * @return Extrusion
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
     * Set tratado
     *
     * @param integer $tratado
     * @return Extrusion
     */
    public function setTratado($tratado)
    {
        $this->tratado = $tratado;
    
        return $this;
    }

    /**
     * Get tratado
     *
     * @return integer 
     */
    public function getTratado()
    {
        return $this->tratado;
    }

    /**
     * Set pesoneto
     *
     * @param float $pesoneto
     * @return Extrusion
     */
    public function setPesoneto($pesoneto)
    {
        $this->pesoneto = $pesoneto;
    
        return $this;
    }

    /**
     * Get pesoneto
     *
     * @return float 
     */
    public function getPesoneto()
    {
        return $this->pesoneto;
    }

    /**
     * Set pesoteorico
     *
     * @param float $pesoteorico
     * @return Extrusion
     */
    public function setPesoteorico($pesoteorico)
    {
        $this->pesoteorico = $pesoteorico;
    
        return $this;
    }

    /**
     * Get pesoteorico
     *
     * @return float 
     */
    public function getPesoteorico()
    {
        return $this->pesoteorico;
    }

    /**
     * Set maquina
     *
     * @param PB\ProduccionBundle\Entity\Maquina $maquina
     * @return Extrusion
     */
    public function setMaquina(\PB\ProduccionBundle\Entity\Maquina $maquina = null)
    {
        $this->maquina = $maquina;
    
        return $this;
    }

    /**
     * Get maquina
     *
     * @return PB\ProduccionBundle\Entity\Maquina 
     */
    public function getMaquina()
    {
        return $this->maquina;
    }

    /**
     * Set orden
     *
     * @param PB\ProduccionBundle\Entity\Orden $orden
     * @return Extrusion
     */
    public function setOrden(\PB\ProduccionBundle\Entity\Orden $orden = null)
    {
        $this->orden = $orden;
    
        return $this;
    }

    /**
     * Get orden
     *
     * @return PB\ProduccionBundle\Entity\Orden 
     */
    public function getOrden()
    {
        return $this->orden;
    }
}