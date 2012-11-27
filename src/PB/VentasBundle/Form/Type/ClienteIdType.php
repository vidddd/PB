<?php
// src/PB/VentasBundle/Form/Type/ClienteIdType.php
namespace PB\VentasBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use PB\VentasBundle\Form\DataTransformer\ClienteToIdTransformer;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClienteIdType extends AbstractType
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
		$transformer = new ClienteToIdTransformer($this->om);
		$builder->addModelTransformer($transformer);
	}

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
				'invalid_message' => 'El código de cliente introducido no existe',
		));
	}

	public function getParent()
	{
		return 'text';
	}

	public function getName()
	{
		return 'cliente_text';
	}
}