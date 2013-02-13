<?php

namespace PB\VentasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PrecioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$hoy = new \DateTime();
        $builder
        	->add('cliente', 'cliente_text', array('error_bubbling' => true))
            ->add('fecha', 'date', array(
            		'widget' => 'single_text',
            		//'format' => 'dd/MM/yy',
        			'data' => $hoy,
            		'error_bubbling' => true,
            		'read_only' => true
            ))
            ->add('preciolineas', 'collection', array(
            		'label' => 'Lineas',
            		'type' => new PrecioLineaType(),
            		'allow_add' => true,
            		'allow_delete' => true,
            		'prototype' => true,
            		//'data_class' => 'PB\VentasBundle\Entity\PrecioLinea'
            		//'options' => array('data_class' => 'PB\VentasBundle\Entity\PrecioLinea'),
            ))
            ->add('cam15', 'text', array('required' => false))
            ->add('cam30', 'text', array('required' => false))
            ->add('cam50', 'text', array('required' => false))
            ->add('cam100', 'text', array('required' => false))
            ->add('cam100mas', 'text', array('required' => false))
            ->add('asa20', 'text', array('required' => false))
            ->add('asa30', 'text', array('required' => false))
            ->add('asa35', 'text', array('required' => false))
            ->add('especiales10', 'text', array('required' => false))
            ->add('especiales15', 'text', array('required' => false))
            ->add('espemenos150s', 'text', array('required' => false))
            ->add('espemenos150i', 'text', array('required' => false))
            ->add('bobmenos150s', 'text', array('required' => false))
            ->add('bobmenos150i', 'text', array('required' => false))
            ->add('espemas150s', 'text', array('required' => false))
            ->add('espemas150i', 'text', array('required' => false))
            ->add('bobmas150s', 'text', array('required' => false))
            ->add('bobmas150i', 'text', array('required' => false))
            ->add('espemas500s', 'text', array('required' => false))
            ->add('espemas500i', 'text', array('required' => false))
            ->add('bobmas500i', 'text', array('required' => false))
            ->add('bobmas500s', 'text', array('required' => false))
            ->add('bolleria', 'text', array('required' => false))
            ->add('ppbob', 'text', array('required' => false))
            ->add('ppbolsasin', 'text', array('required' => false))
            ->add('ppbolsapeque', 'text', array('required' => false))
            ->add('ppbolsagrande', 'text', array('required' => false))
            ->add('ppmbob', 'text', array('required' => false))
            ->add('ppmbobi', 'text', array('required' => false))
            ->add('ppmsin', 'text', array('required' => false))
            ->add('ppmim', 'text', array('required' => false))
            ->add('laminaim', 'text', array('required' => false))
            ->add('laminasin', 'text', array('required' => false))
            ->add('incremento', 'choice', array(
            		'choices' => array( '1' => 'Incrementar', '2' => 'Decrementar' ),
            		'required'    => false, 'expanded' => true,
            		'empty_data'  => null,'mapped' => false))
            ->add('porcentaje', 'choice', array(
            		'choices' => array( '0' => '0', '1' => '1','2' => '2','3' => '3','4' => '4','5' => '5','6' => '6','7' => '7','8' => '8','9' => '9', '10' => '10'),
            		'required'    => false, 'expanded' => false,'mapped' => false,
            		'empty_data'  => null))
            ->add('ficha', 'checkbox', array(
            		'label'     => 'Show this entry publicly?',
            		'required'  => false,'mapped' => false))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PB\VentasBundle\Entity\Precio'
        ));
    }

    public function getName()
    {
        return 'precio';
    }
}
