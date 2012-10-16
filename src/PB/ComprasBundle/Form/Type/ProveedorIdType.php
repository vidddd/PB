<?php
// src/PB/VentasBundle/Form/Type/ProveedorIdType.php
namespace PB\ComprasBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use PB\ComprasBundle\Form\DataTransformer\ProveedorToIdTransformer;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProveedorIdType extends AbstractType
{
	/**
	 * @var ObjectManager
	 */
	private $om;

	/**
	 * @param ObjectManager $om
	 */
	public function __construct(ObjectManager $om)
	{
		$this->om = $om;
	}

	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$transformer = new ProveedorToIdTransformer($this->om);
		$builder->addModelTransformer($transformer);
	}

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
				'invalid_message' => 'El Código de Proveedor introducido no existe',
		));
	}

	public function getParent()
	{
		return 'text';
	}

	public function getName()
	{
		return 'proveedor_text';
	}
}