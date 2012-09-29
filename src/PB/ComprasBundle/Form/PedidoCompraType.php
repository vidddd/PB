<?php

namespace PB\ComprasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PedidoCompraType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fecha')
            ->add('fecha_entrega')
            ->add('referencia')
            ->add('forma_envio')
            ->add('importe')
            ->add('iva')
            ->add('total')
            ->add('descuento')
            ->add('proveedor')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PB\ComprasBundle\Entity\PedidoCompra'
        ));
    }

    public function getName()
    {
        return 'pb_comprasbundle_pedidocompratype';
    }
}
