<?php

// src/PB/VentasBundle/Form/DataTransformer/ClienteToIdTransformer.php
namespace PB\VentasBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use PB\VentasBundle\Entity\PedidoCliente;

class PedidoClienteToIdTransformer implements DataTransformerInterface
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
     * Transforms an object (pedidocliente) to a string (number).
     *
     * @param  PedidoCliente|null $pedidocliente
     * @return string
     */
    public function transform($pedidocliente)
    {
        if (null === $pedidocliente) {
            return "";
        }

        return $pedidocliente->getId();
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
        if (!$id) { return null;}

        $pedidocliente = $this->om
            ->getRepository('PBVentasBundle:PedidoCliente')
            ->findOneBy(array('id' => $id))
        ;

        if (null === $pedidocliente) {
            throw new TransformationFailedException(sprintf(
                'El pedido con el id:"%s" no existe!',
                $id
            ));
        }

        return $pedidocliente;
    }
}