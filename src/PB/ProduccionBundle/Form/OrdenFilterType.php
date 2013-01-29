<?php

namespace PB\ProduccionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormError;
use Lexik\Bundle\FormFilterBundle\Filter\Extension\Type\TextFilterType;
use Lexik\Bundle\FormFilterBundle\Filter\Extension\Type\NumberFilterType;
use PB\VentasBundle\Form\DataTransformer\ClilenteToIdTransformer;
use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Exception\ParseException;

class OrdenFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$hoy = new \DateTime();
    	$yaml = new Parser();
    	try {$value = $yaml->parse(file_get_contents(__DIR__ . '/../../VentasBundle/Resources/config/ventas.yml'));
    	} catch (ParseException $e) {
    		printf("Unable to parse the YAML string: %s", $e->getMessage());
    	}
    	$estados = $value['estados_pedidos'];
        $builder
            ->add('id', 'filter_number')
            ->add('cliente', 'filter_number')
            ->add('subcliente', 'filter_text',array( 'condition_pattern' => TextFilterType::PATTERN_CONTAINS))
            ->add('fecha', 'filter_date_range', array('left_date' => array('widget' => 'single_text',
            		'label' => '',           ),
            		'right_date' => array('widget' => 'single_text')
            ))
            ->add('estado','filter_choice', array('error_bubbling' => true, 'required' => false,'choices' => $estados,'empty_value' => ''))
            ->add('cantidad', 'filter_text')
            ->add('cantidaduni', 'filter_number_range')
            ->add('espesor', 'filter_text')
            ->add('espesoruni', 'filter_number_range')
            ->add('tipomaterial', 'filter_number_range')
            ->add('producto', 'filter_number_range')
            ->add('extrusion', 'filter_choice')
            ->add('color', 'filter_text')
            ->add('ancho', 'filter_text')
            ->add('largo', 'filter_text')
            ->add('galga', 'filter_number_range')
            ->add('plegado', 'filter_number_range')
            ->add('bobinas', 'filter_number_range')
            ->add('pesoteorico', 'filter_number_range')
            ->add('tratado', 'filter_number_range')
            ->add('tipotubo', 'filter_number_range')
            ->add('notasextrusion', 'filter_text')
            ->add('maquina_extrusion', 'filter_number_range')
            ->add('fecha_extrusion', 'filter_date_range')
            ->add('operario_extrusion', 'filter_text')
            ->add('kgfinal', 'filter_number_range')
            ->add('tiempo_extrusion', 'filter_text')
            ->add('impresion', 'filter_choice')
            ->add('medidaimp', 'filter_text')
            ->add('anverso', 'filter_text')
            ->add('reverso', 'filter_text')
            ->add('coloresa', 'filter_text')
            ->add('coloresr', 'filter_text')
            ->add('cliche', 'filter_number_range')
            ->add('carpeta', 'filter_text')
            ->add('soldadura', 'filter_number_range')
            ->add('notasimpresion', 'filter_text')
            ->add('maquina_impresion', 'filter_number_range')
            ->add('fecha_impresion', 'filter_date_range')
            ->add('operario_impresion', 'filter_text')
            ->add('tiempo_impresion', 'filter_text')
            ->add('corte', 'filter_choice')
            ->add('solapa', 'filter_number_range')
            ->add('paquete', 'filter_text')
            ->add('saco', 'filter_text')
            ->add('palets', 'filter_text')
            ->add('notas_corte', 'filter_text')
            ->add('maquina_corte', 'filter_number_range')
            ->add('fecha_corte', 'filter_date_range')
            ->add('tiempo_corte', 'filter_text')
            ->add('operario_corte', 'filter_text')
        ;

        $listener = function(FormEvent $event)
        {
            // Is data empty?
            foreach ($event->getData() as $data) {
                if(is_array($data)) {
                    foreach ($data as $subData) {
                        if(!empty($subData)) return;
                    }
                }
                else {
                    if(!empty($data)) return;
                }
            }

            $event->getForm()->addError(new FormError('Filter empty'));
        };
        $builder->addEventListener(FormEvents::POST_BIND, $listener);
    }

    public function getName()
    {
        return 'pb_produccionbundle_ordenfiltertype';
    }
}
