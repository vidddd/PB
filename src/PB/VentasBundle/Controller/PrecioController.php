<?php

namespace PB\VentasBundle\Controller;

use PB\VentasBundle\Entity\PrecioLinea;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\View\TwitterBootstrapView;

use PB\VentasBundle\Entity\Precio;
use PB\VentasBundle\Form\PrecioType;
use PB\VentasBundle\Form\PrecioFilterType;
use Symfony\Component\HttpFoundation\Response;
use PB\VentasBundle\Form\buscador\BuscadorPreciosFacturaType;

class PrecioController extends Controller
{
    public function indexAction()
    {
        list($filterForm, $queryBuilder) = $this->filter();
        list($entities, $pagerHtml) = $this->paginator($queryBuilder);
        $cuantosarr = array('10' => '10','25' => '25','50' => '50','100' => '100');
        $cuantos = $this->getRequest()->get('cuantos');
        ($cuantos)? $entradas = $cuantos : $entradas = 10;
        return $this->render('PBVentasBundle:Precio:index.html.twig', array(
            'entities' => $entities,  'cuantos' => $cuantosarr, 'entradas' => $entradas,
            'pagerHtml' => $pagerHtml,
            'filterForm' => $filterForm->createView(),
        ));
    }

    protected function filter()
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        $filterForm = $this->createForm(new PrecioFilterType());
        $em = $this->getDoctrine()->getManager();
        
