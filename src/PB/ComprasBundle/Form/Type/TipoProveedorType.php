<?php 
namespace PB\ComprasBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class TipoProveedorType extends AbstractType
{
    public function getDefaultOptions(array $options)
    {
        return array(
            'choices' => array(
                '1' => 'Nuevo',
                '2' => 'En Fabrica',
             	'3' => 'Fabricado',
            	'4' => 'Entregado',
            	'5' => 'Devuelto'
            )
        );
    }

    public function getParent(array $options)
    {
        return 'choice';
    }

    public function getName()
    {
        return 'estados';
    }
}
