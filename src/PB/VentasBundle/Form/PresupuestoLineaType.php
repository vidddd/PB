<?php

namespace PB\VentasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PresupuestoLineaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$builder
            ->add('referencia')
            ->add('descripcion')
            ->add('cantidad')
            ->add('medida')
            ->add('galga')
            ->add('cantidad')
            ->add('precio')
            ->add('importe', 'hidden')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PB\VentasBundle\Entity\PresupuestoLinea'
        ));
    }

    public function getName()
    {
        return 'presupuestolinea';
    }
}
