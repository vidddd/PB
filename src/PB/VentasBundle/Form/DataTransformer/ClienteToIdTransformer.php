<?php

// src/PB/VentasBundle/Form/DataTransformer/ClienteToIdTransformer.php
namespace PB\VentasBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use PB\VentasBundle\Entity\Cliente;

class ClienteToIdTransformer implements DataTransformerInterface
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
     * Transforms an object (cliente) to a string (number).
     *
     * @param  Cliente|null $cliente
     * @return string
     */
    public function transform($cliente)
    {
        if (null === $cliente) {
            return "";
        }

        return $cliente->getId();
    }

    /**
     * Transforms a string (number) to an object (cliente).
     *
     * @param  string $id
     * @return Issue|null
     * @throws TransformationFailedException if object (cliente) is not found.
     */
    public function reverseTransform($id)
    {
        if (!$id) {
            return null;
        }

        $cliente = $this->om
            ->getRepository('PBVentasBundle:Cliente')
            ->findOneBy(array('id' => $id))
        ;

        if (null === $cliente) {
            throw new TransformationFailedException(sprintf(
                'El cliente con el id:"%s" no existe!',
                $id
            ));
        }

        return $cliente;
    }
}
