<?php

namespace PB\VentasBundle\Form\Type;

use
    Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormBuilderInterface
;

class AlbaranLineaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('referencia')->add('descripcion')->add('cantidad')
        ;
    }

    public function getDefaultOptions(array $options)
    {
        return array('data_class' => 'PB\VentasBundle\Entity\AlbaranLinea');
    }

     public function getName()
    {
        return 'albaran_linea';
    }
}
