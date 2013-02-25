<?php

namespace PB\ProduccionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormError;

class MaquinaFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', 'filter_number_range')
            ->add('codigo', 'filter_text')
            ->add('nombre', 'filter_text')
            ->add('tipo', 'filter_number_range')
            ->add('capacidad_ciclo', 'filter_number_range')
            ->add('tiempo_ciclo', 'filter_number_range')
            ->add('tiempo_antes', 'filter_text')
            ->add('tiempo_despues', 'filter_text')
            ->add('lifecycleCallbacks', 'filter_text')
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
        return 'pb_produccionbundle_maquinafiltertype';
    }
}
