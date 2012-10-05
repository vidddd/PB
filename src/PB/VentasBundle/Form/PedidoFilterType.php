<?php

namespace PB\VentasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormError;

class PedidoFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', 'filter_number_range')
            ->add('codpedido', 'filter_text')
            ->add('estado', 'filter_number_range')
            ->add('codalbaran', 'filter_number_range')
            ->add('codfactura', 'filter_number_range')
            ->add('fecha', 'filter_date_range')
            ->add('fecha_entrega', 'filter_date_range')
            ->add('subcliente', 'filter_text')
            ->add('cantidad', 'filter_number_range')
            ->add('mtycolor', 'filter_text')
            ->add('tipomaterial', 'filter_number_range')
            ->add('ancho', 'filter_number_range')
            ->add('galga', 'filter_number_range')
            ->add('plegado', 'filter_number_range')
            ->add('bobinas', 'filter_number_range')
            ->add('metros', 'filter_number_range')
            ->add('pesoteorico', 'filter_number_range')
            ->add('tratado', 'filter_text')
            ->add('tipotubo', 'filter_text')
            ->add('kilosimp', 'filter_number_range')
            ->add('cliche', 'filter_text')
            ->add('medidaimp', 'filter_text')
            ->add('soldadura', 'filter_text')
            ->add('impresion', 'filter_text')
            ->add('colores', 'filter_text')
            ->add('maquina', 'filter_text')
            ->add('cantidadc', 'filter_text')
            ->add('anchoc', 'filter_number_range')
            ->add('largoc', 'filter_number_range')
            ->add('solapa', 'filter_number_range')
            ->add('almacen', 'filter_text')
            ->add('operario', 'filter_text')
            ->add('notasextrusion', 'filter_text')
            ->add('notasimpresion', 'filter_text')
            ->add('notascorte', 'filter_text')
            ->add('precio', 'filter_number_range')
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
        return 'pb_ventasbundle_pedidofiltertype';
    }
}
