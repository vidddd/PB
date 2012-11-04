<?php

namespace PB\VentasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AlbaranType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$hoy = new \DateTime();
    	$ivas = array('0' => '0', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10','11' => '11', '12' => '12', '13' => '13', '14' => '14', '15' => '15', '16' => '16', '17' => '17', '18' => '18', '19' => '19', '20' => '20', '21' => '21');
        $tipos = array(1 => 'A', 2 => 'B');
        $builder
            ->add('cliente', 'cliente_text', array('error_bubbling' => true))
            ->add('fecha', 'date', array(
							    'widget' => 'single_text',
							    //'format' => 'dd.MM.yyyy',
    							'data' => $hoy,
            					'error_bubbling' => true
							))
            ->add('fecha_entrega', 'date')
            ->add('tipo', 'choice', array('choices' => $tipos, 'error_bubbling' => true))
            ->add('iva' , 'choice', array('choices' => $ivas, 'data' => 21,'error_bubbling' => true))
            ->add('descuento')
            ->add('recargo')
            ->add('anyo')
            ->add('importetotal')
            ->add('observaciones')
            ->add('cliente', 'cliente_text', array('error_bubbling' => true))->add('id', 'number', array('disabled' => true))
            ->add('albaranlineas', 'collection', array('label' => 'Lineas',
            		'type' => new AlbaranLineaType(),
            		'allow_add' => true,
            		'allow_delete' => true,
            		'prototype' => true,
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PB\VentasBundle\Entity\Albaran'
        ));
    }

    public function getName()
    {
        return 'albaran';
    }
}
