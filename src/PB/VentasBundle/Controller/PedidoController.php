<?php

namespace PB\VentasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\View\TwitterBootstrapView;

use PB\VentasBundle\Entity\Pedido;
use PB\VentasBundle\Form\PedidoType;
use PB\VentasBundle\Form\PedidoFilterType;
use PB\VentasBundle\Printer\PrintPedido;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Exception\ParseException;

/**
 * Pedido controller.
 *
 */
class PedidoController extends Controller
{
    /**
     * Lists all Pedido entities.
     *
     */
    public function indexAction()
    {
    	$request = $this->getRequest();$session = $request->getSession();
    	
    	list($filterForm, $queryBuilder) = $this->filter();
    	if($this->getRequest()->get('cuantos')) {
    		$cuantos = $this->getRequest()->get('cuantos');
    	} else if ($session->get('PedidoCompraCuantos')){
    		$cuantos = $session->get('PedidoCompraCuantos');
    	} else { $cuantos = 10;
    	}
    	
        list($entities, $pagerHtml) = $this->paginator($queryBuilder, $cuantos);
        
        $cuantosarr = array('10' => '10','25' => '25','50' => '50','100' => '100');
        if($cuantos) $session->set('PedidoCompraCuantos', $cuantos);
        ($cuantos)? $entradas = $cuantos : $entradas = 10;
        
        
        return $this->render('PBVentasBundle:Pedido:index.html.twig', array(
            'entities' => $entities, 'cuantos' => $cuantosarr, 'entradas' => $entradas,
            'pagerHtml' => $pagerHtml,
            'filterForm' => $filterForm->createView(),
        ));
    }

    /**
    * Create filter form and process filter request.
    *
    */
    protected function filter()
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        $filterForm = $this->createForm(new PedidoFilterType());
        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('PBVentasBundle:Pedido')->createQueryBuilder('e')->orderBy('e.id', 'DESC');
    
        // Reset filter
        if ($request->getMethod() == 'POST' && $request->get('filter_action') == 'reset') {$session->remove('PedidoControllerFilter');}
    
