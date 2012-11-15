<?php

namespace PB\VentasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FacturaLineaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$builder
            ->add('referencia')
            ->add('descripcion')
            ->add('codpedido', 'hidden')
            ->add('cantidad')
            ->add('ancho')
            ->add('largo')
            ->add('galga')
            //->add('solapa')
            ->add('precio')
            ->add('descuento')
            ->add('importe', 'hidden')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PB\VentasBundle\Entity\FacturaLinea'
        ));
    }

    public function getName()
    {
        return 'facturalinea';
    }
}
