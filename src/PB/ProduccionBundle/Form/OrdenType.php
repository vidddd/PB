<?php

namespace PB\ProduccionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OrdenType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('subcliente')->add('cliente')
            ->add('fecha')
            ->add('estado')
            ->add('cantidad')
            ->add('cantidaduni')
            ->add('espesor')
            ->add('espesoruni')
            ->add('tipomaterial')
            ->add('producto')
            ->add('extrusion')
            ->add('color')
            ->add('ancho')
            ->add('largo')
            ->add('galga')
            ->add('plegado')
            ->add('bobinas')
            ->add('pesoteorico')
            ->add('tratado')
            ->add('tipotubo')
            ->add('notasextrusion')
            ->add('maquina_extrusion')
            ->add('fecha_extrusion')
            ->add('operario_extrusion')
            ->add('kgfinal')
            ->add('tiempo_extrusion')
            ->add('impresion')
            ->add('medidaimp')
            ->add('anverso')
            ->add('reverso')
            ->add('coloresa')
            ->add('coloresr')
            ->add('cliche')
            ->add('carpeta')
            ->add('soldadura')
            ->add('notasimpresion')
            ->add('maquina_impresion')
            ->add('fecha_impresion')
            ->add('operario_impresion')
            ->add('tiempo_impresion')
            ->add('corte')
            ->add('solapa')
            ->add('paquete')
            ->add('saco')
            ->add('palets')
            ->add('notas_corte')
            ->add('maquina_corte')
            ->add('fecha_corte')
            ->add('tiempo_corte')
            ->add('operario_corte')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PB\ProduccionBundle\Entity\Orden'
        ));
    }

    public function getName()
    {
        return 'pb_produccionbundle_ordentype';
    }
}
