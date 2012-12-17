<?php

namespace PB\VentasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\View\TwitterBootstrapView;

use PB\VentasBundle\Entity\Albaran;
use PB\VentasBundle\Form\AlbaranType;
use PB\VentasBundle\Form\AlbaranFilterType;
use PB\VentasBundle\Entity\Factura;
use PB\VentasBundle\Entity\FacturaLinea;
use PB\VentasBundle\Form\FacturaType;
use PB\VentasBundle\Form\FacturaBType;
use PB\VentasBundle\Entity\FacturaB;
use PB\VentasBundle\Entity\FacturaBLinea;

/**
 * Albaran controller.
 *
 */
class AlbaranController extends Controller
{
    /**
     * Lists all Albaran entities.
     *
     */
    public function indexAction()
    {
 	$request = $this->getRequest();$session = $request->getSession();
    	
    	list($filterForm, $queryBuilder) = $this->filter();
    	if($this->getRequest()->get('cuantos')) {
    		$cuantos = $this->getRequest()->get('cuantos');
    	} else if ($session->get('AlbaranCompraCuantos')){
    		$cuantos = $session->get('AlbaranCompraCuantos');
    	} else { $cuantos = 10;
    	}
    	
        list($entities, $pagerHtml) = $this->paginator($queryBuilder, $cuantos);
        
        $cuantosarr = array('10' => '10','25' => '25','50' => '50','100' => '100');  
        if($cuantos) $session->set('AlbaranCompraCuantos', $cuantos);
        ($cuantos)? $entradas = $cuantos : $entradas = 10;
        
        return $this->render('PBVentasBundle:Albaran:index.html.twig', array(
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
        $filterForm = $this->createForm(new AlbaranFilterType());
        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('PBVentasBundle:Albaran')->createQueryBuilder('e')->orderBy('e.id', 'DESC');
        
        if ($request->getMethod() == 'POST' && $request->get('filter_action') == 'reset') {
        	$session->remove('AlbaranControllerFilter');
        }
        
    	$fil = $request->get('albaranfilter'); 
    	$filses = $session->get('AlbaranControllerFilter');
    	// Si hay session

    	if($filses || $request->get('filter_action') == 'filter'){
    		($request->get('filter_action') == 'filter') ? $factu = $fil['facturados'] : $factu = $filses['facturados']; ;
	        if ($request->getMethod() == 'POST' && $fil['facturados']){
	        	$factu = $fil['facturados'];
	        }
	        switch ($factu){
	        	case 1:
	        		$queryBuilder->andWhere("e.codfactura != ''");
	        		break;
	        	case 2:
	        		$queryBuilder->andWhere("e.codfactura = ''");
	        		$queryBuilder->orWhere("e.codfactura is NULL");
	        		break;
	        }
    	}
        if ($request->getMethod() == 'POST' && $request->get('filter_action') == 'filter') {
            $filterForm->bind($request);

            if ($filterForm->isValid()) {
                $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($filterForm, $queryBuilder);
                $filterData = $filterForm->getData();
                $session->set('AlbaranControllerFilter', $filterData);
            }
        } else {
            if ($session->has('AlbaranControllerFilter')) {
                $filterData = $session->get('AlbaranControllerFilter');
                $filterForm = $this->createForm(new AlbaranFilterType(), $filterData);
                $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($filterForm, $queryBuilder);
            }
        }
        //var_dump($queryBuilder->getDql());
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
        $currentPage = $this->getRequest()->get('page', 1);
      	$pagerfanta->setMaxPerPage($cuantos);
        
        $pagerfanta->setCurrentPage($currentPage);
        $entities = $pagerfanta->getCurrentPageResults();
    
        // Paginator - route generator
        $me = $this;
        $routeGenerator = function($page) use ($me)
        {
            return $me->generateUrl('albaran', array('page' => $page));
        };
    
        // Paginator - view
        $translator = $this->get('translator');
        $view = new TwitterBootstrapView();
        $pagerHtml = $view->render($pagerfanta, $routeGenerator, array(
            'proximity' => 3,
            'prev_message' => $translator->trans('views.index.pagprev', array(), 'JordiLlonchCrudGeneratorBundle'),
            'next_message' => $translator->trans('views.index.pagnext', array(), 'JordiLlonchCrudGeneratorBundle'),
        ));
    
        return array($entities, $pagerHtml);
    }
    
    /**
     * Finds and displays a Albaran entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PBVentasBundle:Albaran')->find($id);

        if (!$entity) { throw $this->createNotFoundException('Unable to find Albaran entity.');}

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PBVentasBundle:Albaran:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }
    
    public function prenewAction()
    {
    	$entity = new Albaran();
    	$hoy = new \DateTime();
    	$entity->setFecha($hoy);
    	$form   = $this->createForm(new AlbaranType(), $entity);
    
    	return $this->render('PBVentasBundle:Albaran:new.html.twig', array(
    			'entity' => $entity,
    			'formstep' => 1,
    			'form'   => $form->createView(),
    	));
    }
    
    /**
     * Displays a form to create a new Albaran entity.
     *
     */
    public function newAction()
    {
        $entity  = new Albaran();
        $request = $this->getRequest();
        $form    = $this->createForm(new AlbaranType(), $entity);
        $form->bind($request);
        
        if ($form->isValid()) {
        	$em = $this->getDoctrine()->getManager();
        	$em->persist($entity);
	    	return $this->render('PBVentasBundle:Albaran:new.html.twig', array(
	    			'entity' => $entity,
	    			'formstep' => 2,
	    			'form'   => $form->createView(),
	    	));
        }
        return $this->render('PBVentasBundle:Albaran:new.html.twig', array(
        		'entity' => $entity,
        		'formstep' => 1,
        		'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Albaran entity.
     *
     */
    public function createAction()
    {
        $entity  = new Albaran();
        $request = $this->getRequest();
        $form    = $this->createForm(new AlbaranType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $id = $entity->getId();
            foreach ($entity->getAlbaranLineas() as $linea)
            {
            	$linea->setAlbaran($entity);
            	// Cambiamos a facturado los pedidos
            	$codpedido = $linea->getCodpedido();
            	if($codpedido) {
            		$this->setEstadoPedido($codpedido,8);
            	}
            }
            $em->persist($entity);
            
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Nuevo Albaran Creado');

            return $this->redirect($this->generateUrl('albaran', array('id' => $entity->getId())));        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.create.error');
        }

        return $this->render('PBVentasBundle:Albaran:new.html.twig', array(
            'entity' => $entity, 'formstep' => 2,
            'form'   => $form->createView(),
        ));
    }
    /**
     * Displays a form to edit an existing Albaran entity.
     *
     */
    public function preeditAction($id)
    {
    	$em = $this->getDoctrine()->getManager();
    	$entity = $em->getRepository('PBVentasBundle:Albaran')->find($id);
    	if (!$entity) {	throw $this->createNotFoundException('Unable to find Albaran entity.');}
    	$editForm = $this->createForm(new AlbaranType(), $entity);
    	$deleteForm = $this->createDeleteForm($id);
    
    	return $this->render('PBVentasBundle:Albaran:edit.html.twig', array(
    			'entity'      => $entity,'formstep' => 1,
    			'form'   => $editForm->createView(),
    			'delete_form' => $deleteForm->createView(),
    	));
    }
    
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $entity = $em->getRepository('PBVentasBundle:Albaran')->find($id);

        if (!$entity) {   throw $this->createNotFoundException('Unable to find Albaran entity.'); }

        $form   = $this->createForm(new AlbaranType(), $entity);
        $deleteForm = $this->createDeleteForm($id);
        $form->bind($request);
        
        if ($form->isValid()) {
        	$em->persist($entity);
        	return $this->render('PBVentasBundle:Albaran:edit.html.twig', array(
        			'entity'      => $entity, 'formstep' => 2,
        			'form'   => $form->createView(),
        			'delete_form' => $deleteForm->createView(),
        	));
        }
        
        return $this->render('PBVentasBundle:Albaran:edit.html.twig', array(
        			'entity'      => $entity, 'formstep' => 1,
        			'form'   => $form->createView(),
        			'delete_form' => $deleteForm->createView(),
        	));
    
    }

    /**
     * Edits an existing Albaran entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PBVentasBundle:Albaran')->find($id);

        if (!$entity) {  throw $this->createNotFoundException('Unable to find Albaran entity.');}
        
        $beforeSaveLineas = $currentLineasIds = array();
        foreach ($entity->getAlbaranlineas() as $linea)
        	$beforeSaveLineas [$linea->getId()] = $linea;
        
        $editForm   = $this->createForm(new AlbaranType(), $entity);
        $deleteForm = $this->createDeleteForm($id);
        $request = $this->getRequest();
        $editForm->bind($request);

        if ($editForm->isValid()) {
        	foreach ($entity->getAlbaranlineas() as $linea){
        		$linea->setAlbaran($entity);
        		if ($linea->getId()) $currentLineasIds[] = $linea->getId();
        	}
            $em->persist($entity);
            foreach ($beforeSaveLineas as $lineaId => $linea){
            	if (!in_array( $lineaId, $currentLineasIds)){
            		$em->remove($linea);
            	}
            }
            foreach ($entity->getAlbaranLineas() as $linea)
            {
            	$codpedido = $linea->getCodpedido();
            	if($codpedido) {
            		//Pone los estados de pedido a facturado
            		$this->setEstadoPedido($codpedido,8);
            	}
            }
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Albaran: '.$id.' Actualizado');

            return $this->redirect($this->generateUrl('albaran', array('id' => $id)));
        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.update.error');
        }

        return $this->render('PBVentasBundle:Albaran:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Albaran entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PBVentasBundle:Albaran')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Albaran entity.');
            }
            $em->remove($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.delete.success');
        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.delete.error');
        }

        return $this->redirect($this->generateUrl('albaran'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    public function imprimirAction($id)
    {
    	$printer = $this->container->get('ventas.print_albaran');
    	$fichero = $printer->printFPDF($id);
    	$response = new Response();
    	$response->clearHttpHeaders();
    	$response->setContent(file_get_contents($fichier));
    	//$response->headers->set('Content-Type', 'application/force-download');
    	$response->headers->set('Content-Type', 'application/pdf');
    	$response->headers->set('Content-Disposition', 'inline; filename="Albaran.pdf"');
    	//$response->headers->set('Content-Disposition: attachment; filename=Albaran.pdf');
    	return $response;
    
    }
    public function facturarAction($id)
    {
    	$em = $this->getDoctrine()->getManager(); $request = $this->getRequest();
    	$albaran = $em->getRepository('PBVentasBundle:Albaran')->find($id);
    	
    	if (!$albaran) {throw $this->createNotFoundException('Unable to find Albaran entity.');}
    	switch ($albaran->getTipo()){
    		case "1":
    			$factura = new Factura();
    		break;
    		case "2":
    			$factura = new FacturaB();
    		break;
    		default:        $factura = new Factura();
    	}
 
        $cliente = $albaran->getCliente();
        $factura->setCliente($albaran->getCliente());
        $factura->setTipo($albaran->getTipo());
        $factura->setDescuento($albaran->getDescuento());
        $factura->setRecargo($albaran->getRecargo());
        $factura->setImportetotal($albaran->getImportetotal());
        $hoy = new \DateTime();
        $factura->setFecha($hoy);
        $factura->setFechacobro($hoy); 
       // $factura->setFormapagoFactura($cliente->getFormapagocliente());
        
        foreach ($albaran->getAlbaranLineas() as $linea)
            {
            	
            	switch ($albaran->getTipo()){
            		case "1":
            			$flinea = new FacturaLinea();
            			$flinea->setFactura($factura);
            			break;
            		case "2":
            			$flinea = new FacturaBLinea();
            			$flinea->setFacturaB($factura);
            			break;
            		default:       $flinea = new FacturaLinea();
            	}
            	$flinea->setReferencia($linea->getReferencia());
            	$flinea->setCodpedido($linea->getCodpedido());
            	$flinea->setDescripcion($linea->getDescripcion());
            	$flinea->setAncho($linea->getAncho());
            	$flinea->setLargo($linea->getLargo());
            	$flinea->setGalga($linea->getGalga());
            	$flinea->setSolapa($linea->getSolapa());
            	$flinea->setCantidad($linea->getCantidad());
            	$flinea->setPrecio($linea->getPrecio());
            	$flinea->setDescuento($linea->getDescuento());
            	$flinea->setImporte($linea->getImporte());
            	$factura->addFacturalinea($flinea);
   
            }
            switch ($albaran->getTipo()){
            	case "1":
					$form   = $this->createForm(new FacturaType(), $factura);
            		break;
            	case "2":
					$form   = $this->createForm(new FacturaBType(), $factura);
            		break;
            	default: $form   = $this->createForm(new FacturaType(), $factura);
            }		
        
    
        if ($request->getMethod() == 'POST') {
        	$form->bind($request);
        	if ($form->isValid()) {
        		  
        	      $em->persist($factura);
        	      $em->flush();
        	      
        	      $albaran->setCodfactura($factura->getId());
        	      $em->persist($albaran);
        	      $em->flush();
        	      
        	      $this->get('session')->getFlashBag()->add('success', 'Nueva Factura Creada');
	              //return $this->redirect($this->generateUrl('factura_show', array('id' => $factura->getId())));
        	      return $this->redirect($this->generateUrl('albaran'));
        	} else {
	            $this->get('session')->getFlashBag()->add('error', 'flash.update.error');
	        } 		
        } 
        
        return $this->render('PBVentasBundle:Albaran:facturar.html.twig', array(
        			'entity' => $factura,
        			'id' => $albaran->getId(), 'tipo' => $albaran->getTipo(),
        			'form'   => $form->createView(),
        	));     
    }
    
    public function setEstadoPedido($id, $estado){
    	if (!$estado) {
    		throw $this->createNotFoundException('Falta el estado de pedido AlbaranController->setEstadoPedido().');
    	}
    	if (!$id) {
    		throw $this->createNotFoundException('Falta código de pedido AlbaranController->setEstadoPedido().');
    	}
    	$em = $this->get('doctrine')->getEntityManager();
    	$entity = $em->getRepository('PBVentasBundle:Pedido')->find($id);
    	$entity->setEstado($estado);
    	$em->persist($entity);
    	$em->flush();
    	 
    }
}