        // Filter action
        if ($request->getMethod() == 'POST' && $request->get('filter_action') == 'filter') {
            // Bind values from the request
            $filterForm->bind($request);

            if ($filterForm->isValid()) {
                // Build the query from the given form object
                $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($filterForm, $queryBuilder);
                // Save filter to session
                $filterData = $filterForm->getData();
                $session->set('PedidoControllerFilter', $filterData);
            }
        } else {
            // Get filter from session
            if ($session->has('PedidoControllerFilter')) {
                $filterData = $session->get('PedidoControllerFilter');
                $filterForm = $this->createForm(new PedidoFilterType(), $filterData);
                $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($filterForm, $queryBuilder);
            }
        }
        return array($filterForm, $queryBuilder);
    }

    /**
    * Get results from paginator and get paginator view.
    *
    */
    protected function paginator($queryBuilder, $cuantos)
    {
        // Paginator
        $adapter = new DoctrineORMAdapter($queryBuilder);
        $pagerfanta = new Pagerfanta($adapter);
        $pagerfanta->setMaxPerPage(20);
        $currentPage = $this->getRequest()->get('page', 1);
        $pagerfanta->setMaxPerPage($cuantos);
        $pagerfanta->setCurrentPage($currentPage);
        $entities = $pagerfanta->getCurrentPageResults();
    
        // Paginator - route generator
        $me = $this;
        $routeGenerator = function($page) use ($me)
        {
            return $me->generateUrl('pedido', array('page' => $page));
        };
    
        // Paginator - view
        $translator = $this->get('translator');
        $view = new TwitterBootstrapView();
        $pagerHtml = $view->render($pagerfanta, $routeGenerator, array(
            'proximity' => 3,
            'prev_message' => $translator->trans('views.index.pagprev', array(), 'JordiLlonchCrudGeneratorBundle'),
            'next_message' => $translator->trans('views.index.pagnext', array(), 'JordiLlonchCrudGeneratorBundle'),
        ));
       // var_dump($queryBuilder->getDql());
        return array($entities, $pagerHtml);
    }
    
    /**
     * Finds and displays a Pedido entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('PBVentasBundle:Pedido')->find($id);
        if (!$entity) { throw $this->createNotFoundException('Unable to find Pedido entity.');}
        $deleteForm = $this->createDeleteForm($id);
        return $this->render('PBVentasBundle:Pedido:show.html.twig', array('entity'      => $entity,'delete_form' => $deleteForm->createView(),        ));
    }
    
    public function imprimirAction($id)
    {
    	$em = $this->getDoctrine()->getManager();
    	$yaml = new Parser(); try {	$value = $yaml->parse(file_get_contents(__DIR__ . '/../Resources/config/ventas.yml'));
    	} catch (ParseException $e) {
    		printf("Unable to parse the YAML string: %s", $e->getMessage());
    	}
    	
    	/*
    	$entity = $em->getRepository('PBVentasBundle:Pedido')->find($id);
    	if (!$entity) {	throw $this->createNotFoundException('No se puede encontrar el pedido.');}

    	$html = $this->renderView('PBVentasBundle:Pedido:print.html.twig', array('entity' => $entity));
    	 
    	$printer = new PrintPedido(); //HTML2PDF
    	$response = new Response($printer->getPdf($html));
    	$response->headers->set('Content-Type', 'application/pdf'); $response->headers->set('Content-Disposition', 'inline; filename="PedidoCompra.pdf"');
    	return $response;*/
    	
    	$printer = $this->container->get('ventas.print_pedido');
    	echo $fichero = $printer->printFPDF($id);
    	die;
    	$response = new Response();
    	$response->clearHttpHeaders();
    	$response->setContent(file_get_contents($fichero));
    	$response->headers->set('Content-Type', 'application/force-download');
    	$response->headers->set('Content-disposition', 'filename=Pedido.pdf');
    	return $response;
    }

    /**
     * Displays a form to create a new Pedido entity.
     *
     */
    public function newAction()
    {
        $entity = new Pedido();
        $form   = $this->createForm(new PedidoType(), $entity);
        return $this->render('PBVentasBundle:Pedido:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Pedido entity.
     *
     */
    public function createAction()
    {
        $entity  = new Pedido();
        $request = $this->getRequest();
        $form    = $this->createForm(new PedidoType(), $entity);
        $form->bind($request);
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.create.success');

            return $this->redirect($this->generateUrl('pedido_show', array('id' => $entity->getId())));        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.create.error');
        }

        return $this->render('PBVentasBundle:Pedido:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    /**
     * Displays a form to edit an existing Pedido entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PBVentasBundle:Pedido')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pedido entity.');
        }

        $editForm = $this->createForm(new PedidoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PBVentasBundle:Pedido:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Pedido entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PBVentasBundle:Pedido')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pedido entity.');
        }

        $editForm   = $this->createForm(new PedidoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.update.success');

            return $this->redirect($this->generateUrl('pedido_show', array('id' => $id)));
        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.update.error');
        }

        return $this->render('PBVentasBundle:Pedido:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Pedido entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PBVentasBundle:Pedido')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Pedido entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.delete.success');
        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.delete.error');
        }

        return $this->redirect($this->generateUrl('pedido'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    /**
     * Return a ajax response
     */
    public function getPedidoAction(){
    	$request = $this->get('request');
    	$id=$request->request->get('id');
    	$em = $this->get('doctrine')->getEntityManager();
    	 
    	$pedido = $em->getRepository('PBVentasBundle:Pedido')->findOneById($id);

    	if($pedido && is_numeric($id) && $id != '') {
    		$referencia = $pedido->getId();
    		$descripcion = $pedido->getMtycolor().' '.$pedido->getSubcliente();
    		$ancho = $pedido->getAnchoc();
    		$largo = $pedido->getLargoc();
    		$galga = $pedido->getGalga();
    		$precio = $pedido->getPrecio();
    		return new Response(json_encode(array('referencia' => $referencia, 'descripcion' => $descripcion, 'ancho' => $ancho, 'largo' => $largo, 'galga' => $galga, 'precio' =>$precio)));
    	} else {
    		return new Response(json_encode(array('nombre' => '<span class="error-nombre">Código de pedido erróneo</span>')));
    	}
    }
    public function buscadorPedidosClienteAction($id)
    {
    	$em = $this->getDoctrine()->getManager();
    	$request = $this->get('request');
    	$query = $em->createQuery('SELECT p FROM PBVentasBundle:Pedido p WHERE p.cliente = :cliente AND p.estado != :esta ORDER BY p.fecha DESC')
    	->setParameter('cliente', $id)->setParameter('esta', '8');
    	try {
    		$entity = $query->getResult();
    	} catch (\Doctrine\Orm\NoResultException $e) {
    		return $this->render('PBVentasBundle:Pedido:pedidos_cliente.html.twig', array(
    				'error' => 'El cliente no tiene Tarifa de precios o el Código de cliente es erróneo',
    				'entity' => ''
    		));
    	}
    
    	return $this->render('PBVentasBundle:Pedido:pedidos_cliente.html.twig', array(
    			'entity' => $entity,
    			'error' => '',
    	));
    }
    
    public function setEstadoPedido($id, $estado){
    	if (!$estado) {
    		throw $this->createNotFoundException('Falta el estado de pedido PedidoController->setEstadoPedido().');
    	}
    	if (!$id) {
    		throw $this->createNotFoundException('Falta código de pedido PedidoController->setEstadoPedido().');
    	}
    	$em = $this->get('doctrine')->getEntityManager();
    	$entity = $em->getRepository('PBVentasBundle:Pedido')->find($id);
    	$entity->setEstado($estado);
    	$em->persist($entity);
    	$em->flush();
    	
    }
}
