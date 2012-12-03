<?php

namespace PB\GeneralBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FormaPagoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre' , 'text', array('required' => true))
            ->add('descripcion')->add('dias')
          //  ->add('formapagos')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PB\GeneralBundle\Entity\FormaPago'
        ));
    }

    public function getName()
    {
        return 'pb_generalbundle_formapagotype';
    }
}
