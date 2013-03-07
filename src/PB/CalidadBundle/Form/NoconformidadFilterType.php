<?php

namespace PB\CalidadBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormError;

class NoconformidadFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', 'filter_number_range')
            ->add('fecha_apertura', 'filter_date_range')
            ->add('descripcion', 'filter_text')
            ->add('acciones_inmediatas', 'filter_text')
            ->add('analisis_causas', 'filter_text')
            ->add('acciones', 'filter_text')
            ->add('responsable', 'filter_text')
            ->add('plazo', 'filter_text')
            ->add('fecha_cierre', 'filter_date_range')
            ->add('explicacion', 'filter_text')
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
        return 'pb_calidadbundle_noconformidadfiltertype';
    }
}
