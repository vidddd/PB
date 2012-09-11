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
     */
    public function setCodprovincia($codprovincia)
    {
        $this->codprovincia = $codprovincia;
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
     */
    public function setDenprovincia($denprovincia)
    {
        $this->denprovincia = $denprovincia;
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
     * @var PB\VentasBundle\Entity\Cliente
     */
    private $cliente;


    /**
     * Set cliente
     *
     * @param PB\VentasBundle\Entity\Cliente $cliente
     */
    public function setCliente(\PB\VentasBundle\Entity\Cliente $cliente)
    {
        $this->cliente = $cliente;
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
     * @var PB\VentasBundle\Entity\Cliente
     */
    private $clientes;


    /**
     * Set clientes
     *
     * @param PB\VentasBundle\Entity\Cliente $clientes
     */
    public function setClientes(\PB\VentasBundle\Entity\Cliente $clientes)
    {
        $this->clientes = $clientes;
    }

    /**
     * Get clientes
     *
     * @return PB\VentasBundle\Entity\Cliente 
     */
    public function getClientes()
    {
        return $this->clientes;
    }
}