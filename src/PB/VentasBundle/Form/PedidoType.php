<?php

namespace PB\VentasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use PB\VentasBundle\Form\DataTransformer\ClilenteToIdTransformer;

class PedidoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$hoy = new \DateTime();

    	// add a normal text field, but add our transformer to it
    	
        $builder
        	->add('cliente', 'cliente_text', array('error_bubbling' => true))
            ->add('id', 'number', array('read_only' => true,'error_bubbling' => true))
            ->add('fecha', 'date', array(
            		'widget' => 'single_text',
            		//'format' => 'dd/MM/yy',
        			'data' => $hoy
            ))
            ->add('codpedido')
            ->add('estado')
            ->add('codalbaran')
            ->add('codfactura')
            ->add('fecha_entrega')
            ->add('subcliente')
            ->add('cantidad', 'number', array('error_bubbling' => true))
            ->add('mtycolor', 'text', array('error_bubbling' => true))
            ->add('tipomaterial', 'number', array('error_bubbling' => true))
            ->add('ancho', 'number', array('error_bubbling' => true))
            ->add('galga')
            ->add('plegado')
            ->add('bobinas')
            ->add('metros')
            ->add('pesoteorico')
            ->add('tratado')
            ->add('tipotubo')
            ->add('kilosimp')
            ->add('cliche')
            ->add('medidaimp')
            ->add('soldadura')
            ->add('impresion')
            ->add('colores')
            ->add('maquina')
            ->add('cantidadc')
            ->add('anchoc')
            ->add('largoc')
            ->add('solapa')
            ->add('almacen')
            ->add('operario')
            ->add('notasextrusion')
            ->add('notasimpresion')
            ->add('notascorte')
            ->add('precio')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PB\VentasBundle\Entity\Pedido'
        ));
    }

    public function getName()
    {
        return 'pb_ventasbundle_pedidotype';
    }
}
