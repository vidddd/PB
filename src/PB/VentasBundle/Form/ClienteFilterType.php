<?php

namespace PB\VentasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormError;

class ClienteFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', 'filter_number_range')
            ->add('codcliente', 'filter_number_range')
            ->add('nombre', 'filter_text')
            ->add('nombrecomercial', 'filter_text')
            ->add('nif', 'filter_text')
            ->add('fechaalta', 'filter_date_range')
            ->add('direccion', 'filter_text')
            ->add('localidad', 'filter_text')
            ->add('cp', 'filter_text')
            ->add('codprovincia', 'filter_number_range')
            ->add('pais', 'filter_text')
            ->add('telefono', 'filter_text')
            ->add('fax', 'filter_text')
            ->add('movil', 'filter_text')
            ->add('web', 'filter_text')
            ->add('email', 'filter_text')
            ->add('cuenta', 'filter_text')
            ->add('descuento', 'filter_number_range')
            ->add('recargo', 'filter_choice')
            ->add('observaciones', 'filter_text')
            ->add('codfp', 'filter_number_range')
            ->add('facturaciona', 'filter_number_range')
            ->add('facturacionb', 'filter_number_range')
            ->add('debea', 'filter_number_range')
            ->add('habera', 'filter_number_range')
            ->add('saldoa', 'filter_number_range')
            ->add('debeb', 'filter_number_range')
            ->add('haberb', 'filter_number_range')
            ->add('saldob', 'filter_number_range')
            ->add('albaranespendientes', 'filter_number_range')
            ->add('albaranespendientesa', 'filter_number_range')
            ->add('albaranespendientesb', 'filter_number_range')
            ->add('codigoultimafactura', 'filter_text')
            ->add('fechaultimafactura', 'filter_date_range')
            ->add('codigoultimoalbaran', 'filter_text')
            ->add('fechaultimoalbaran', 'filter_date_range')
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
        return 'pb_ventasbundle_clientefiltertype';
    }
}
