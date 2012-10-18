<?php

namespace PB\VentasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ComercialType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$descuentos = array('0' => '0', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10','11' => '11', '12' => '12', '13' => '13', '14' => '14', '15' => '15', '16' => '16', '17' => '17', '18' => '18', '19' => '19', '20' => '20');
        $builder
            ->add('nombre')
            ->add('nif')
            ->add('direccion')
            ->add('cp')
            ->add('telefono')
            ->add('localidad')
            ->add('provincia_comercial', 'entity', array('class' => 'PBInicioBundle:Provincias',
            								   'property' => 'denprovincia', 
            		 						   'empty_value' => '-- Elige una provincia --',))
            ->add('porcentaje' , 'choice', array(
					    'choices'   => $descuentos,
					))
            ->add('es_cliente')
            ->add('observaciones')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PB\VentasBundle\Entity\Comercial'
        ));
    }

    public function getName()
    {
        return 'pb_ventasbundle_comercialtype';
    }
}
