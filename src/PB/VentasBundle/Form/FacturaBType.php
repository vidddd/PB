<?php

namespace PB\VentasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Exception\ParseException;

class FacturaBType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$hoy = new \DateTime();
    	$yaml = new Parser();
    	try {
    		$value = $yaml->parse(file_get_contents(__DIR__ . '/../Resources/config/ventas.yml'));
    	} catch (ParseException $e) {printf("Unable to parse the YAML string: %s", $e->getMessage());}
    	
    	$estados = $value['estados_facturas'];
 		$descuentos = array('0' => '0', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10');
    	$tipos = array(1 => 'A', 2 => 'B');
    	$recargos = array(0 => 'No', 1 => 'Si');
        $builder
            ->add('id', 'number', array('disabled' => true))
            ->add('cliente', 'cliente_text', array('error_bubbling' => true))
            ->add('fecha', 'date', array(
							    'widget' => 'single_text',
							    //'format' => 'dd.MM.yyyy',
    							//'data' => $hoy,
            					'error_bubbling' => true
							))
            ->add('fecha_cobro', 'date', array(
							    'widget' => 'single_text',
							    //'format' => 'dd.MM.yyyy',
    							//'data' => $hoy,
            					'error_bubbling' => true
							))
		    ->add('formapago_factura')
            ->add('tipo', 'hidden', array('data' => 2, 'error_bubbling' => true))
            //->add('iva' , 'choice', array('choices' => $ivas, 'data' => 21,'error_bubbling' => true))
            ->add('descuento', 'choice', array('choices' => $descuentos, 'error_bubbling' => true))
            //->add('recargo', 'choice', array('choices' => $recargos, 'error_bubbling' => true))
            ->add('anyo')
            ->add('estado', 'choice', array( 'choices' => $estados,'error_bubbling' => true))
            ->add('importetotal', 'hidden', array('error_bubbling' => true))
            ->add('observaciones')
            ->add('facturalineas', 'collection', array('label' => 'Lineas',
            		'type' => new FacturaBLineaType(),
            		'allow_add' => true,
            		'allow_delete' => true,
            		'prototype' => true,
            ))
        
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PB\VentasBundle\Entity\FacturaB'
        ));
    }

    public function getName()
    {
        return 'facturab';
    }
}
