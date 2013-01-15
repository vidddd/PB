<?php

namespace PB\AlmacenBundle\Form;

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
use Lexik\Bundle\FormFilterBundle\Filter\Expr;

class AlmacenFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', 'filter_number_range')
            ->add('referencia', 'filter_text',array( 'condition_pattern' => TextFilterType::PATTERN_CONTAINS, ))
            ->add('descripcion', 'filter_text',array( 'condition_pattern' => TextFilterType::PATTERN_CONTAINS, ))
            ->add('producto', 'filter_entity', array('class' => 'PB\AlmacenBundle\Entity\Producto'))
            ->add('cantidad', 'filter_number_range')
            ->add('paquete', 'filter_text')
            ->add('serie', 'filter_text')
            ->add('fecha_entrada', 'filter_date_range', array('left_date' => array('widget' => 'single_text',
		    															   'label' => 'aaaaa',
		    											//'format' => 'dd.MM.yyyy'
		    											),'right_date' => array('widget' => 'single_text')))
            ->add('ancho', 'filter_number')
            ->add('largo', 'filter_number')
            ->add('galga', 'filter_number')
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
        return 'almacenfilter';
    }
}
