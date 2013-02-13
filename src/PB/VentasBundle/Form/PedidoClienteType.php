<?php

namespace PB\VentasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use PB\VentasBundle\Form\DataTransformer\ClilenteToIdTransformer;
use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Exception\ParseException;

class PedidoClienteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$hoy = new \DateTime();
    	$yaml = new Parser();
    	try {
    		$value = $yaml->parse(file_get_contents(__DIR__ . '/../Resources/config/ventas.yml'));
    	} catch (ParseException $e) { printf("Unable to parse the YAML string: %s", $e->getMessage()); }
    	$tipos = $value['tipo_material'];
    	$estados = $value['estados_pedidos']; $cliches = $value['cliches']; $tubos = $value['tipo_tubo']; $bolsas = $value['soldadura']; $asas = $value['asas'];
    	
        $builder
            ->add('cliente', 'cliente_text', array('error_bubbling' => true))
            ->add('fecha', 'date', array(
            		'widget' => 'single_text',
            		//'format' => 'dd/MM/yy',
        			'data' => $hoy
            ))
            ->add('subcliente')
            ->add('estado', 'choice', array( 'choices' => $estados,'error_bubbling' => true))
            ->add('cantidad')
            ->add('cantidaduni', 'choice', array(
            		'choices'   => array('1'   => 'Bolsas','2' => 'Kg', '3' => 'Metros',
            		), 'multiple'  => false, 'expanded' => true, 'required' => false))
            ->add('ancho', 'text', array('required' => true))
            ->add('largo')
            ->add('galga', 'text', array('required' => true))
            ->add('plegado')
            ->add('solapa')
            ->add('precio')
            ->add('preciocliche')
            ->add('material', 'choice', array( 'choices' => $tipos,'error_bubbling' => true, 'required' => true))
            ->add('color')
            ->add('tipotubo', 'choice', array( 'choices' => $tubos,'error_bubbling' => true,'empty_value' => '', 'required' => false))
            ->add('tipobolsa', 'choice', array( 'choices' => $bolsas,'error_bubbling' => true,'empty_value' => '', 'required' => false))
            ->add('asa', 'choice', array( 'choices' => $asas,'error_bubbling' => true,'empty_value' => '', 'required' => false))
            ->add('bobinasnumero')
            ->add('bobinasmetros')
            ->add('bobinaskg')
            ->add('impresion1', 'text', array('required' => false))
            ->add('impresion2', 'text', array('required' => false))
            ->add('color1', 'text', array('required' => false))
            ->add('color2', 'text', array('required' => false))
            ->add('cliche', 'choice', array( 'choices' => $cliches,'error_bubbling' => true,'empty_value' => '', 'required' => false))
            ->add('observaciones')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PB\VentasBundle\Entity\PedidoCliente'
        ));
    }

    public function getName()
    {
        return 'pedidocliente';
    }
}
