<?php
// src/PB/ComprasBundle/Form/DataTransformer/ProveedorToIdTransformer.php
namespace PB\ComprasBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use PB\ComprasBundle\Entity\proveedor;

class ProveedorToIdTransformer implements DataTransformerInterface
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

	/**
	 * Transforms an object (proveedor) to a string (number).
	 *
	 * @param  Proveedor|null $proveedor
	 * @return string
	 */
	public function transform($proveedor)
	{
		if (null === $proveedor) {
			return "";
		}

		return $proveedor->getId();
	}

	/**
	 * Transforms a string (number) to an object (proveedor).
	 *
	 * @param  string $id
	 * @return Issue|null
	 * @throws TransformationFailedException if object (proveedor) is not found.
	 */
	public function reverseTransform($id)
	{
		if (!$id) {
			return null;
		}

		$proveedor = $this->om
		->getRepository('PBComprasBundle:Proveedor')
		->findOneBy(array('id' => $id))
		;

		if (null === $proveedor) {
			throw new TransformationFailedException(sprintf(
					'El proveedor con el id:"%s" no existe!',
					$id
			));
		}

		return $proveedor;
	}
}