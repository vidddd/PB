<?php

namespace PB\ProduccionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MaquinaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('codigo')
            ->add('nombre')
            ->add('tipo')
            ->add('capacidad_ciclo')
            ->add('tiempo_ciclo')
            ->add('tiempo_antes')
            ->add('tiempo_despues')
            ->add('lifecycleCallbacks')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PB\ProduccionBundle\Entity\Maquina'
        ));
    }

    public function getName()
    {
        return 'pb_produccionbundle_maquinatype';
    }
}
