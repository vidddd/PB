<?php

namespace PB\CalidadBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NoconformidadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fecha_apertura')
            ->add('descripcion')
            ->add('acciones_inmediatas')
            ->add('analisis_causas')
            ->add('acciones')
            ->add('responsable')
            ->add('plazo')
            ->add('fecha_cierre')
            ->add('explicacion')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PB\CalidadBundle\Entity\Noconformidad'
        ));
    }

    public function getName()
    {
        return 'pb_calidadbundle_noconformidadtype';
    }
}
