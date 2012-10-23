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
            ->add('cam15')
            ->add('cam30')
            ->add('cam50')
            ->add('cam100')
            ->add('cam100mas')
            ->add('asa20')
            ->add('asa30')
            ->add('asa35')
            ->add('especiales10')
            ->add('especiales15')
            ->add('espemenos150s')
            ->add('espemenos150i')
            ->add('bobmenos150s')
            ->add('bobmenos150i')
            ->add('espemas150s')
            ->add('espemas150i')
            ->add('bobmas150s')
            ->add('bobmas150i')
            ->add('espemas500s')
            ->add('espemas500i')
            ->add('bobmas500i')
            ->add('bobmas500s')
            ->add('bolleria')
            ->add('ppbob')
            ->add('ppbolsasin')
            ->add('ppbolsapeque')
            ->add('ppbolsagrande')
            ->add('ppmbob')
            ->add('ppmbobi')
            ->add('ppmsin')
            ->add('ppmim')
            ->add('laminaim')
            ->add('laminasin')
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
