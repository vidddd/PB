<?php

namespace PB\GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * PB\GeneralBundle\Entity\FormaPago
 */
class FormaPago
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
     * @var string $descripcion
     */
    private $descripcion;
    
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
    	$metadata->addPropertyConstraint('nombre', new NotBlank());
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
     * Set nombre
     *
     * @param string $nombre
     * @return FormaPago
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return FormaPago
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
     * @var PB\ComprasBundle\Entity\Proveedor
     */
    private $formapago_proveedor;


    /**
     * Set formapago_proveedor
     *
     * @param PB\ComprasBundle\Entity\Proveedor $formapagoProveedor
     * @return FormaPago
     */
    public function setFormapagoProveedor(\PB\ComprasBundle\Entity\Proveedor $formapagoProveedor = null)
    {
        $this->formapago_proveedor = $formapagoProveedor;
    
        return $this;
    }

    /**
     * Get formapago_proveedor
     *
     * @return PB\ComprasBundle\Entity\Proveedor 
     */
    public function getFormapagoProveedor()
    {
        return $this->formapago_proveedor;
    }
    /**
     * @var PB\ComprasBundle\Entity\Proveedor
     */
    private $formapago;


    /**
     * Set formapago
     *
     * @param PB\ComprasBundle\Entity\Proveedor $formapago
     * @return FormaPago
     */
    public function setFormapago(\PB\ComprasBundle\Entity\Proveedor $formapago = null)
    {
        $this->formapago = $formapago;
    
        return $this;
    }

    /**
     * Get formapago
     *
     * @return PB\ComprasBundle\Entity\Proveedor 
     */
    public function getFormapago()
    {
        return $this->formapago;
    }
    public function __toString()
    {
    	return $this->nombre;
    }
    /**
     * @var PB\ComprasBundle\Entity\Proveedor
     */
    private $formapagos;


    /**
     * Set formapagos
     *
     * @param PB\ComprasBundle\Entity\Proveedor $formapagos
     * @return FormaPago
     */
    public function setFormapagos(\PB\ComprasBundle\Entity\Proveedor $formapagos = null)
    {
        $this->formapagos = $formapagos;
    
        return $this;
    }

    /**
     * Get formapagos
     *
     * @return PB\ComprasBundle\Entity\Proveedor 
     */
    public function getFormapagos()
    {
        return $this->formapagos;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
      //  $this->formapagos = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add formapagos
     *
     * @param PB\ComprasBundle\Entity\Proveedor $formapagos
     * @return FormaPago
     */
    public function addFormapago(\PB\ComprasBundle\Entity\Proveedor $formapagos)
    {
        $this->formapagos[] = $formapagos;
    
        return $this;
    }

    /**
     * Remove formapagos
     *
     * @param PB\ComprasBundle\Entity\Proveedor $formapagos
     */
    public function removeFormapago(\PB\ComprasBundle\Entity\Proveedor $formapagos)
    {
        $this->formapagos->removeElement($formapagos);
    }
    /**
     * @var PB\VentasBundle\Entity\Cliente
     */
    private $formapagos2;


    /**
     * Set formapagos2
     *
     * @param PB\VentasBundle\Entity\Cliente $formapagos2
     * @return FormaPago
     */
    public function setFormapagos2(\PB\VentasBundle\Entity\Cliente $formapagos2 = null)
    {
        $this->formapagos2 = $formapagos2;
    
        return $this;
    }

    /**
     * Get formapagos2
     *
     * @return PB\VentasBundle\Entity\Cliente 
     */
    public function getFormapagos2()
    {
        return $this->formapagos2;
    }

    /**
     * Add formapagos2
     *
     * @param PB\VentasBundle\Entity\Cliente $formapagos2
     * @return FormaPago
     */
    public function addFormapagos2(\PB\VentasBundle\Entity\Cliente $formapagos2)
    {
        $this->formapagos2[] = $formapagos2;
    
        return $this;
    }

    /**
     * Remove formapagos2
     *
     * @param PB\VentasBundle\Entity\Cliente $formapagos2
     */
    public function removeFormapagos2(\PB\VentasBundle\Entity\Cliente $formapagos2)
    {
        $this->formapagos2->removeElement($formapagos2);
    }
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $formapagos3;


    /**
     * Add formapagos3
     *
     * @param PB\VentasBundle\Entity\Factura $formapagos3
     * @return FormaPago
     */
    public function addFormapagos3(\PB\VentasBundle\Entity\Factura $formapagos3)
    {
        $this->formapagos3[] = $formapagos3;
    
        return $this;
    }

    /**
     * Remove formapagos3
     *
     * @param PB\VentasBundle\Entity\Factura $formapagos3
     */
    public function removeFormapagos3(\PB\VentasBundle\Entity\Factura $formapagos3)
    {
        $this->formapagos3->removeElement($formapagos3);
    }

    /**
     * Get formapagos3
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getFormapagos3()
    {
        return $this->formapagos3;
    }
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $formapagos4;


    /**
     * Add formapagos4
     *
     * @param PB\VentasBundle\Entity\FacturaB $formapagos4
     * @return FormaPago
     */
    public function addFormapagos4(\PB\VentasBundle\Entity\FacturaB $formapagos4)
    {
        $this->formapagos4[] = $formapagos4;
    
        return $this;
    }

    /**
     * Remove formapagos4
     *
     * @param PB\VentasBundle\Entity\FacturaB $formapagos4
     */
    public function removeFormapagos4(\PB\VentasBundle\Entity\FacturaB $formapagos4)
    {
        $this->formapagos4->removeElement($formapagos4);
    }

    /**
     * Get formapagos4
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getFormapagos4()
    {
        return $this->formapagos4;
    }
    /**
     * @var integer $dias
     */
    private $dias;


    /**
     * Set dias
     *
     * @param integer $dias
     * @return FormaPago
     */
    public function setDias($dias)
    {
        $this->dias = $dias;
    
        return $this;
    }

    /**
     * Get dias
     *
     * @return integer 
     */
    public function getDias()
    {
        return $this->dias;
    }
}