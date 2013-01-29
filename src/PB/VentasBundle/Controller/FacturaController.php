<?php

namespace PB\VentasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\View\TwitterBootstrapView;

use PB\VentasBundle\Entity\Factura;
use PB\VentasBundle\Form\FacturaType;
use PB\VentasBundle\Form\FacturaFilterType;

/**
 * Factura controller.
 *
 */
class FacturaController extends Controller
{
    /**
     * Lists all Factura entities.
     *
     */
    public function indexAction()
    {
 	$request = $this->getRequest();$session = $request->getSession();
    	
    	list($filterForm, $queryBuilder) = $this->filter();
    	if($this->getRequest()->get('cuantos')) {
    		$cuantos = $this->getRequest()->get('cuantos');
    	} else if ($session->get('FacturaCompraCuantos')){
    		$cuantos = $session->get('FacturaCompraCuantos');
    	} else { $cuantos = 10;
    	}
    	
        list($entities, $pagerHtml) = $this->paginator($queryBuilder, $cuantos);
        
        $cuantosarr = array('10' => '10','25' => '25','50' => '50','100' => '100');  
        if($cuantos) $session->set('FacturaCompraCuantos', $cuantos);
        ($cuantos)? $entradas = $cuantos : $entradas = 10;
        
        return $this->render('PBVentasBundle:Factura:index.html.twig', array(
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
        $filterForm = $this->createForm(new FacturaFilterType());
        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('PBVentasBundle:Factura')->createQueryBuilder('e')->orderBy('e.id', 'DESC');
    
        // Reset filter
        if ($request->getMethod() == 'POST' && $request->get('filter_action') == 'reset') {
            $session->remove('FacturaControllerFilter');
        }
    
        // Filter action
        if ($request->getMethod() == 'POST' && $request->get('filter_action') == 'filter') {
            // Bind values from the request
            $filterForm->bind($request);

            if ($filterForm->isValid()) {
                // Build the query from the given form object
                $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($filterForm, $queryBuilder);
                // Save filter to session
                $filterData = $filterForm->getData();
                $session->set('FacturaControllerFilter', $filterData);
            }
        } else {
            // Get filter from session
            if ($session->has('FacturaControllerFilter')) {
                $filterData = $session->get('FacturaControllerFilter');
                $filterForm = $this->createForm(new FacturaFilterType(), $filterData);
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
        $currentPage = $this->getRequest()->get('page', 1);
       	$pagerfanta->setMaxPerPage($cuantos);
        
        $pagerfanta->setCurrentPage($currentPage);
        $entities = $pagerfanta->getCurrentPageResults();
    
        // Paginator - route generator
        $me = $this;
        $routeGenerator = function($page) use ($me)
        {
            return $me->generateUrl('factura', array('page' => $page));
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
     * Finds and displays a Factura entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('PBVentasBundle:Factura')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Factura entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PBVentasBundle:Factura:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }
    
    public function showLightboxAction($id)
    {
    	$em = $this->getDoctrine()->getManager();
    
    	$entity = $em->getRepository('PBVentasBundle:Factura')->find($id);
    	if (!$entity) {
    		throw $this->createNotFoundException('Unable to find Factura entity.');
    	}
    
    	$deleteForm = $this->createDeleteForm($id);
    
    	return $this->render('PBVentasBundle:Factura:show-lightbox.html.twig', array(
    			'entity'      => $entity,
    			'delete_form' => $deleteForm->createView(),        ));
    }
    /**
     * Displays a form to create a new Factura entity.
     *
     */
    public function prenewAction()
    {
        $entity = new Factura();
        $hoy = new \DateTime();
        $entity->setFecha($hoy);
        $entity->setFechacobro($hoy);
        $form   = $this->createForm(new FacturaType(), $entity);

        return $this->render('PBVentasBundle:Factura:new.html.twig', array(
            'entity' => $entity,
        	'formstep' => 1,
            'form'   => $form->createView(),
        ));
    }
    
    /**
     * Displays a form to create a new Factura entity.
     *
     */
    public function newAction()
    {
        $entity  = new Factura();
        $request = $this->getRequest();
	
        $form    = $this->createForm(new FacturaType(), $entity);
        $form->bind($request);
        
        if ($form->isValid()) {
        	$em = $this->getDoctrine()->getManager();
        	//$cliente = $entity->getCliente();
        	//$entity->setFormapagoFactura($cliente->getFormapagoCliente());
        	
        	$em->persist($entity);
	    	return $this->render('PBVentasBundle:Factura:new.html.twig', array(
	    			'entity' => $entity,
	    			'formstep' => 2,
	    			'form'   => $form->createView(),
	    	));
        }
        return $this->render('PBVentasBundle:Factura:new.html.twig', array(
        		'entity' => $entity,
        		'formstep' => 1,
        		'form'   => $form->createView(),
        ));
    }
    /**
     * Creates a new Factura entity.
     *
     */
    public function createAction()
    {
        $entity  = new Factura();
        $request = $this->getRequest();

        $form    = $this->createForm(new FacturaType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $id = $entity->getId();
            foreach ($entity->getFacturalineas() as $linea)
            {
            	$linea->setFactura($entity);
            	// Cambiamos a facturado los pedidos
            	$codpedido = $linea->getCodpedido();
            	if($codpedido) {
            		$this->setEstadoPedido($codpedido,4);
            	}
            }
            $em->persist($entity);
            
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Nueva Factura Creada');

            return $this->redirect($this->generateUrl('factura', array('id' => $entity->getId())));        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.create.error');
        }

        return $this->render('PBVentasBundle:Factura:new.html.twig', array(
            'entity' => $entity, 'formstep' => 2,
            'form'   => $form->createView(),
        ));
    }
    
    public function preeditAction($id)
    {
    	$em = $this->getDoctrine()->getManager();
    	$entity = $em->getRepository('PBVentasBundle:Factura')->find($id);
    	if (!$entity) {
    		throw $this->createNotFoundException('Unable to find Factura entity.');
    	}
    	$editForm = $this->createForm(new FacturaType(), $entity);
    	$deleteForm = $this->createDeleteForm($id);
    
    	return $this->render('PBVentasBundle:Factura:edit.html.twig', array(
    			'entity'      => $entity,'formstep' => 1,
    			'form'   => $editForm->createView(),
    			'delete_form' => $deleteForm->createView(),
    	));
    }
    /**
     * Displays a form to edit an existing Factura entity.
     *
     */
    public function editAction($id)
    {
 		$em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $entity = $em->getRepository('PBVentasBundle:Factura')->find($id);

        if (!$entity) {   throw $this->createNotFoundException('Unable to find Factura entity.'); }

        $form   = $this->createForm(new FacturaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);
        $form->bind($request);
        
        if ($form->isValid()) {
        	$em->persist($entity);
        	return $this->render('PBVentasBundle:Factura:edit.html.twig', array(
        			'entity'      => $entity, 'formstep' => 2,
        			'form'   => $form->createView(),
        			'delete_form' => $deleteForm->createView(),
        	));
        }
        
        return $this->render('PBVentasBundle:Factura:edit.html.twig', array(
        			'entity'      => $entity, 'formstep' => 1,
        			'form'   => $form->createView(),
        			'delete_form' => $deleteForm->createView(),
        	));
    }

    /**
     * Edits an existing Factura entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PBVentasBundle:Factura')->find($id);

        if (!$entity) {  throw $this->createNotFoundException('Unable to find Factura entity.');}
        
        $beforeSaveLineas = $currentLineasIds = array();
        foreach ($entity->getFacturalineas() as $linea)
        	$beforeSaveLineas [$linea->getId()] = $linea;
        
        $editForm   = $this->createForm(new FacturaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);
        $request = $this->getRequest();
        $editForm->bind($request);

        if ($editForm->isValid()) {
        	foreach ($entity->getFacturalineas() as $linea){
        		$linea->setFactura($entity);
        		if ($linea->getId()) $currentLineasIds[] = $linea->getId();
        	}
            $em->persist($entity);
            foreach ($beforeSaveLineas as $lineaId => $linea){
            	if (!in_array( $lineaId, $currentLineasIds)){
            		$em->remove($linea);
            	}
            }
            foreach ($entity->getFacturalineas() as $linea)
            {
            	$codpedido = $linea->getCodpedido();
            	if($codpedido) {
            		//Pone los estados de pedido a facturado
            		$this->setEstadoPedido($codpedido,4);
            	}
            }
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Factura: '.$id.' Actualizada');

            return $this->redirect($this->generateUrl('factura_show', array('id' => $id)));
        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.update.error');
        }

        return $this->render('PBVentasBundle:Factura:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Factura entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PBVentasBundle:Factura')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Factura entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.delete.success');
        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.delete.error');
        }

        return $this->redirect($this->generateUrl('factura'));
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
    	$printer = $this->container->get('ventas.print_factura');
    	$fichero = $printer->printFPDF($id);
    	$response = new Response();
    	$response->clearHttpHeaders();
    	$response->setContent(file_get_contents($fichier));
    	//$response->headers->set('Content-Type', 'application/force-download');
    	$response->headers->set('Content-Type', 'application/pdf');
    	$response->headers->set('Content-Disposition', 'inline; filename="Albaran.pdf"');
    	return $response;
    
    }
    public function setEstadoPedido($id, $estado){
    	if (!$estado) {
    		throw $this->createNotFoundException('Falta el estado de pedido FacturaController->setEstadoPedido().');
    	}
    	if (!$id) {
    		throw $this->createNotFoundException('Falta código de pedido FacturaController->setEstadoPedido().');
    	}
    	$em = $this->get('doctrine')->getEntityManager();
    	$entity = $em->getRepository('PBVentasBundle:Pedido')->find($id);
    	$entity->setEstado($estado);
    	$em->persist($entity);
    	$em->flush();
    
    }
    public function mailAction($id){
    
    	$em = $this->getDoctrine()->getManager();$request = $this->getRequest();
    	$entity = $em->getRepository('PBVentasBundle:Factura')->find($id);
    	if (!$entity) {	throw $this->createNotFoundException('Unable to find Factura entity.');}
    
    	$defaultData = array( 'email' => $entity->getCliente()->getEmail() , 'subject' => 'Factura PB', 'message' => '');
    	$form = $this->createFormBuilder($defaultData)
    	->add('email', 'email')
    	->add('subject', 'text')
    	->add('body', 'textarea')
    	->getForm();
    
    	$printer = $this->container->get('ventas.print_factura');
    	$fichero = $printer->getPdf($id);
    	//$pdf = base64_encode(file_get_contents($fichero));
    	$attachment = \Swift_Attachment::newInstance($fichero, 'Factura.pdf', 'application/pdf');
    
    	if($request->getMethod() == 'POST') {
    		$form->bindRequest($request);
    		$data = $form->getData();
    		$message = \Swift_Message::newInstance()
    		->setSubject($data['subject'])
    		->setFrom(array('plasticosbaltasar@gmail.com' => 'Plásticos Baltasar'))
    		->setTo($data['email'])
    		->setBody($data['body'])
    		->attach($attachment)
    		;
    		 
    		$this->get('mailer')->send($message);
    		$this->get('session')->getFlashBag()->add('success', 'Factura enviado a: '. $data['email'].'');
    		return $this->redirect($this->generateUrl('factura'));
    	}
    
    	return $this->render('PBVentasBundle:Factura:mail.html.twig', array(
    			'entity'      => $entity,	'form'   => $form->createView(),
    	));
    }
    
}
