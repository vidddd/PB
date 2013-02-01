<?php

namespace PB\VentasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormError;
use Lexik\Bundle\FormFilterBundle\Filter\Extension\Type\TextFilterType;
use Lexik\Bundle\FormFilterBundle\Filter\Extension\Type\NumberFilterType;

class PedidoClienteFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', 'filter_number_range')
            ->add('cliente', 'filter_number')
            ->add('fecha', 'filter_date_range', array('left_date' => array('widget' => 'single_text',
		    									   'label' => 'aaaaa',
		    									//'format' => 'dd.MM.yyyy'
		    									),
		    						   'right_date' => array('widget' => 'single_text')
		    						 ))
            ->add('subcliente','filter_text', array( 'condition_pattern' => TextFilterType::PATTERN_CONTAINS))
            ->add('estado', 'filter_number_range')
            ->add('cantidad', 'filter_text')
            ->add('ancho', 'filter_number_range')
            ->add('largo', 'filter_number_range')
            ->add('galga', 'filter_number_range')
            ->add('plegado', 'filter_number_range')
            ->add('precio', 'filter_number_range')
            ->add('preciocliche', 'filter_number_range')
            ->add('material', 'filter_number_range')
            ->add('color', 'filter_text')
            ->add('tipotubo', 'filter_number_range')
            ->add('tipobolsa', 'filter_number_range')
            ->add('bobinasnumero', 'filter_number_range')
            ->add('bobinasmetros', 'filter_number_range')
            ->add('bobinaskg', 'filter_number_range')
            ->add('impresion1', 'filter_text')
            ->add('impresion2', 'filter_text')
            ->add('color1', 'filter_text')
            ->add('color2', 'filter_text')
            ->add('cliche', 'filter_number_range')
            ->add('observaciones', 'filter_text')
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

    public function getName()
    {
        return 'pedidoclientefilter';
    }
}
