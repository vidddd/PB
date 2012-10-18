<?php

namespace PB\VentasBundle\Form\Type;

use
    Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormBuilderInterface
;

class AlbaranType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fecha')
            ->add('fecha_entrega')
            ->add('tipo')
            ->add('lineas', 'collection', array(
                'type'      => new AlbaranLineaType(),
                'allow_add' => true,
                'prototype' => true,
            ))
        ;
    }

     public function getName()
    {
        return 'albaran';
    }
}
