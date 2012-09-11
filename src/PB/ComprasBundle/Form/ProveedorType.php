<?php

namespace PB\ComprasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Exception\ParseException;

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
            ->add('nombrecomercial', 'text', array('required' => false))
            ->add('nif')
            ->add('nombrecontacto', 'text', array('required' => false))
            ->add('telefono_contacto')
            ->add('email_contacto')
            ->add('telefono')
            ->add('fax')
            ->add('email')
            ->add('direccion')
            ->add('cp')
            ->add('localidad')
            ->add('provincia', 'entity', array('class' => 'PBInicioBundle:Provincias', 'property' => 'denprovincia', 'empty_value' => 'Elige una provincia',))
            ->add('pais')
            ->add('tipo_proveedor', 'choice', array('choices'   => $tipos, 'empty_value' => '---'))
            ->add('es_cliente')
            ->add('activo')
            ->add('observaciones')
            ->add('medio_envio', 'choice', array('choices'   => $medios ,'required'  => true))
            ->add('paga_iva')
            ->add('irpf')
            ->add('codigo_formapago')
            ->add('codigo_externo')
            ->add('cuenta_bancaria')
            ->add('codigo_contabilidad')
            ->add('fechaalta')
        ;
    }

    public function getName()
    {
        return 'proveedor';
    }
}
