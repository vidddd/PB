<?php

namespace PB\ComprasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormError;
use Lexik\Bundle\FormFilterBundle\Filter\Extension\Type\TextFilterType;
use Lexik\Bundle\FormFilterBundle\Filter\Extension\Type\NumberFilterType;
use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Exception\ParseException;

class PedidoCompraFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$yaml = new Parser();
    	try {$value = $yaml->parse(file_get_contents(__DIR__ . '/../Resources/config/compras.yml'));} catch (ParseException $e) {printf("Unable to parse the YAML string: %s", $e->getMessage());}
    	
    	$estados = $value['estados'];
    	//$estados = $this->get('estados_pedidocompra');
        $builder
            ->add('id', 'filter_number')
            ->add('proveedor', 'filter_number')
            ->add('referencia', 'filter_text',array( 'condition_pattern' => TextFilterType::PATTERN_CONTAINS))
   		    ->add('fecha', 'filter_date_range', array('left_date' => array('widget' => 'single_text',
		    															   'label' => 'aaaaa',
		    											//'format' => 'dd.MM.yyyy'
		    											),
		    										   'right_date' => array('widget' => 'single_text')))
		    ->add('estado','filter_choice', array('error_bubbling' => true, 'required' => false,'choices' => $estados,'empty_value' => ''))
           
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
        return 'pb_comprasbundle_pedidocomprafiltertype';
    }
}
