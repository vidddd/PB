<?php

namespace PB\ComprasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use PB\ComprasBundle\Form\PedidoCompraLineaType;

class PedidoCompraType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$hoy = new \DateTime();
    	$builder
            ->add('id', 'number', array('read_only' => true, 'error_bubbling' => true))
            ->add('proveedor', 'proveedor_text', array('error_bubbling' => true))
            ->add('fecha', 'date', array(
							    'widget' => 'single_text',
							    //'format' => 'dd.MM.yyyy',
    							'data' => $hoy,
            					'error_bubbling' => true
							))
            ->add('fecha_entrega', 'date', array(
							    'widget' => 'single_text',
            					'error_bubbling' => true,
            					'required' => false
							))
            ->add('referencia', 'text', array('error_bubbling' => true, 'required' => false))
            ->add('forma_envio', 'text', array('error_bubbling' => true, 'required' => false))
            ->add('importe', 'text', array('error_bubbling' => true))
            ->add('iva', 'text', array('error_bubbling' => true))
            ->add('total', 'number', array('error_bubbling' => true))
            ->add('descuento', 'hidden', array('error_bubbling' => true))
            
            ->add('pedidocompralineas', 'collection', array('type' => new PedidoCompraLineaType(),
            															'allow_add' => true,
                    													'allow_delete' => true,
                    													'prototype' => true,
                    													));

        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PB\ComprasBundle\Entity\PedidoCompra'
        ));
    }

    public function getName()
    {
        return 'pedidocompra';
    }
}
