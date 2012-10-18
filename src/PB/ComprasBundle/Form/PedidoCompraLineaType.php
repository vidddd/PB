<?php

namespace PB\ComprasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PedidoCompraLineaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$builder
            ->add('referencia', 'text', array('error_bubbling' => true))
            ->add('descripcion', 'text', array('error_bubbling' => true))
            ->add('cantidad', 'text', array('error_bubbling' => true))
            ->add('precio', 'text', array('error_bubbling' => true))
            ->add('descuento', 'number', array('error_bubbling' => true))
            ->add('total', 'hidden', array('error_bubbling' => true))
            ->add('pedidocompralinea', 'hidden')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PB\ComprasBundle\Entity\PedidoCompraLinea'
        ));
    }

    public function getName()
    {
        return 'pedidocompralinea';
    }
}
