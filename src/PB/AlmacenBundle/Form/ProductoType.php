<?php

namespace PB\AlmacenBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\HttpFoundation\Response;

class ProductoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$yaml = new Parser();
    	try {
    		$value = $yaml->parse(file_get_contents(__DIR__ . '/../Resources/config/almacen.yml'));
    	} catch (ParseException $e) {
    		printf("Unable to parse the YAML string: %s", $e->getMessage());
    	}
    	 
    	$tipos = $value['tipo_producto'];
    	
        $builder
            ->add('nombre', 'text', array('required' => true))
            ->add('vendido')
            ->add('comprado')
            ->add('tipoproducto', 'choice', array( 'choices' => $tipos, 'empty_value' => ''))
            ->add('metodo_suministro')
            ->add('preciocompra')
            ->add('precioventa')
            ->add('referencia')
            ->add('descripcion')
        ;
    }

    public function getName()
    {
        return 'producto';
    }
}
