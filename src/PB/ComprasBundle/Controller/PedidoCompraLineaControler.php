<?php

namespace PB\ComprasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\View\TwitterBootstrapView;

use PB\ComprasBundle\Entity\PedidoCompraLinea;
use PB\ComprasBundle\Form\PedidoCompraLineaType;

/**
 * PedidoCompra controller.
 *
 */
class PedidoCompraLineaController extends Controller
{
    /**
     * Lists all PedidoCompra entities.
     *
     */
    public function indexAction()
    {

    }
}