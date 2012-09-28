<?php

namespace PB\ComprasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormError;

use Lexik\Bundle\FormFilterBundle\Filter\Expr;
use Doctrine\ORM\QueryBuilder;

class ProveedorFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', 'filter_number_range')
            ->add('nombre', 'filter_text', array(
            'apply_filter' => function (QueryBuilder $queryBuilder, Expr $expr, $field, array $values) {

                // add conditions you need :)

		            },
		        ))
            ->add('nombrecomercial', 'filter_text')
            ->add('nif', 'filter_text')
            ->add('nombrecontacto', 'filter_text')
            ->add('telefono_contacto', 'filter_number_range')
            ->add('email_contacto', 'filter_text')
            ->add('telefono', 'filter_number_range')
            ->add('fax', 'filter_number_range')
            ->add('email', 'filter_text')
            ->add('direccion', 'filter_text')
            ->add('cp', 'filter_number_range')
            ->add('localidad', 'filter_text')
            ->add('provincia', 'filter_number_range')
            ->add('pais', 'filter_text')
            ->add('tipo_proveedor', 'filter_number_range')
          /*  ->add('es_cliente', 'filter_choice')->add('activo', 'filter_choice')->add('observaciones', 'filter_text')  ->add('medio_envio', 'filter_number_range')  ->add('paga_iva', 'filter_choice')->add('irpf', 'filter_choice')->add('codigo_formapago', 'filter_number_range')
            ->add('codigo_externo', 'filter_number_range')
            ->add('cuenta_bancaria', 'filter_text')
            ->add('codigo_contabilidad', 'filter_text')
            ->add('fechaalta', 'filter_date_range')*/
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
        return 'pb_comprasbundle_proveedorfiltertype';
    }
}
