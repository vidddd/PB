<?php

namespace PB\AlmacenBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\HttpFoundation\Response;

class AlmacenType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$yaml = new Parser();$hoy = new \DateTime();
    	try {
    		$value = $yaml->parse(file_get_contents(__DIR__ . '/../Resources/config/almacen.yml'));
    	} catch (ParseException $e) {
    		printf("Unable to parse the YAML string: %s", $e->getMessage());
    	}
    	 
        $builder
            //->add('referencia', 'text', array('required' => true))
            ->add('referencia')
            ->add('descripcion')
            ->add('producto', 'entity', array(
    				'class' => 'PBAlmacenBundle:Producto',
            		'empty_value' => '',	'required' => true,
    				'property' => 'nombre',))
            ->add('cantidad')
            ->add('paquete')
            ->add('serie')->add('ancho')->add('largo')->add('galga')
            ->add('estanteria')->add('nivel')->add('posicion')
            ->add('fecha_entrada', 'date', array(
									'widget' => 'single_text','data' => $hoy,
									'error_bubbling' => true
							))
        ;
    }

    public function getName()
    {
        return 'almacen';
    }
}
