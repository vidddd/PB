<?php

namespace PB\ProduccionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use PB\VentasBundle\Form\DataTransformer\ClilenteToIdTransformer;
use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Exception\ParseException;

class OrdenType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$hoy = new \DateTime();
    	$yaml = new Parser();
    	try {
    		$value = $yaml->parse(file_get_contents(__DIR__ . '/../../VentasBundle/Resources/config/ventas.yml'));
    	} catch (ParseException $e) {
    		printf("Unable to parse the YAML string: %s", $e->getMessage());
    	}
    	$tipos = $value['tipo_material'];$estados = $value['estados_orden']; $productos = $value['producto']; $tratados = $value['tratado']; $tubos = $value['tipo_tubo']; $cliches = $value['cliches'];
        $builder
            ->add('cliente', 'cliente_text', array('error_bubbling' => true))
            ->add('subcliente')
            ->add('fecha', 'date', array('widget' => 'single_text', 'data' => $hoy ))
            ->add('estado', 'choice', array( 'choices' => $estados,'error_bubbling' => true))
            ->add('cantidad', 'number', array('required' => true))
            ->add('cantidaduni', 'choice', array(
				    'choices'   => array('1'   => 'Bolsas','2' => 'Kg', '3' => 'Metros',
				    ), 'multiple'  => false, 'expanded' => true))
            ->add('espesor')
            ->add('espesoruni', 'choice', array(
				    'choices'   => array('1'   => 'galga','2' => 'Micras',
				    ), 'multiple'  => false, 'expanded' => true))
            ->add('tipomaterial', 'choice', array( 'choices' => $tipos,'error_bubbling' => true, 'empty_value' => '-- Elige un Material --'))
            ->add('producto', 'choice', array( 'choices' => $productos,'error_bubbling' => true, 'empty_value' => '--Eligue un Producto --',))
            ->add('extrusion')
            ->add('color')
            ->add('ancho')
            ->add('galga')
            ->add('plegado')
            ->add('bobinas')
            ->add('pesoteorico')
            ->add('tratado', 'choice', array( 'choices' => $tratados,'error_bubbling' => true, 'empty_value' => '', 'required' => false))
            ->add('tipotubo', 'choice', array( 'choices' => $tubos,'error_bubbling' => true, 'empty_value' => '', 'required' => false))
            ->add('notasextrusion')
            ->add('maquina_extrusion')
            ->add('fecha_extrusion', 'date', array('widget' => 'single_text','empty_value' => '',  'required' => false ))
            ->add('operario_extrusion')
            ->add('kgfinal')
            ->add('tiempo_extrusion', 'time', array(
 				   'input'  => 'datetime','error_bubbling' => true, 
    				'widget' => 'text', 'required' => false
            		))
            ->add('impresion')
            ->add('medidaimp')
            ->add('kilosimp')
            ->add('anverso')
            ->add('reverso')
            ->add('coloresa')
            ->add('coloresr')
            ->add('cliche', 'choice', array( 'choices' => $cliches,'error_bubbling' => true, 'required' => false))
            ->add('carpeta')
            ->add('soldadura')
            ->add('notasimpresion')
            ->add('maquina_impresion')
            ->add('fecha_impresion', 'date', array('widget' => 'single_text', 'required' => false ))
            ->add('operario_impresion')
            ->add('tiempo_impresion', 'time', array(
 				   'input'  => 'string',
    				'widget' => 'text', 'required' => false
            		))
            ->add('corte')
            ->add('cantidadc')
            ->add('anchoc')
            ->add('largoc')
            ->add('solapa')
            ->add('paquete')
            ->add('saco')
            ->add('palets')
            ->add('notascorte')
            ->add('maquina_corte')
            ->add('fecha_corte', 'date', array('widget' => 'single_text', 'required' => false ))
            ->add('tiempo_corte', 'time', array(
 				   'input'  => 'string',
    				'widget' => 'text', 'required' => false
            		))
            ->add('operario_corte')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PB\ProduccionBundle\Entity\Orden'
        ));
    }

    public function getName()
    {
        return 'orden';
    }
}
