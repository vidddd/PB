<?php

namespace PB\ComprasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormError;
use Lexik\Bundle\FormFilterBundle\Filter\Extension\Type\TextFilterType;
use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Exception\ParseException;

use Lexik\Bundle\FormFilterBundle\Filter\Expr;
use Doctrine\ORM\QueryBuilder;

class ProveedorFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$hoy = new \DateTime();
    	$yaml = new Parser();
    	try {
    		$value = $yaml->parse(file_get_contents(__DIR__ . '/../Resources/config/compras.yml'));
    	} catch (ParseException $e) {
    		printf("Unable to parse the YAML string: %s", $e->getMessage());
    	}
    	$tipos = $value['tipo_proveedor'];
    	
        $builder
            ->add('id', 'filter_number')
            ->add('nombre', 'filter_text',array( 'condition_pattern' => TextFilterType::PATTERN_CONTAINS, ))
            ->add('nombrecomercial', 'filter_text',array( 'condition_pattern' => TextFilterType::PATTERN_CONTAINS, ))
            ->add('nif', 'filter_text',array( 'condition_pattern' => TextFilterType::PATTERN_CONTAINS, ))
            ->add('cp', 'filter_number')
            ->add('tipo_proveedor', 'filter_choice', array('error_bubbling' => true, 'required' => false,'choices' => $tipos))
            ->add('localidad', 'filter_text' ,array( 'condition_pattern' => TextFilterType::PATTERN_CONTAINS, ))
            
        ;

        $listener = function(FormEvent $event)
        {
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
        return 'proveedorfilter';
    }
}
