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
    	try {
    		$value = $yaml->parse(file_get_contents(__DIR__ . '/../Resources/config/ventas.yml'));
    	} catch (ParseException $e) {
    		printf("Unable to parse the YAML string: %s", $e->getMessage());
    	}
    	
        $builder
            ->add('cliente', 'cliente_text', array('error_bubbling' => true))
            ->add('estado')
            ->add('codpresupuesto')
            ->add('fecha', 'date', array(
            		'widget' => 'single_text',
            		//'format' => 'dd/MM/yy',
        			'data' => $hoy
            ))
            ->add('cantidad')
            ->add('material')
            ->add('color')
            ->add('tipotupo')
            ->add('tipobolsa')
            ->add('bobinas')
            ->add('mbobinas')
            ->add('kgbobinas')
            ->add('ancho')
            ->add('galga')
            ->add('plegado')
            ->add('precio')
            ->add('impresion1')
            ->add('impresion2')
            ->add('impresioncolor1')
            ->add('impresioncolor2')
            ->add('cliche')
            ->add('preciocliche')
            ->add('paquetes')
            ->add('sacos')
            ->add('palets')
            ->add('observaciones')
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
        return 'pb_ventasbundle_presupuestotype';
    }
}
