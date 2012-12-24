<?php

namespace PB\VentasBundle\Form;

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

class PedidoFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$hoy = new \DateTime();
    	$yaml = new Parser();
    	try {$value = $yaml->parse(file_get_contents(__DIR__ . '/../Resources/config/ventas.yml'));
    	} catch (ParseException $e) {
    		printf("Unable to parse the YAML string: %s", $e->getMessage());
    	}
    	 
    	$estados = $value['estados_pedidos'];
        $builder
            ->add('id', 'filter_number')
            ->add('cliente', 'filter_number')->add('anchoc', 'filter_number')
            ->add('subcliente', 'filter_text',array( 'condition_pattern' => TextFilterType::PATTERN_CONTAINS))
    		->add('estado','filter_choice', array('error_bubbling' => true, 'required' => false,'choices' => $estados,'empty_value' => ''))
           
		    ->add('fecha', 'filter_date_range', array('left_date' => array('widget' => 'single_text',
		    															   'label' => 'aaaaa',
		    											//'format' => 'dd.MM.yyyy'
		    											),
		    										   'right_date' => array('widget' => 'single_text')
		    									 ))

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

            $event->getForm()->addError(new FormError('Filtros vacios'));
        };
        $builder->addEventListener(FormEvents::POST_BIND, $listener);
    }

    public function getName()
    {
        return 'pedidofiltertype';
    }
}
