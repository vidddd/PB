<?php

namespace PB\VentasBundle\Form;

use
    Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormBuilderInterface
;

class AlbaranFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fecha')
            ->add('fecha_entrega')
            ->add('tipo')
            ->add('lineas', 'collection', array(
                'type'         => new Type\AlbaranLineaType(),
                'allow_add'    => true,
                'allow_delete' => true,
                'prototype'    => true,
            ))
        ;
    }

    public function getName()
    {
        return 'albaran';
    }
}
