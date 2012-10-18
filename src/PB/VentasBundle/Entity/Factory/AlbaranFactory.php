<?php

namespace PB\VentasBundle\Entity\Factory;

use
    Symfony\Component\Validator\ExecutionContext,
    Symfony\Component\Validator\Constraints as Assert,
    PB\VentasBundle\Entity\Albaran,
    PB\Ventas\Entity\AlbaranLinea
;

/**
 * @Assert\Callback(methods={"isValidCustomer"})
 */
class AlbaranFactory
{
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
     * 
     */
    private $items = array();

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;
    
    
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
     * @param \Doctrine\ORM\EntityManager $em
     */
    public function __construct($em)
    {
        $this->em = $em;
        $this->lineas = new \Doctrine\Common\Collections\ArrayCollection();
    }
    /**
     * @return \PB\VentasBundle\Entity\Albaran
     */
    public function make()
    {
    	$albaran = new Albaran();
    	//$order->setCustomer($this->customer);
    	var_dump($this->lineas);
    	//$albaran->setFecha($this->fecha);
    	//$albaran->setFechaEntrega($this->fecha_entrega);
    	$albaran->setTipo($this->tipo);
    	foreach ($this->lineas as $item) {
    		$albaran->addLinea($item);
    	}
    
    	return $albaran;
    }
    public function getLineas()
    {
        return $this->lineas;
    }

    public function setLineas($lineas)
    {
        $this->lineas = $lineas;
    }

    /**
     * @param  ExecutionContext $context
     * @return bool
     */
    
    public function isValidCustomer(ExecutionContext $context)
    {
        // https://gist.github.com/888267
		/*
        if (true === $this->known_customer) {

            $this->customer = $this->em
                ->getRepository('AcmePizzaBundle:Customer')
                ->findOneBy(array(
                    'phone' => $this->known_phone,
                ))
            ;

            if (false === ($this->customer instanceof Customer)) {
                $property_path = $context->getPropertyPath() . '.known_phone';

                $context->setPropertyPath($property_path);
                $context->addViolation('Phone number is not registered', array(), null);
            }

        } else {

            
            //$context->setGroup('MyTest');
            //var_dump($context->getGroup());
            
            $group = $context->getGroup();
            $group = 'Customer';

            $context->getGraphWalker()->walkReference(
                $this->customer,
                $group,
                $context->getPropertyPath() . ".customer",
                true
            );
        }

        
        if (!($this->customer instanceof Customer)) {
            $context->addViolation('Invalid customer given', array(), $this->customer);
        }
   */     
   }

    /**
     * @param  ExecutionContext $context
     * @return void
     * @deprecated
     */
    public function pickedOrderItems(ExecutionContext $context)
    {
        $count = 0;

        foreach ($this->items as $item) {
            $count += $item->getCount();
        }

        if ($count === 0) {
            /*
            $property_path = $context->getPropertyPath() . '.customer.phone';
            $property_path = $context->getPropertyPath() . '.items[0].count';
            $property_path = $context->getPropertyPath() . '.items.[0].count';
            $property_path = $context->getPropertyPath() . '.items.0.count';
            */
            $property_path = $context->getPropertyPath() . '.items[0].count';
            $context->setPropertyPath($property_path);
            $context->addViolation('You have to pick at least one pizza...', array(), null);
        }
    }


}
