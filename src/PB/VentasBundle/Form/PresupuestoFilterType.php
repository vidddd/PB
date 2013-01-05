<?php

namespace PB\VentasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormError;

class PresupuestoFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', 'filter_number')
            ->add('cliente', 'filter_number')->add('anchoc', 'filter_number')
            ->add('estado', 'filter_number_range')
			->add('fecha', 'filter_date_range', array('left_date' => array('widget' => 'single_text',
		    															   'label' => 'aaaaa',
		    											//'format' => 'dd.MM.yyyy'
		    											),
		    										   'right_date' => array('widget' => 'single_text')
		    									 ))
            ->add('cantidad', 'filter_text')
            ->add('material', 'filter_number_range')
            ->add('color', 'filter_text')
            ->add('tipotupo', 'filter_number_range')
            ->add('tipobolsa', 'filter_number_range')
            ->add('bobinas', 'filter_number_range')
            ->add('mbobinas', 'filter_number_range')
            ->add('kgbobinas', 'filter_number_range')
            ->add('ancho', 'filter_text')
            ->add('galga', 'filter_number_range')
            ->add('plegado', 'filter_number_range')
            ->add('precio', 'filter_number_range')
            ->add('impresion1', 'filter_text')
            ->add('impresion2', 'filter_text')
            ->add('impresioncolor1', 'filter_text')
            ->add('impresioncolor2', 'filter_text')
            ->add('cliche', 'filter_number_range')
            ->add('preciocliche', 'filter_number_range')
            ->add('paquetes', 'filter_text')
            ->add('sacos', 'filter_text')
            ->add('palets', 'filter_text')
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

            $event->getForm()->addError(new FormError('Filter empty'));
        };
        $builder->addEventListener(FormEvents::POST_BIND, $listener);
    }

    public function getName()
    {
        return 'pb_ventasbundle_presupuestofiltertype';
    }
}
