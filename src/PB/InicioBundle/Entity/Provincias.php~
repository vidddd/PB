<?php

namespace PB\InicioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PB\InicioBundle\Entity\Provincias
 */
class Provincias
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $codprovincia
     */
    private $codprovincia;

    /**
     * @var string $denprovincia
     */
    private $denprovincia;

    public function __toString()
    {
    	return $this->getDenprovincia();
    }

    /**
     * @var PB\ComprasBundle\Entity\Proveedor
     */
    private $provincia;


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
     * Set codprovincia
     *
     * @param string $codprovincia
     * @return Provincias
     */
    public function setCodprovincia($codprovincia)
    {
        $this->codprovincia = $codprovincia;
    
        return $this;
    }

    /**
     * Get codprovincia
     *
     * @return string 
     */
    public function getCodprovincia()
    {
        return $this->codprovincia;
    }

    /**
     * Set denprovincia
     *
     * @param string $denprovincia
     * @return Provincias
     */
    public function setDenprovincia($denprovincia)
    {
        $this->denprovincia = $denprovincia;
    
        return $this;
    }

    /**
     * Get denprovincia
     *
     * @return string 
     */
    public function getDenprovincia()
    {
        return $this->denprovincia;
    }

    /**
     * Set provincia
     *
     * @param PB\ComprasBundle\Entity\Proveedor $provincia
     * @return Provincias
     */
    public function setProvincia(\PB\ComprasBundle\Entity\Proveedor $provincia = null)
    {
        $this->provincia = $provincia;
    
        return $this;
    }

    /**
     * Get provincia
     *
     * @return PB\ComprasBundle\Entity\Proveedor 
     */
    public function getProvincia()
    {
        return $this->provincia;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->provincia = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add provincia
     *
     * @param PB\ComprasBundle\Entity\Proveedor $provincia
     * @return Provincias
     */
    public function addProvincia(\PB\ComprasBundle\Entity\Proveedor $provincia)
    {
        $this->provincia[] = $provincia;
    
        return $this;
    }

    /**
     * Remove provincia
     *
     * @param PB\ComprasBundle\Entity\Proveedor $provincia
     */
    public function removeProvincia(\PB\ComprasBundle\Entity\Proveedor $provincia)
    {
        $this->provincia->removeElement($provincia);
    }
    /**
     * @var PB\VentasBundle\Entity\cliente
     */
    private $provincia2;


    /**
     * Set provincia2
     *
     * @param PB\VentasBundle\Entity\cliente $provincia2
     * @return Provincias
     */
    public function setProvincia2(\PB\VentasBundle\Entity\cliente $provincia2 = null)
    {
        $this->provincia2 = $provincia2;
    
        return $this;
    }

    /**
     * Get provincia2
     *
     * @return PB\VentasBundle\Entity\cliente 
     */
    public function getProvincia2()
    {
        return $this->provincia2;
    }
}