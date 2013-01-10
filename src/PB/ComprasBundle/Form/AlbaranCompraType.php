<?php

namespace PB\ComprasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use PB\ComprasBundle\Form\AlbaranCompraLineaType;
use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Exception\ParseException;

class AlbaranCompraType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$hoy = new \DateTime();
    	$yaml = new Parser();
    	try {
    		$value = $yaml->parse(file_get_contents(__DIR__ . '/../Resources/config/compras.yml'));
    	} catch (ParseException $e) {
    		printf("Unable to parse the YAML string: %s", $e->getMessage());
    	}
    	 	
    	$formas = $value['medio_envio']; $estados = $value['estados'];
    	$builder
            ->add('id', 'number', array('read_only' => true, 'error_bubbling' => true))
            ->add('proveedor', 'proveedor_text', array('error_bubbling' => true))
            ->add('fecha', 'date', array(
							    'widget' => 'single_text',
							    //'format' => 'dd.MM.yyyy',
    							'data' => $hoy,
            					'error_bubbling' => true
							))
			->add('fecha_recepcion', 'date', array(
									'widget' => 'single_text',
									'error_bubbling' => true
							))
            ->add('referencia', 'text', array('error_bubbling' => true, 'required' => false))
            ->add('estado', 'choice', array('error_bubbling' => true, 'required' => true,'choices' => $estados, 'data' => 1))
            ->add('observaciones', 'textarea', array('error_bubbling' => true, 'required' => false))
            ->add('importe', 'hidden', array('error_bubbling' => true))
            ->add('iva', 'hidden', array('error_bubbling' => true))
            ->add('total', 'hidden', array('error_bubbling' => true))

            ->add('albarancompralineas', 'collection', array('label' => 'Lineas',
            														'type' => new AlbaranCompraLineaType(),
            														'allow_add' => true,
            														'allow_delete' => true,
            														'prototype' => true,
            												))
            	
          // ->add('albarancompra_pedido')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PB\ComprasBundle\Entity\AlbaranCompra'
        ));
    }

    public function getName()
    {
        return 'albarancompra';
    }
}
