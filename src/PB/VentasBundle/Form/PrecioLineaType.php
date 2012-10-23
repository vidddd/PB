<?php
namespace PB\VentasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PrecioLineaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        	//->add('codcliente')
        	->add('cantidad')
        	->add('concepto')
        	->add('medida')
        	->add('galga')
        	->add('precio');
    }
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
    	$resolver->setDefaults(array(
    			'data_class' => 'PB\VentasBundle\Entity\PrecioLinea'
    	));
    }
    
    public function getName()
    {
    	return 'preciolinea';
    }
}