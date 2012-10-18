<?php

namespace PB\VentasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Choice;

class ClienteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$descuentos = array(
    			'0' => '0', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10',
    	);
        
    	$builder
            ->add('codcliente')
            ->add('nombre')
            ->add('nombrecomercial')
            ->add('nif')
            //->add('fechaalta')
            ->add('direccion')
            ->add('localidad')
            ->add('cp')->add('pais')
            ->add('provincia_cliente', 'entity', array('class' => 'PBInicioBundle:Provincias',
            								   'property' => 'denprovincia', 
            		 						   'empty_value' => '-- Elige una provincia --',))
            ->add('comercial_cliente', 'entity', array('class' => 'PBVentasBundle:Comercial',
            		 						   		'property' => 'nombre',
            		 						   		'empty_value' => '-- Elige un comercial --',))
           ->add('pais')
            ->add('telefono')
            ->add('fax')
            ->add('movil')
            ->add('web')
            ->add('email')
            ->add('cuenta')
			->add('descuento' , 'choice', array(
					    'choices'   => $descuentos,
					))
            ->add('recargo')
            ->add('observaciones')
            ->add('formapago_cliente')
        ;
    }

    public function getName()
    {
        return 'cliente';
    }
    
    public function getDefaultOptions(array $options)
    {
    	return array(
    			'data_class' => 'PB\VentasBundle\Entity\Cliente',
    	);
    }
}
