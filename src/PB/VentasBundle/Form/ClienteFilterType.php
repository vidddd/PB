<?php

namespace PB\VentasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormError;
use Lexik\Bundle\FormFilterBundle\Filter\Extension\Type\TextFilterType;
use Doctrine\ORM\QueryBuilder;
use Lexik\Bundle\FormFilterBundle\Filter\Expr;


class ClienteFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', 'filter_number')
            ->add('codcliente', 'filter_number')
            ->add('nombre', 'filter_text',array( 'condition_pattern' => TextFilterType::PATTERN_CONTAINS, ))
            ->add('nif','filter_text', array( 'condition_pattern' => TextFilterType::PATTERN_CONTAINS ))
            ->add('localidad', 'filter_text',array( 'condition_pattern' => TextFilterType::PATTERN_CONTAINS, ))
            ->add('cp', 'filter_text')
            
            ->add('comercial_cliente','filter_entity', array('error_bubbling' => true, 'required' => false,
            		'class' => 'PBVentasBundle:Comercial',
            		'property' => 'nombre',
            		'apply_filter' => function (QueryBuilder $queryBuilder, Expr $expr, $field, array $values) {
            			if (!empty($values['value'])) {
            			//	$queryBuilder->leftJoin('e.comercial_cliente', 'f');
            			//	$queryBuilder->andWhere('f.id = :name')
            			//	->setParameter('name',$values['value']);
            			}	
            			$queryBuilder->getDQL();
            	
            		},
        //'empty_value' => ''
            		))
        /*
        ->add('comercial_cliente', 'filter_entity', array(
        		'label' => '',
        		'class' => 'PBVentasBundle:Comercial',
        		'empty_value' => 'Choose a Product Option'
        ))*/
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
        return 'clientefilter';
    }
}
