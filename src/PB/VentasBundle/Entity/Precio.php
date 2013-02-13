<?php

namespace PB\VentasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PB\VentasBundle\Entity\Precio
 */
class Precio
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
     * @var float $cam15
     */
    private $cam15;

    /**
     * @var float $cam30
     */
    private $cam30;

    /**
     * @var float $cam50
     */
    private $cam50;

    /**
     * @var float $cam100
     */
    private $cam100;

    /**
     * @var float $cam100mas
     */
    private $cam100mas;

    /**
     * @var float $asa20
     */
    private $asa20;

    /**
     * @var float $asa30
     */
    private $asa30;

    /**
     * @var float $asa35
     */
    private $asa35;

    /**
     * @var float $especiales10
     */
    private $especiales10;

    /**
     * @var float $especiales15
     */
    private $especiales15;

    /**
     * @var float $espemenos150s
     */
    private $espemenos150s;

    /**
     * @var float $espemenos150i
     */
    private $espemenos150i;

    /**
     * @var float $bobmenos150s
     */
    private $bobmenos150s;

    /**
     * @var float $bobmenos150i
     */
    private $bobmenos150i;

    /**
     * @var float $espemas150s
     */
    private $espemas150s;

    /**
     * @var float $espemas150i
     */
    private $espemas150i;

    /**
     * @var float $bobmas150s
     */
    private $bobmas150s;

    /**
     * @var float $bobmas150i
     */
    private $bobmas150i;

    /**
     * @var float $espemas500s
     */
    private $espemas500s;

    /**
     * @var float $espemas500i
     */
    private $espemas500i;

    /**
     * @var float $bobmas500s
     */
    private $bobmas500s;

    /**
     * @var float $bobmas500i
     */
    private $bobmas500i;

    /**
     * @var float $bolleria
     */
    private $bolleria;

    /**
     * @var float $ppbob
     */
    private $ppbob;

    /**
     * @var float $ppbolsasin
     */
    private $ppbolsasin;

    /**
     * @var float $ppbolsapeque
     */
    private $ppbolsapeque;

    /**
     * @var float $ppbolsagrande
     */
    private $ppbolsagrande;

    /**
     * @var float $ppmbob
     */
    private $ppmbob;

    /**
     * @var float $ppmbobi
     */
    private $ppmbobi;

    /**
     * @var float $ppmsin
     */
    private $ppmsin;

    /**
     * @var float $ppmim
     */
    private $ppmim;

    /**
     * @var float $laminaim
     */
    private $laminaim;

    /**
     * @var float $laminasin
     */
    private $laminasin;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $precioLineas;

    /**
     * @var PB\VentasBundle\Entity\Cliente
     */
    private $cliente;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->precioLineas = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Precio
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
     * Set cam15
     *
     * @param float $cam15
     * @return Precio
     */
    public function setCam15($cam15)
    {
        $this->cam15 = $cam15;
    
        return $this;
    }

    /**
     * Get cam15
     *
     * @return float 
     */
    public function getCam15()
    {
        return $this->cam15;
    }

    /**
     * Set cam30
     *
     * @param float $cam30
     * @return Precio
     */
    public function setCam30($cam30)
    {
        $this->cam30 = $cam30;
    
        return $this;
    }

    /**
     * Get cam30
     *
     * @return float 
     */
    public function getCam30()
    {
        return $this->cam30;
    }

    /**
     * Set cam50
     *
     * @param float $cam50
     * @return Precio
     */
    public function setCam50($cam50)
    {
        $this->cam50 = $cam50;
    
        return $this;
    }

    /**
     * Get cam50
     *
     * @return float 
     */
    public function getCam50()
    {
        return $this->cam50;
    }

    /**
     * Set cam100
     *
     * @param float $cam100
     * @return Precio
     */
    public function setCam100($cam100)
    {
        $this->cam100 = $cam100;
    
        return $this;
    }

    /**
     * Get cam100
     *
     * @return float 
     */
    public function getCam100()
    {
        return $this->cam100;
    }

    /**
     * Set cam100mas
     *
     * @param float $cam100mas
     * @return Precio
     */
    public function setCam100mas($cam100mas)
    {
        $this->cam100mas = $cam100mas;
    
        return $this;
    }

    /**
     * Get cam100mas
     *
     * @return float 
     */
    public function getCam100mas()
    {
        return $this->cam100mas;
    }

    /**
     * Set asa20
     *
     * @param float $asa20
     * @return Precio
     */
    public function setAsa20($asa20)
    {
        $this->asa20 = $asa20;
    
        return $this;
    }

    /**
     * Get asa20
     *
     * @return float 
     */
    public function getAsa20()
    {
        return $this->asa20;
    }

    /**
     * Set asa30
     *
     * @param float $asa30
     * @return Precio
     */
    public function setAsa30($asa30)
    {
        $this->asa30 = $asa30;
    
        return $this;
    }

    /**
     * Get asa30
     *
     * @return float 
     */
    public function getAsa30()
    {
        return $this->asa30;
    }

    /**
     * Set asa35
     *
     * @param float $asa35
     * @return Precio
     */
    public function setAsa35($asa35)
    {
        $this->asa35 = $asa35;
    
        return $this;
    }

    /**
     * Get asa35
     *
     * @return float 
     */
    public function getAsa35()
    {
        return $this->asa35;
    }

    /**
     * Set especiales10
     *
     * @param float $especiales10
     * @return Precio
     */
    public function setEspeciales10($especiales10)
    {
        $this->especiales10 = $especiales10;
    
        return $this;
    }

    /**
     * Get especiales10
     *
     * @return float 
     */
    public function getEspeciales10()
    {
        return $this->especiales10;
    }

    /**
     * Set especiales15
     *
     * @param float $especiales15
     * @return Precio
     */
    public function setEspeciales15($especiales15)
    {
        $this->especiales15 = $especiales15;
    
        return $this;
    }

    /**
     * Get especiales15
     *
     * @return float 
     */
    public function getEspeciales15()
    {
        return $this->especiales15;
    }

    /**
     * Set espemenos150s
     *
     * @param float $espemenos150s
     * @return Precio
     */
    public function setEspemenos150s($espemenos150s)
    {
        $this->espemenos150s = $espemenos150s;
    
        return $this;
    }

    /**
     * Get espemenos150s
     *
     * @return float 
     */
    public function getEspemenos150s()
    {
        return $this->espemenos150s;
    }

    /**
     * Set espemenos150i
     *
     * @param float $espemenos150i
     * @return Precio
     */
    public function setEspemenos150i($espemenos150i)
    {
        $this->espemenos150i = $espemenos150i;
    
        return $this;
    }

    /**
     * Get espemenos150i
     *
     * @return float 
     */
    public function getEspemenos150i()
    {
        return $this->espemenos150i;
    }

    /**
     * Set bobmenos150s
     *
     * @param float $bobmenos150s
     * @return Precio
     */
    public function setBobmenos150s($bobmenos150s)
    {
        $this->bobmenos150s = $bobmenos150s;
    
        return $this;
    }

    /**
     * Get bobmenos150s
     *
     * @return float 
     */
    public function getBobmenos150s()
    {
        return $this->bobmenos150s;
    }

    /**
     * Set bobmenos150i
     *
     * @param float $bobmenos150i
     * @return Precio
     */
    public function setBobmenos150i($bobmenos150i)
    {
        $this->bobmenos150i = $bobmenos150i;
    
        return $this;
    }

    /**
     * Get bobmenos150i
     *
     * @return float 
     */
    public function getBobmenos150i()
    {
        return $this->bobmenos150i;
    }

    /**
     * Set espemas150s
     *
     * @param float $espemas150s
     * @return Precio
     */
    public function setEspemas150s($espemas150s)
    {
        $this->espemas150s = $espemas150s;
    
        return $this;
    }

    /**
     * Get espemas150s
     *
     * @return float 
     */
    public function getEspemas150s()
    {
        return $this->espemas150s;
    }

    /**
     * Set espemas150i
     *
     * @param float $espemas150i
     * @return Precio
     */
    public function setEspemas150i($espemas150i)
    {
        $this->espemas150i = $espemas150i;
    
        return $this;
    }

    /**
     * Get espemas150i
     *
     * @return float 
     */
    public function getEspemas150i()
    {
        return $this->espemas150i;
    }

    /**
     * Set bobmas150s
     *
     * @param float $bobmas150s
     * @return Precio
     */
    public function setBobmas150s($bobmas150s)
    {
        $this->bobmas150s = $bobmas150s;
    
        return $this;
    }

    /**
     * Get bobmas150s
     *
     * @return float 
     */
    public function getBobmas150s()
    {
        return $this->bobmas150s;
    }

    /**
     * Set bobmas150i
     *
     * @param float $bobmas150i
     * @return Precio
     */
    public function setBobmas150i($bobmas150i)
    {
        $this->bobmas150i = $bobmas150i;
    
        return $this;
    }

    /**
     * Get bobmas150i
     *
     * @return float 
     */
    public function getBobmas150i()
    {
        return $this->bobmas150i;
    }

    /**
     * Set espemas500s
     *
     * @param float $espemas500s
     * @return Precio
     */
    public function setEspemas500s($espemas500s)
    {
        $this->espemas500s = $espemas500s;
    
        return $this;
    }

    /**
     * Get espemas500s
     *
     * @return float 
     */
    public function getEspemas500s()
    {
        return $this->espemas500s;
    }

    /**
     * Set espemas500i
     *
     * @param float $espemas500i
     * @return Precio
     */
    public function setEspemas500i($espemas500i)
    {
        $this->espemas500i = $espemas500i;
    
        return $this;
    }

    /**
     * Get espemas500i
     *
     * @return float 
     */
    public function getEspemas500i()
    {
        return $this->espemas500i;
    }

    /**
     * Set bobmas500s
     *
     * @param float $bobmas500s
     * @return Precio
     */
    public function setBobmas500s($bobmas500s)
    {
        $this->bobmas500s = $bobmas500s;
    
        return $this;
    }

    /**
     * Get bobmas500s
     *
     * @return float 
     */
    public function getBobmas500s()
    {
        return $this->bobmas500s;
    }

    /**
     * Set bobmas500i
     *
     * @param float $bobmas500i
     * @return Precio
     */
    public function setBobmas500i($bobmas500i)
    {
        $this->bobmas500i = $bobmas500i;
    
        return $this;
    }

    /**
     * Get bobmas500i
     *
     * @return float 
     */
    public function getBobmas500i()
    {
        return $this->bobmas500i;
    }

    /**
     * Set bolleria
     *
     * @param float $bolleria
     * @return Precio
     */
    public function setBolleria($bolleria)
    {
        $this->bolleria = $bolleria;
    
        return $this;
    }

    /**
     * Get bolleria
     *
     * @return float 
     */
    public function getBolleria()
    {
        return $this->bolleria;
    }

    /**
     * Set ppbob
     *
     * @param float $ppbob
     * @return Precio
     */
    public function setPpbob($ppbob)
    {
        $this->ppbob = $ppbob;
    
        return $this;
    }

    /**
     * Get ppbob
     *
     * @return float 
     */
    public function getPpbob()
    {
        return $this->ppbob;
    }

    /**
     * Set ppbolsasin
     *
     * @param float $ppbolsasin
     * @return Precio
     */
    public function setPpbolsasin($ppbolsasin)
    {
        $this->ppbolsasin = $ppbolsasin;
    
        return $this;
    }

    /**
     * Get ppbolsasin
     *
     * @return float 
     */
    public function getPpbolsasin()
    {
        return $this->ppbolsasin;
    }

    /**
     * Set ppbolsapeque
     *
     * @param float $ppbolsapeque
     * @return Precio
     */
    public function setPpbolsapeque($ppbolsapeque)
    {
        $this->ppbolsapeque = $ppbolsapeque;
    
        return $this;
    }

    /**
     * Get ppbolsapeque
     *
     * @return float 
     */
    public function getPpbolsapeque()
    {
        return $this->ppbolsapeque;
    }

    /**
     * Set ppbolsagrande
     *
     * @param float $ppbolsagrande
     * @return Precio
     */
    public function setPpbolsagrande($ppbolsagrande)
    {
        $this->ppbolsagrande = $ppbolsagrande;
    
        return $this;
    }

    /**
     * Get ppbolsagrande
     *
     * @return float 
     */
    public function getPpbolsagrande()
    {
        return $this->ppbolsagrande;
    }

    /**
     * Set ppmbob
     *
     * @param float $ppmbob
     * @return Precio
     */
    public function setPpmbob($ppmbob)
    {
        $this->ppmbob = $ppmbob;
    
        return $this;
    }

    /**
     * Get ppmbob
     *
     * @return float 
     */
    public function getPpmbob()
    {
        return $this->ppmbob;
    }

    /**
     * Set ppmbobi
     *
     * @param float $ppmbobi
     * @return Precio
     */
    public function setPpmbobi($ppmbobi)
    {
        $this->ppmbobi = $ppmbobi;
    
        return $this;
    }

    /**
     * Get ppmbobi
     *
     * @return float 
     */
    public function getPpmbobi()
    {
        return $this->ppmbobi;
    }

    /**
     * Set ppmsin
     *
     * @param float $ppmsin
     * @return Precio
     */
    public function setPpmsin($ppmsin)
    {
        $this->ppmsin = $ppmsin;
    
        return $this;
    }

    /**
     * Get ppmsin
     *
     * @return float 
     */
    public function getPpmsin()
    {
        return $this->ppmsin;
    }

    /**
     * Set ppmim
     *
     * @param float $ppmim
     * @return Precio
     */
    public function setPpmim($ppmim)
    {
        $this->ppmim = $ppmim;
    
        return $this;
    }

    /**
     * Get ppmim
     *
     * @return float 
     */
    public function getPpmim()
    {
        return $this->ppmim;
    }

    /**
     * Set laminaim
     *
     * @param float $laminaim
     * @return Precio
     */
    public function setLaminaim($laminaim)
    {
        $this->laminaim = $laminaim;
    
        return $this;
    }

    /**
     * Get laminaim
     *
     * @return float 
     */
    public function getLaminaim()
    {
        return $this->laminaim;
    }

    /**
     * Set laminasin
     *
     * @param float $laminasin
     * @return Precio
     */
    public function setLaminasin($laminasin)
    {
        $this->laminasin = $laminasin;
    
        return $this;
    }

    /**
     * Get laminasin
     *
     * @return float 
     */
    public function getLaminasin()
    {
        return $this->laminasin;
    }

    /**
     * Add precioLineas
     *
     * @param PB\VentasBundle\Entity\PrecioLinea $precioLineas
     * @return Precio
     */
    public function addPrecioLinea(\PB\VentasBundle\Entity\PrecioLinea $precioLineas)
    {
        $this->precioLineas[] = $precioLineas;
    
        return $this;
    }

    /**
     * Remove precioLineas
     *
     * @param PB\VentasBundle\Entity\PrecioLinea $precioLineas
     */
    public function removePrecioLinea(\PB\VentasBundle\Entity\PrecioLinea $precioLineas)
    {
        $this->precioLineas->removeElement($precioLineas);
    }

    /**
     * Get precioLineas
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPrecioLineas()
    {
        return $this->precioLineas;
    }

    /**
     * Set cliente
     *
     * @param PB\VentasBundle\Entity\Cliente $cliente
     * @return Precio
     */
    public function setCliente(\PB\VentasBundle\Entity\Cliente $cliente = null)
    {
        $this->cliente = $cliente;
    
        return $this;
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
    
    public function setPorcentaje($por){
  
    	$porcen = $por / 100;
    	 
    	$this->cam15 = number_format($this->cam15 + $this->cam15 * $porcen,2,".",".");
    	$this->cam30 = number_format($this->cam30 + $this->cam30 * $porcen,2,".",".");
    	$this->cam50 = number_format($this->cam50 + $this->cam50 * $porcen,2,".",".");
    	$this->cam100 = number_format($this->cam100 + $this->cam100 * $porcen,2,".",".");
    	$this->cam100mas = number_format($this->cam100mas + $this->cam100mas * $porcen,2,".",".");
    	$this->asa20 = number_format($this->asa20 + $this->asa20 * $porcen,2,".",".");
    	$this->asa30 = number_format($this->asa30 + $this->asa30 * $porcen,2,".",".");
    	$this->asa35 = number_format($this->asa35 + $this->asa35 * $porcen,2,".",".");
    	$this->especiales10 = number_format($this->especiales10 + $this->especiales10 * $porcen,2,".",".");
    	$this->especiales15 = number_format($this->especiales15 + $this->especiales15 * $porcen,2,".",".");
    	$this->espemenos150s = number_format($this->espemenos150s + $this->espemenos150s * $porcen,2,".",".");
    	$this->espemenos150i = number_format($this->espemenos150i + $this->espemenos150i * $porcen,2,".",".");
    	$this->bobmenos150s = number_format($this->bobmenos150s + $this->bobmenos150s * $porcen,2,".",".");
    	$this->bobmenos150i = number_format($this->bobmenos150i + $this->bobmenos150i * $porcen,2,".",".");
    	$this->espemas150s = number_format($this->espemas150s + $this->espemas150s * $porcen,2,".",".");
    	$this->espemas150i = number_format($this->espemas150i + $this->espemas150i * $porcen,2,".",".");
    	$this->bobmas150s = number_format($this->bobmas150s + $this->bobmas150s * $porcen,2,".",".");
    	$this->bobmas150i = number_format($this->bobmas150i + $this->bobmas150i * $porcen,2,".",".");
    	$this->espemas500s = number_format($this->espemas500s + $this->espemas500s * $porcen,2,".",".");
    	$this->espemas500i = number_format($this->espemas500i + $this->espemas500i * $porcen,2,".",".");
    	$this->bobmas500s = number_format($this->bobmas500s + $this->bobmas500s * $porcen,2,".",".");
    	$this->bobmas500i = number_format($this->bobmas500i + $this->bobmas500i * $porcen,2,".",".");
    	$this->bolleria = number_format($this->bolleria + $this->bolleria * $porcen,2,".",".");
    	$this->ppbob = number_format($this->ppbob + $this->ppbob * $porcen,2,".",".");
    	$this->ppbolsasin = number_format($this->ppbolsasin + $this->ppbolsasin * $porcen,2,".",".");
    	$this->ppbolsapeque = number_format($this->ppbolsapeque + $this->ppbolsapeque * $porcen,2,".",".");
    	$this->ppbolsagrande = number_format($this->ppbolsagrande + $this->ppbolsagrande * $porcen,2,".",".");
    	$this->ppmbobi = number_format($this->ppmbobi + $this->ppmbobi * $porcen,2,".",".");
    	$this->ppmbob = number_format($this->ppmbob + $this->ppmbob * $porcen,2,".",".");
    	$this->ppmim = number_format($this->ppmim + $this->ppmim * $porcen,2,".",".");
    	$this->ppmsin = number_format($this->ppmsin + $this->ppmsin * $porcen,2,".",".");
    	$this->laminaim = number_format($this->laminaim + $this->laminaim * $porcen,2,".",".");
    	$this->laminasin = number_format($this->laminasin + $this->laminasin * $porcen,2,".",".");
    
    	foreach($this->precioLineas as $key){
    		$precio = $key->getPrecio();
    		$key->setPrecio(number_format($precio + $precio * $porcen,2,".","."));
    	}
    	 
    }
     
    public function setPorcentajemenos($por){
    	$porcen = $por / 100;
    	$this->cam15 = number_format($this->cam15 - $this->cam15 * $porcen,2,".",".");
    	$this->cam30 = number_format($this->cam30 - $this->cam30 * $porcen,2,".",".");
    	$this->cam50 = number_format($this->cam50 - $this->cam50 * $porcen,2,".",".");
    	$this->cam100 = number_format($this->cam100 - $this->cam100 * $porcen,2,".",".");
    	$this->cam100mas = number_format($this->cam100mas - $this->cam100mas * $porcen,2,".",".");
    	$this->asa20 = number_format($this->asa20 - $this->asa20 * $porcen,2,".",".");
    	$this->asa30 = number_format($this->asa30 - $this->asa30 * $porcen,2,".",".");
    	$this->asa35 = number_format($this->asa35 - $this->asa35 * $porcen,2,".",".");
    	$this->especiales10 = number_format($this->especiales10 - $this->especiales10 * $porcen,2,".",".");
    	$this->especiales15 = number_format($this->especiales15 - $this->especiales15 * $porcen,2,".",".");
    	$this->espemenos150s = number_format($this->espemenos150s - $this->espemenos150s * $porcen,2,".",".");
    	$this->espemenos150i = number_format($this->espemenos150i - $this->espemenos150i * $porcen,2,".",".");
    	$this->bobmenos150s = number_format($this->bobmenos150s - $this->bobmenos150s * $porcen,2,".",".");
    	$this->bobmenos150i = number_format($this->bobmenos150i - $this->bobmenos150i * $porcen,2,".",".");
    	$this->espemas150s = number_format($this->espemas150s - $this->espemas150s * $porcen,2,".",".");
    	$this->espemas150i = number_format($this->espemas150i - $this->espemas150i * $porcen,2,".",".");
    	$this->bobmas150s = number_format($this->bobmas150s - $this->bobmas150s * $porcen,2,".",".");
    	$this->bobmas150i = number_format($this->bobmas150i - $this->bobmas150i * $porcen,2,".",".");
    	$this->espemas500s = number_format($this->espemas500s - $this->espemas500s * $porcen,2,".",".");
    	$this->espemas500i = number_format($this->espemas500i - $this->espemas500i * $porcen,2,".",".");
    	$this->bobmas500s = number_format($this->bobmas500s - $this->bobmas500s * $porcen,2,".",".");
    	$this->bobmas500i = number_format($this->bobmas500i - $this->bobmas500i * $porcen,2,".",".");
    	$this->bolleria = number_format($this->bolleria - $this->bolleria * $porcen,2,".",".");
    	$this->ppbob = number_format($this->ppbob - $this->ppbob * $porcen,2,".",".");
    	$this->ppbolsasin = number_format($this->ppbolsasin - $this->ppbolsasin * $porcen,2,".",".");
    	$this->ppbolsapeque = number_format($this->ppbolsapeque - $this->ppbolsapeque * $porcen,2,".",".");
    	$this->ppbolsagrande = number_format($this->ppbolsagrande - $this->ppbolsagrande * $porcen,2,".",".");
    	$this->ppmbobi = number_format($this->ppmbobi - $this->ppmbobi * $porcen,2,".",".");
    	$this->ppmbob = number_format($this->ppmbob - $this->ppmbob * $porcen,2,".",".");
    	$this->ppmim = number_format($this->ppmim - $this->ppmim * $porcen,2,".",".");
    	$this->ppmsin = number_format($this->ppmsin - $this->ppmsin * $porcen,2,".",".");
    	$this->laminaim = number_format($this->laminaim - $this->laminaim * $porcen,2,".",".");
    	$this->laminasin = number_format($this->laminasin - $this->laminasin * $porcen,2,".",".");
    
    	foreach($this->precioLineas as $key){
    		$precio = $key->getPrecio();
    		$key->setPrecio(number_format($precio - $precio * $porcen,2,".","."));
    	}
    }
}