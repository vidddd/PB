<?php

namespace PB\CalidadBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Exception\ParseException;

class NoconformidadType extends AbstractType
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
    	$estados = $value['estados_incidencias'];
        $builder
            ->add('fecha_apertura', 'date', array(
							    'widget' => 'single_text',
							    //'format' => 'dd.MM.yyyy',
    							'data' => $hoy,
            					'error_bubbling' => true
							)) 
			->add('estado', 'choice', array( 'choices' => $estados,'error_bubbling' => true))
			->add('cliente', 'cliente_text', array('error_bubbling' => true, 'required' => false))
			->add('pedidocliente', 'pedidocliente_text', array('error_bubbling' => true, 'required' => false))
            ->add('descripcion')
            ->add('acciones_inmediatas')
            ->add('analisis_causas')
            ->add('acciones')
            ->add('responsable')
            ->add('plazo')
            ->add('fecha_cierre', 'date', array(
							    'widget' => 'single_text',
							    //'format' => 'dd.MM.yyyy',
    							//'data' => $hoy,
        						'required' => false,
            					'error_bubbling' => true
							)) 
            ->add('explicacion')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PB\CalidadBundle\Entity\Noconformidad'
        ));
    }

    public function getName()
    {
        return 'pb_calidadbundle_noconformidadtype';
    }
}
