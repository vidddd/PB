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
    	$medios = $value['medio_envio']; $tipose = $value['tipo_evaluacion'];
    	//$tipos = $this->container->getParameter('tipo_proveedor');
    	//$tipos = $this->container->getParameter('tipo_proveedor');
    	
        $builder
            ->add('nombre', 'text', array('required' => true))
            ->add('nombrecomercial', 'text', array('required' => false))
            ->add('nif', 'text', array('required' => true))
            ->add('nombrecontacto', 'text', array('required' => false))
            ->add('telefono_contacto')
            ->add('email_contacto')
            ->add('telefono')->add('telefono2')
            ->add('fax')
            ->add('email', 'text',array('error_bubbling' => true, 'required' => false))->add('web')
            ->add('direccion', 'text', array('required' => true))
            ->add('cp', 'text', array('max_length' => '5'))
            ->add('localidad', 'text', array('required' => true))
            ->add('provincia_proveedor', 'entity', array('class' => 'PBInicioBundle:Provincias',
            								   'property' => 'denprovincia', 
            								   'required' => false,
            		 						   'empty_value' => 'Elige una provincia',))
            
            //->add('provincia_proveedor')
            ->add('pais')
            ->add('tipo_proveedor', 'choice', array( 'choices' => $tipos, 'empty_value' => '---'))
            ->add('es_cliente')
            //->add('activo')
            ->add('observaciones')
            ->add('medio_envio', 'choice', array('choices'   => $medios ,'empty_value' => '---', 'required' => false))
            ->add('paga_iva')
            ->add('irpf')
            ->add('formapago_proveedor')
            ->add('codigo_externo')
            ->add('cuenta_bancaria')
            ->add('codigo_contabilidad')
            ->add('fecha_evaluacion', 'date', array(
            		'widget' => 'single_text',
            		'error_bubbling' => true,
            		'required' => false, 'read_only' => true
            ))
            ->add('fecha_evaluacion2', 'date', array(
            		'widget' => 'single_text',
            		'error_bubbling' => true,
            		'required' => false
            ))
            ->add('aprovado')
            ->add('tipo_evaluacion', 'choice', array( 'choices' => $tipose, 'read_only' => true))
        ;
    }

    public function getName()
    {
        return 'proveedor';
    }
}
