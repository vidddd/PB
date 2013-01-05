<?php

namespace PB\VentasBundle\Form\buscador;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormError;


class BuscadorPreciosFacturaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

       $builder->add('codfactura','number',array('error_bubbling' => true))
       			->add('cliente', 'number', array('error_bubbling' => true))
       			->add('codpedido', 'number', array('error_bubbling' => true))
       			->add('concepto', 'text', array('error_bubbling' => true))
       			->add('ancho', 'number', array('error_bubbling' => true))
       ;
       
       $listener = function(FormEvent $event)
       {
       	// Is data empty?
       	foreach ($event->getData() as $data) {
       		if(is_array($data)) {
       			foreach ($data as $subData) {
       				if(!empty($subData)) return;
       			}
       		}
       		else {
       			if(!empty($data)) return;
       		}
       	}
       
       	$event->getForm()->addError(new FormError('Filtros Vacios'));
       };
       $builder->addEventListener(FormEvents::POST_BIND, $listener);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        return array(
            'csrf_protection' => false,
        );
    }

    public function getName()
    {
        return 'buscador_precios_factura';
    }
}