        $queryBuilder = $em->getRepository('PBVentasBundle:Precio')->createQueryBuilder('e')->orderBy('e.id', 'DESC');
        if ($request->getMethod() == 'POST' && $request->get('filter_action') == 'reset') {$session->remove('PrecioControllerFilter');}
        if ($request->getMethod() == 'POST' && $request->get('filter_action') == 'filter') {
            $filterForm->bind($request);
            if ($filterForm->isValid()) {
                $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($filterForm, $queryBuilder);
                $filterData = $filterForm->getData();
                $session->set('PrecioControllerFilter', $filterData);
            }
        } else {
            if ($session->has('PrecioControllerFilter')) {
                $filterData = $session->get('PrecioControllerFilter');
                $filterForm = $this->createForm(new PrecioFilterType(), $filterData);
                $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($filterForm, $queryBuilder);
            }
        } return array($filterForm, $queryBuilder);
    }
    
    protected function paginator($queryBuilder)
    {
        // Paginator
        $adapter = new DoctrineORMAdapter($queryBuilder);
        $pagerfanta = new Pagerfanta($adapter);
        $currentPage = $this->getRequest()->get('page', 1);
        $cuantos = $this->getRequest()->get('cuantos');
        if($cuantos) {
        	$pagerfanta->setMaxPerPage($cuantos);
        } else {
        	$pagerfanta->setMaxPerPage(10);
        }
        $pagerfanta->setCurrentPage($currentPage);
        
        $entities = $pagerfanta->getCurrentPageResults();
        $me = $this;
        $routeGenerator = function($page) use ($me)
        {
            return $me->generateUrl('precio', array('page' => $page));
        };
        $translator = $this->get('translator');
        $view = new TwitterBootstrapView();
        $pagerHtml = $view->render($pagerfanta, $routeGenerator, array(
            'proximity' => 3,
            'prev_message' => $translator->trans('views.index.pagprev', array(), 'JordiLlonchCrudGeneratorBundle'),
            'next_message' => $translator->trans('views.index.pagnext', array(), 'JordiLlonchCrudGeneratorBundle'),
        ));
        return array($entities, $pagerHtml);
    }
    
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('PBVentasBundle:Precio')->find($id);
        if (!$entity) {throw $this->createNotFoundException('Unable to find Precio entity.');}
        $deleteForm = $this->createDeleteForm($id);
        return $this->render('PBVentasBundle:Precio:show.html.twig', array( 'entity'      => $entity, 'delete_form' => $deleteForm->createView(),        ));
    }

    public function newAction()
    {
        $entity = new Precio();
        $form   = $this->createForm(new PrecioType(), $entity);

        return $this->render('PBVentasBundle:Precio:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function createAction()
    {
        $entity  = new Precio();
        $request = $this->getRequest();
        $form    = $this->createForm(new PrecioType(), $entity);

        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            foreach ($entity->getPrecioLineas() as $linea)
            {
            	$linea->setPrecios($entity);
            }
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Nueva Tarifa Creada');

            return $this->redirect($this->generateUrl('precio_show', array('id' => $entity->getId())));        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.create.error');
        }

        return $this->render('PBVentasBundle:Precio:new.html.twig', array('entity' => $entity,'form'   => $form->createView(),));
    }

    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('PBVentasBundle:Precio')->find($id);
        if (!$entity) {throw $this->createNotFoundException('No se ha encontrado la Tarifa.');}
        $editForm = $this->createForm(new PrecioType(), $entity);
        $deleteForm = $this->createDeleteForm($id);
        return $this->render('PBVentasBundle:Precio:edit.html.twig', array('entity' => $entity, 'form'   => $editForm->createView(), 'delete_form' => $deleteForm->createView(), ));
    }

    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PBVentasBundle:Precio')->find($id);

        if (!$entity) { throw $this->createNotFoundException('No se ha encontrado la Tarifa.');}

        $beforeSaveLineas = $currentLineasIds = array();
        foreach ($entity->getPreciolineas() as $linea)
        	$beforeSaveLineas [$linea->getId()] = $linea;
        
        $editForm   = $this->createForm(new PrecioType(), $entity);
        $deleteForm = $this->createDeleteForm($id);
        $request = $this->getRequest();
        $editForm->bind($request);
        
        if ($editForm->isValid()) {
        	foreach ($entity->getPreciolineas() as $linea){
        		$linea->setPrecios($entity);
        		if ($linea->getId()) $currentLineasIds[] = $linea->getId();
        	}
        	
            $em->persist($entity);
            
            foreach ($beforeSaveLineas as $lineaId => $linea){
            	if (!in_array( $lineaId, $currentLineasIds)){
            		$em->remove($linea);
            	}
            }
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.update.success');

            return $this->redirect($this->generateUrl('precio_show', array('id' => $id)));
        } else { $this->get('session')->getFlashBag()->add('error', 'flash.update.error');}

        return $this->render('PBVentasBundle:Precio:edit.html.twig', array('entity'      => $entity,'form'   => $editForm->createView(),'delete_form' => $deleteForm->createView(),));
    }

    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();
        $form->bind($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PBVentasBundle:Precio')->find($id);
            if (!$entity) {throw $this->createNotFoundException('Unable to find Precio entity.');}
            $em->remove($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.delete.success');
        } else {$this->get('session')->getFlashBag()->add('error', 'flash.delete.error');}

        return $this->redirect($this->generateUrl('precio'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))->add('id', 'hidden')->getForm();
    }
    public function imprimirAction($id)
    {
    	$printer = $this->container->get('ventas.print_precios');
    	$fichero = $printer->printFPDF($id);
    	$response = new Response();
    	$response->clearHttpHeaders();
    	$response->setContent(file_get_contents($fichier));
    	$response->headers->set('Content-Type', 'application/force-download');
    	$response->headers->set('Content-disposition', 'filename='. $fichier);
    	return $response;

    }
    public function buscadorPrecioAction($id)
    {
    	$em = $this->getDoctrine()->getManager();

    	$query = $em->createQuery('SELECT p FROM PBVentasBundle:Precio p WHERE p.cliente = :cliente ORDER BY p.fecha DESC')
    								->setParameter('cliente', $id)->setMaxResults(1);
		try {
		    $entity = $query->getSingleResult();
		} catch (\Doctrine\Orm\NoResultException $e) {
		   return $this->render('PBVentasBundle:Precio:buscador.html.twig', array(
    			'error' => 'El cliente no tiene Tarifa de precios o el Código de cliente es erróneo',
		   		'entity' => '','rel' => ''
    		));
		}

    	return $this->render('PBVentasBundle:Precio:buscador.html.twig', array(
    			'entity' => $entity,
    			'error' => '', 
    			'rel' => ''
    				
    	));
    }
    public function buscadorPrecioAlbaranAction($id, $back)
    {
    	$em = $this->getDoctrine()->getManager();
    	$request = $this->get('request');
    	$rel = $request->query->get('rel');
    	$query = $em->createQuery('SELECT p FROM PBVentasBundle:Precio p WHERE p.cliente = :cliente ORDER BY p.fecha DESC')
    	->setParameter('cliente', $id)->setMaxResults(1);
    	try {
    		$entity = $query->getSingleResult();
    	} catch (\Doctrine\Orm\NoResultException $e) {
    		return $this->render('PBVentasBundle:Precio:buscador.html.twig', array(
    				'error' => 'El cliente no tiene Tarifa de precios o el Código de cliente es erróneo',
    				'entity' => '',
    				'rel' => ''	
    		));
    	}
    	 
    	return $this->render('PBVentasBundle:Precio:buscador.html.twig', array(
    			'entity' => $entity,
    			'error' => '',
    			'rel'  => $back
    			//	'pagerHtml' => $pagerHtml,
    			//	'filterForm' => $filterForm->createView(),
    	));
    }
    
    public function calcularPrecioAction($id)
    {
    	$em = $this->getDoctrine()->getManager();
    	$pedido = $em->getRepository('PBVentasBundle:Pedido')->find($id);
    	$cliente = $pedido->getCliente();
    	$request = $this->get('request');
    	
    	if ($request->getMethod() == 'POST'){
    		if($request->get('preciomillar')) {
    			$precio = $request->get('preciomillar');
    		} else {
    			$precio = $request->get('preciokg');
    		}
    		$pedido->setPrecio($precio);
    		$em->persist($pedido); 		$em->flush();
    		$this->get('session')->getFlashBag()->add('success', 'Precio de Pedido Actualizado');
    		
    		//return $this->redirect($this->generateUrl('pedido_show', array('id' => $id)));
    		return $this->redirect($this->generateUrl('pedido'));
    	} else {

	    	$query = $em->createQuery('SELECT p FROM PBVentasBundle:Precio p WHERE p.cliente = :cliente ORDER BY p.fecha DESC')
	    	->setParameter('cliente', $cliente->getId())->setMaxResults(1);
	    	try {
	    		$entity = $query->getSingleResult();
	    	} catch (\Doctrine\Orm\NoResultException $e) {
	    		throw $this->createNotFoundException('No se ha encontrado la Tarifa.');
	    	}
	    	$em = $this->getDoctrine()->getManager();
	    	return $this->render('PBVentasBundle:Precio:calcular.html.twig', array(
	    			'entity' => $entity,
	    			'pedido' => $pedido
	    	));
    	}
    }
    public function buscadorFacturasAction()
    {
    	$request = $this->getRequest();
        $session = $request->getSession();
        $busForm = $this->createForm(new BuscadorPreciosFacturaType());
        $em = $this->getDoctrine()->getManager(); 
        $queryBuilder = $this->getQueryFacturas();
        if ($request->getMethod() == 'POST' && $request->get('filter_action') == 'reset') {
        	$session->remove('BuscadorPrecioFacturaControllerFilter');
        }
        if ($request->getMethod() == 'POST' && $request->get('filter_action') == 'filter') {
        	$busForm->bind($request);
        	if ($busForm->isValid()) {
        		$filterData = $busForm->getData();
        		$queryBuilder = $this->getQueryFacturas($filterData);
        		$session->set('BuscadorPrecioFacturaControllerFilter', $filterData);
        	}
        } else {
        	if ($session->has('BuscadorPrecioFacturaControllerFilter')) {
        		$filterData = $session->get('BuscadorPrecioFacturaControllerFilter');
        		$busForm = $this->createForm(new BuscadorPreciosFacturaType(), $filterData);
        		$queryBuilder = $this->getQueryFacturas($filterData);
        	}
        }
        $cuantosarr = array('10' => '10','25' => '25','50' => '50','100' => '100');
        $cuantos = $this->getRequest()->get('cuantos');
        ($cuantos)? $entradas = $cuantos : $entradas = 10;

        //var_dump($queryBuilder->getDql());
        list($entities, $pagerHtml) = $this->paginatorBuscadorFacturas($queryBuilder);
    	return $this->render('PBVentasBundle:Precio:buscadorFacturas.html.twig', array(
    			'entities' => $entities, 'cuantos' => $cuantosarr, 'entradas' => $entradas,
    			'pagerHtml' => $pagerHtml,
    			'busForm' => $busForm->createView(),
    	));
    }
    
    protected function paginatorBuscadorFacturas($queryBuilder)
    {
    	// Paginator
    	$adapter = new DoctrineORMAdapter($queryBuilder);
    	$pagerfanta = new Pagerfanta($adapter);
    	$currentPage = $this->getRequest()->get('page', 1);
    	$cuantos = $this->getRequest()->get('cuantos');
    	if($cuantos) { $pagerfanta->setMaxPerPage($cuantos);} else { $pagerfanta->setMaxPerPage(10);}
    	$pagerfanta->setCurrentPage($currentPage);
    
    	$entities = $pagerfanta->getCurrentPageResults();
    	$me = $this;
    	$routeGenerator = function($page) use ($me)
    	{
    		return $me->generateUrl('precio_buscador_facturas', array('page' => $page));
    	};
    	$translator = $this->get('translator');
    	$view = new TwitterBootstrapView();
    	$pagerHtml = $view->render($pagerfanta, $routeGenerator, array(
    			'proximity' => 3,
    			'prev_message' => $translator->trans('views.index.pagprev', array(), 'JordiLlonchCrudGeneratorBundle'),
    			'next_message' => $translator->trans('views.index.pagnext', array(), 'JordiLlonchCrudGeneratorBundle'),
    	));
    	return array($entities, $pagerHtml);
    }
    function getQueryFacturas($filterData = null){
    	$em = $this->getDoctrine()->getManager();
    	$qb = $em->getRepository('PBVentasBundle:FacturaLinea')->createQueryBuilder('fl')->innerJoin('fl.factura', 'f')->orderBy('f.id', 'DESC');

    	if (!empty($filterData['cliente'])) {
    		$qb->where('f.cliente = :clientei'); // we don't want to include the category we're deleting
    		$qb->setParameter('clientei', $filterData['cliente']);
    	}
    	if (!empty($filterData['codfactura'])) {
    		$qb->andwhere('f.id = :codfacturai'); // we don't want to include the category we're deleting
    		$qb->setParameter('codfacturai', $filterData['codfactura']);
    	}
    	if (!empty($filterData['codpedido'])) {
    		$qb->andwhere('fl.referencia LIKE :referenciai'); // we don't want to include the category we're deleting
    		$qb->setParameter('referenciai', '%'.$filterData['codpedido'].'%');
    	}
    	if (!empty($filterData['concepto'])) {
    		$qb->andwhere('fl.descripcion LIKE :conceptoi'); // we don't want to include the category we're deleting
    		$qb->setParameter('conceptoi', '%'.$filterData['concepto'].'%');
    	}
    	if (!empty($filterData['ancho'])) {
    		$qb->andwhere('fl.ancho = :anchoi'); // we don't want to include the category we're deleting
    		$qb->setParameter('anchoi', $filterData['ancho']);
    	}
    	return $qb;	
    }
}
