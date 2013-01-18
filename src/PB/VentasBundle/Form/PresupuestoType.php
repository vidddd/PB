<?php

namespace PB\VentasBundle\Form;

use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use PB\VentasBundle\Form\DataTransformer\ClilenteToIdTransformer;

class PresupuestoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$hoy = new \DateTime();
    	$yaml = new Parser();
    	$ivas = array('0' => '0', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10','11' => '11', '12' => '12', '13' => '13', '14' => '14', '15' => '15', '16' => '16', '17' => '17', '18' => '18', '19' => '19', '20' => '20', '21' => '21');
    	$descuentos = array('0' => '0', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10');
    	try {
    		$value = $yaml->parse(file_get_contents(__DIR__ . '/../Resources/config/ventas.yml'));
    	} catch (ParseException $e) {
    		printf("Unable to parse the YAML string: %s", $e->getMessage());
    	}
    	
        $builder
            ->add('cliente', 'cliente_text', array('error_bubbling' => true))
            ->add('fecha', 'date', array(
            		'widget' => 'single_text',
            		//'format' => 'dd/MM/yy',
        			'data' => $hoy
            ))
            ->add('coutaiva')
 			->add('iva' , 'choice', array('choices' => $ivas,'by_reference' => true, 'data' => 21,'error_bubbling' => true))
            ->add('descuento', 'choice', array('choices' => $descuentos, 'error_bubbling' => true))
           
            ->add('nombre')
            ->add('importetotal', 'hidden', array('error_bubbling' => true))
            ->add('observaciones')
            ->add('presupuestolineas', 'collection', array('label' => 'Lineas',
            		'type' => new PresupuestoLineaType(),
            		'allow_add' => true,
            		'allow_delete' => true,
            		'prototype' => true,
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PB\VentasBundle\Entity\Presupuesto'
        ));
    }

    public function getName()
    {
        return 'presupuesto';
    }
}
