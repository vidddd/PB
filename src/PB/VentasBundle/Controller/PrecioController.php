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
 	$request = $this->getRequest();$session = $request->getSession();
    	
    	list($filterForm, $queryBuilder) = $this->filter();
    	if($this->getRequest()->get('cuantos')) { $cuantos = $this->getRequest()->get('cuantos');
    	} else if ($session->get('PrecioCompraCuantos')){ 		$cuantos = $session->get('PrecioCompraCuantos');
    	} else { $cuantos = 10;  	}
    	
        list($entities, $pagerHtml) = $this->paginator($queryBuilder, $cuantos);
        
        $cuantosarr = array('10' => '10','25' => '25','50' => '50','100' => '100');  
        if($cuantos) $session->set('PrecioCompraCuantos', $cuantos);
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
    
    protected function paginator($queryBuilder, $cuantos)
    {
        $adapter = new DoctrineORMAdapter($queryBuilder);
        $pagerfanta = new Pagerfanta($adapter);
        $currentPage = $this->getRequest()->get('page', 1);
        $pagerfanta->setMaxPerPage($cuantos);    $pagerfanta->setCurrentPage($currentPage);
        
        $entities = $pagerfanta->getCurrentPageResults();
        $me = $this;  $routeGenerator = function($page) use ($me)
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
        $em = $this->getDoctrine()->getManager(); $tarfia = false;
        $entity = $em->getRepository('PBVentasBundle:Precio')->find($id);
        if (!$entity) {throw $this->createNotFoundException('Unable to find Precio entity.');}
        $deleteForm = $this->createDeleteForm($id);
        return $this->render('PBVentasBundle:Precio:show.html.twig', array( 'entity'      => $entity, 'delete_form' => $deleteForm->createView(),        ));
    }

    public function newAction()
    {
    	$entity = new Precio();
         $tarifa = false;
        $form   = $this->createForm(new PrecioType(), $entity);
        return $this->render('PBVentasBundle:Precio:new.html.twig', array( 'entity' => $entity, 'tarifa'=> $tarifa, 'form'   => $form->createView(),));
    }

    public function createAction()
    {
        $entity  = new Precio();
        $request = $this->getRequest();
        $form    = $this->createForm(new PrecioType(), $entity);

        $form->bind($request); $tarifa = false;

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            foreach ($entity->getPrecioLineas() as $linea)
            {    	$linea->setPrecios($entity); }
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Nueva Tarifa Creada');

            return $this->redirect($this->generateUrl('precio_show', array('id' => $entity->getId())));        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.create.error');
        }

        return $this->render('PBVentasBundle:Precio:new.html.twig', array('entity' => $entity,'tarifa' => $tarifa, 'form'   => $form->createView(),));
    }

    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('PBVentasBundle:Precio')->find($id);
        // Las tarifas 1 y 2 son especiales
        if ($id == '1' || $id == '2') {
        	$tarifa = true;
        } else { $tarifa = false; }
        if (!$entity) {throw $this->createNotFoundException('No se ha encontrado la Tarifa.');}
        $editForm   = $this->createForm(new PrecioType(), $entity);
        $deleteForm = $this->createDeleteForm($id);
        return $this->render('PBVentasBundle:Precio:edit.html.twig', array('entity' => $entity, 'tarifa' => $tarifa, 'form'   => $editForm->createView(), 'delete_form' => $deleteForm->createView(), ));
    }

    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PBVentasBundle:Precio')->find($id);
        // Las tarifas 1 y 2 son especiales
        if ($id == '1' || $id == '2') {
        	$tarifa = true;
        } else { $tarifa = false;
        }
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

        return $this->render('PBVentasBundle:Precio:edit.html.twig', array('entity' => $entity,'tarifa' => $tarifa, 'form'   => $editForm->createView(),'delete_form' => $deleteForm->createView(),));
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
    				'error' => 'El cliente no tiene Tarifa de precios o el Código de cliente es erróneo', 'entity' => '', 'rel' => ''	
    		));
    	}
    	return $this->render('PBVentasBundle:Precio:buscador.html.twig', array(
    			'entity' => $entity, 'error' => '', 'rel'  => $back
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
	    			'entity' => $entity, 'pedido' => $pedido
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
    /**
     * Facturas B
     */
    public function buscadorFacturasbAction()
    {
    	$request = $this->getRequest();
    	$session = $request->getSession();
    	$busForm = $this->createForm(new BuscadorPreciosFacturaType());
    	$em = $this->getDoctrine()->getManager();
    	$queryBuilder = $this->getQueryFacturasB();
    	if ($request->getMethod() == 'POST' && $request->get('filter_action') == 'reset') {
    		$session->remove('BuscadorPrecioFacturaControllerFilter');
    	}
    	if ($request->getMethod() == 'POST' && $request->get('filter_action') == 'filter') {
    		$busForm->bind($request);
    		if ($busForm->isValid()) {
    			$filterData = $busForm->getData();
    			$queryBuilder = $this->getQueryFacturasB($filterData);
    			$session->set('BuscadorPrecioFacturaControllerFilter', $filterData);
    		}
    	} else {
    		if ($session->has('BuscadorPrecioFacturaControllerFilter')) {
    			$filterData = $session->get('BuscadorPrecioFacturaControllerFilter');
    			$busForm = $this->createForm(new BuscadorPreciosFacturaType(), $filterData);
    			$queryBuilder = $this->getQueryFacturasB($filterData);
    		}
    	}
    	$cuantosarr = array('10' => '10','25' => '25','50' => '50','100' => '100');
    	$cuantos = $this->getRequest()->get('cuantos');
    	($cuantos)? $entradas = $cuantos : $entradas = 10;
    
    	//var_dump($queryBuilder->getDql());
    	list($entities, $pagerHtml) = $this->paginatorBuscadorFacturasB($queryBuilder);
    	return $this->render('PBVentasBundle:Precio:buscadorFacturasB.html.twig', array(
    			'entities' => $entities, 'cuantos' => $cuantosarr, 'entradas' => $entradas,
    			'pagerHtml' => $pagerHtml,
    			'busForm' => $busForm->createView(),
    	));
    }
    /**
     * Facturas B
     * @param unknown_type $queryBuilder
     */
    protected function paginatorBuscadorFacturasB($queryBuilder)
    {
    	// Paginator
    	$adapter = new DoctrineORMAdapter($queryBuilder);
    	$pagerfanta = new Pagerfanta($adapter);
    	$currentPage = $this->getRequest()->get('page', 1);
    	$cuantos = $this->getRequest()->get('cuantos');
    	if($cuantos) {
    		$pagerfanta->setMaxPerPage($cuantos);
    	} else { $pagerfanta->setMaxPerPage(10);
    	}
    	$pagerfanta->setCurrentPage($currentPage);
    
    	$entities = $pagerfanta->getCurrentPageResults();
    	$me = $this;
    	$routeGenerator = function($page) use ($me)
    	{
    		return $me->generateUrl('precio_buscador_facturasb', array('page' => $page));
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
    
    function getQueryFacturasB($filterData = null){
    	$em = $this->getDoctrine()->getManager();
    	$qb = $em->getRepository('PBVentasBundle:FacturaBLinea')->createQueryBuilder('fl')->innerJoin('fl.facturaB', 'f')->orderBy('f.id', 'DESC');
    
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
    public function minoristaAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('PBVentasBundle:Precio')->find(1);
        if (!$entity) {throw $this->createNotFoundException('Unable to find Precio entity.');}
        $deleteForm = $this->createDeleteForm(1);
        return $this->render('PBVentasBundle:Tarifas:minorista.html.twig', array( 'entity'      => $entity, 'delete_form' => $deleteForm->createView(),        ));
   
    }
    public function mayoristaAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$entity = $em->getRepository('PBVentasBundle:Precio')->find(2);
    	if (!$entity) { throw $this->createNotFoundException('Unable to find Precio entity.'); }
    	$deleteForm = $this->createDeleteForm(2);
    	return $this->render('PBVentasBundle:Tarifas:mayorista.html.twig', array( 'entity' => $entity, 'delete_form' => $deleteForm->createView(),        ));
    	 
    }
    public function buscadorPrecioPresupuestoAction($id, $back)
    {
    	$em = $this->getDoctrine()->getManager();
    	$request = $this->get('request');
    	$rel = $request->query->get('rel');
    	$query = $em->createQuery('SELECT p FROM PBVentasBundle:Precio p WHERE p.cliente = :cliente ORDER BY p.fecha DESC')
    	->setParameter('cliente', $id)->setMaxResults(1);
    	$mayorista = $em->getRepository('PBVentasBundle:Precio')->find(2);
    	if (!$mayorista) {	throw $this->createNotFoundException('Unable to find Tarifa Mayorista entity.');}
    	$minorista = $em->getRepository('PBVentasBundle:Precio')->find(1);
    	if (!$minorista) { throw $this->createNotFoundException('Unable to find Tarifa Minorista entity.');}
    	 
    	try {
    		$entity = $query->getSingleResult();
    	} catch (\Doctrine\Orm\NoResultException $e) {
    		return $this->render('PBVentasBundle:Precio:buscadorPresupuestos.html.twig', array(
    				'error' => 'El cliente no tiene Tarifa de precios o el Código de cliente es erróneo',
    				'entity' => '', 'minorista' => $minorista, 'mayorista' => $mayorista,
    				'rel' => ''
    		));
    	}
    
    	return $this->render('PBVentasBundle:Precio:buscadorPresupuestos.html.twig', array(
    			'entity' => $entity, 'minorista' => $minorista, 'mayorista' => $mayorista,
    			'error' => '',
    			'rel'  => $back
    			//	'pagerHtml' => $pagerHtml,
    			//	'filterForm' => $filterForm->createView(),
    	));
    } 
    
    public function incrementarAction($id)
    {
    	$em = $this->getDoctrine()->getManager(); $tarifa = false;
    	$entity = $em->getRepository('PBVentasBundle:Precio')->find($id);
    	if (!$entity) {	throw $this->createNotFoundException('No se ha encontrado la Tarifa.');}
    	$form   = $this->createForm(new PrecioType(), $entity);
    	$request = $this->getRequest();

    	return $this->render('PBVentasBundle:Precio:incrementar.html.twig', array('precio' => $entity,'tarifa' => false, 'id' => $id, 'form'   => $form->createView()));
    }
    
    public function incrementarguardarAction($id){
    	$em = $this->getDoctrine()->getManager(); $tarifa = false;
    	$entity = $em->getRepository('PBVentasBundle:Precio')->find($id);
    	if (!$entity) { throw $this->createNotFoundException('No se ha encontrado la Tarifa.'); }
    	
    	$form   = $this->createForm(new PrecioType(), $entity);
    	$request = $this->getRequest();
    	$form->bind($request);

    	if ($form->isValid() && $request->get('incrementar_action') == 'incrementar') {
    		$incremento = $form['incremento']->getData();
    		$porcentaje = $form['porcentaje']->getData();
    		$ficha = $form['ficha']->getData();
			if($ficha) { // Se crea una tarifa nueva copiando los datos 
				$B = clone $entity;
				//$B = new Precio();
				$B->setId(null);
				switch ($incremento) {
					case 1:
						$B->setPorcentaje($porcentaje);
						break;
					case 2:
						$B->setPorcentajemenos($porcentaje);
						break;
				}
				
				$em->persist($B);
				$entity = $B;
				$form   = $this->createForm(new PrecioType(), $B);
			} else {
	    		switch ($incremento) {
	    			case 1:
	    				$entity->setPorcentaje($porcentaje);
	    				break;
	    			case 2:
	    				$entity->setPorcentajemenos($porcentaje);
	    				break;
	    		}
	    		$em->persist($entity);
	    		$form   = $this->createForm(new PrecioType(), $entity);
			}

    	}
    	if ($request->getMethod() == 'POST' && $request->get('guardar_action') == 'guardar') {
    		foreach ($entity->getPreciolineas() as $linea){
    			//echo $linea->getPrecio(); die;
    			//$linea->setPrecios($entity);
    			$entity->addPrecioLinea($linea);
    		}
    		 
    		if($form['id']->getData() == ''){
				$B = clone $entity;
				foreach ($entity->getPreciolineas() as $linea){
					$B->addPrecioLinea($linea);
				}
				$B->setId(null);
				$em->persist($B);
				$em->flush($B);
				$id = $B->getId(); 

				$this->get('session')->getFlashBag()->add('success', 'Creando nueva Tarifa de precios....');
			} else {
				$em->persist($entity);
    			$em->flush($entity);
			}
    		$this->get('session')->getFlashBag()->add('success', 'Tarifa de Precios Actualizada');	
    		return $this->redirect($this->generateUrl('precio_show', array('id' => $id)));
    	}
    	return $this->render('PBVentasBundle:Precio:incrementar.html.twig', array('precio' => $entity,'id' => $id, 'tarifa' => $tarifa, 'form'   => $form->createView()));
    	
    }
      /*
    private function getFormIncrementar($preciot, $precio){
    	$defaultData = array( 'incremento' => '' , 'porcentaje' => '', 'nuevo' => '', 'precio' => $precio);
    	$form = $this->createFormBuilder($defaultData)
    	->add('incremento', 'choice', array(
    						'choices' => array( '1' => 'Incrementar', '2' => 'Decrementar' ),
  						    'required'    => true, 'expanded' => true,
    						'empty_data'  => null))
    	->add('porcentaje', 'choice', array(
    						'choices' => array( '0' => '0', '1' => '1','2' => '2','3' => '3','4' => '4','5' => '5','6' => '6','7' => '7','8' => '8','9' => '9', '10' => '10'),
  						    'required'    => true, 'expanded' => false,
    					    'empty_data'  => null))
         ->add('ficha', 'checkbox', array(
    			'label'     => 'Show this entry publicly?',
    				'required'  => false,
			))	
		/*->add('precio', 'entity', array(
					'class' => 'PBVentasBundle:Precio',
					'data' => '',
			))
    	->getForm('');
    	return $form;
    }*/
}
