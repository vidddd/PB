<?php

namespace PB\ComprasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AlbaranCompraLineaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$builder
            ->add('referencia')
            ->add('descripcion')
            ->add('cantidad')
            ->add('precio')
            ->add('descuento')
            ->add('total', 'hidden')
            
            //->add('pedidocompralinea', 'hidden')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PB\ComprasBundle\Entity\AlbaranCompraLinea'
        ));
    }

    public function getName()
    {
        return 'albarancompralinea';
    }
}
