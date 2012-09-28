<?php

namespace PB\ComprasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\HttpFoundation\Response;

class ProveedorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$yaml = new Parser();
    	try {
    	  $value = $yaml->parse(file_get_contents(__DIR__ . '/../Resources/config/compras.yml'));
    	} catch (ParseException $e) {printf("Unable to parse the YAML string: %s", $e->getMessage());}
    	
    	$tipos = $value['tipo_proveedor'];
    	$medios = $value['medio_envio'];
    	
        $builder
            ->add('nombre', 'text', array('required' => true))
            ->add('nombrecomercial', 'text')
            ->add('nif', 'text', array('required' => true))
            ->add('nombrecontacto', 'text')
            ->add('telefono_contacto')
            ->add('email_contacto')
            ->add('telefono')
            ->add('fax')
            ->add('email')
            ->add('direccion', 'text', array('required' => true))
            ->add('cp', 'text', array('max_length' => '5'))
            ->add('localidad', 'text', array('required' => true))
            ->add('provincia_proveedor', 'entity', array('class' => 'PBInicioBundle:Provincias',
            								   'property' => 'denprovincia', 
            		 						   'empty_value' => 'Elige una provincia',))
            
            //->add('provincia_proveedor')
            ->add('pais')
            ->add('tipo_proveedor', 'choice', array( 'choices' => $tipos, 'empty_value' => '---'))
            ->add('es_cliente')
            //->add('activo')
            ->add('observaciones')
            ->add('medio_envio', 'choice', array('choices'   => $medios ,'empty_value' => '---'))
            ->add('paga_iva')
            ->add('irpf')
            ->add('formapago_proveedor')
            ->add('codigo_externo')
            ->add('cuenta_bancaria')
            ->add('codigo_contabilidad')
        ;
    }

    public function getName()
    {
        return 'proveedor';
    }
}
