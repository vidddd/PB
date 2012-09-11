<?php

namespace PB\VentasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ClienteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
    	$builder
            ->add('codcliente')
            ->add('nombre')
            ->add('nombrecomercial')
            ->add('nif')
            ->add('fechaalta')
            ->add('direccion')
            ->add('localidad')
            ->add('cp')
			->add('codprovincia', 'entity', array('class' => 'PBInicioBundle:Provincias',
					              'property' => 'denprovincia', 'empty_value' => 'Elige una provincia',
					/*'multiple'=>'true','query_builder' => function ($repository) {
							return $repository->createQueryBuilder('es')->orderBy('es.denprovincia', 'ASC');
							},
					 			   /*'query_builder' => function (\Doctrine\ORM\EntityRepository $repository)
						                 {
						                     return $repository->createQueryBuilder('l')
						                            ->where('l.status = ?1')
						                            ->setParameter(1, '1');
						                 }*/
						                ))
            ->add('provincia')
            ->add('pais')
            ->add('telefono')
            ->add('fax')
            ->add('movil')
            ->add('web')
            ->add('email')
            ->add('cuenta')
            ->add('descuento')
            ->add('recargo')
            ->add('observaciones')
            ->add('codfp')
            ->add('facturaciona')
            ->add('facturacionb')
            ->add('debea')
            ->add('habera')
            ->add('saldoa')
            ->add('debeb')
            ->add('haberb')
            ->add('saldob')
            ->add('albaranespendientes')
            ->add('albaranespendientesa')
            ->add('albaranespendientesb')
            ->add('codigoultimafactura')
            ->add('fechaultimafactura')
            ->add('codigoultimoalbaran')
            ->add('fechaultimoalbaran')
        ;
    }

    public function getName()
    {
        return 'pb_ventasbundle_clientetype';
    }
    
    public function getDefaultOptions(array $options)
    {
    	return array(
    			'data_class' => 'PB\VentasBundle\Entity\Cliente',
    	);
    }
}
