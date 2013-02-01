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
    	$estados = $value['estados_pedidos']; $cliches = $value['cliches']; $tubos = $value['tipo_tubo'];
    	
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
            ->add('ancho')
            ->add('largo')
            ->add('galga')
            ->add('plegado')
            ->add('precio')
            ->add('preciocliche')
            ->add('material')
            ->add('color')
            ->add('tipotubo')
            ->add('tipobolsa')
            ->add('bobinasnumero')
            ->add('bobinasmetros')
            ->add('bobinaskg')
            ->add('impresion1')
            ->add('impresion2')
            ->add('color1')
            ->add('color2')
            ->add('cliche')
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
