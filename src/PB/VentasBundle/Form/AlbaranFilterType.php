<?php

namespace PB\VentasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormError;

class AlbaranFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$hoy = new \DateTime();
    	$tipos = array(1 => 'A', 2 => 'B');
    	$factus = array('' => 'Todos',1=> 'Facturados', 2=> 'Sin Facturar');
        $builder
            ->add('id', 'filter_number')
            ->add('cliente', 'filter_number', array('error_bubbling' => true))
		    ->add('fecha', 'filter_date_range', array('left_date' => array('widget' => 'single_text',
		    															   'label' => 'aaaaa',
		    											//'format' => 'dd.MM.yyyy'
		    											),
		    										   'right_date' => array('widget' => 'single_text')
		    									 ))
            ->add('tipo' , 'filter_choice', array(
					    'choices'   => $tipos,
					))
            ->add('codfactura', 'filter_number_range')
            ->add('iva', 'filter_number_range')
            ->add('descuento', 'filter_number_range')
            ->add('recargo', 'filter_choice')
            ->add('anyo', 'filter_number_range')
            ->add('importetotal', 'filter_number_range')
            ->add('obervaciones', 'filter_text')
            ->add('facturados', 'choice', array(
					    'choices'   => $factus,
            		'expanded' => true,
            		'multiple' => false,
            		'empty_value' => false
					))
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

            $event->getForm()->addError(new FormError('Filtros vacios'));
        };
        $builder->addEventListener(FormEvents::POST_BIND, $listener);
    }

    public function getName()
    {
        return 'albaranfilter';
    }
}
