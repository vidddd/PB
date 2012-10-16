<?php

// src/Acme/TaskBundle/Form/Type/TaskType.php

namespace PB\VentasBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ClienteSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('codcliente', 'text', array('label' => 'Codigo de cliente', 'required' => false));
        $builder->add('nombre', 'text', array('required' => false));
        $builder->add('cp', 'text', array('label' => 'Código Postal', 'required' => false));
        $builder->add('localidad', 'text', array('required' => false));
        $builder->add('telefono', 'text', array('required' => false));
    }

    public function getName()
    {
        return 'clientesearch';
    }
}