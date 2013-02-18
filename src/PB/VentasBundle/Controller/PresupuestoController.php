<?php

namespace PB\VentasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\View\TwitterBootstrapView;

use PB\VentasBundle\Entity\Presupuesto;
use PB\VentasBundle\Form\PresupuestoType;
use PB\VentasBundle\Form\PresupuestoFilterType;
use PB\VentasBundle\Printer\PrintPresupuesto;
use Symfony\Component\HttpFoundation\Response;


class PresupuestoController extends Controller
{
    /**
     * Lists all Presupuesto entities.
     *
     */
    public function indexAction()
    {
    	$request = $this->getRequest();$session = $request->getSession();
    	
    	list($filterForm, $queryBuilder) = $this->filter();
    	if($this->getRequest()->get('cuantos')) {
    		$cuantos = $this->getRequest()->get('cuantos');
    	} else if ($session->get('PresupuestoCuantos')){
    		$cuantos = $session->get('PresupuestoCuantos');
    	} else { $cuantos = 10;
    	}
    	
        list($entities, $pagerHtml) = $this->paginator($queryBuilder, $cuantos);
        
        $cuantosarr = array('10' => '10','25' => '25','50' => '50','100' => '100');
        if($cuantos) $session->set('PresupuestoCuantos', $cuantos);
        ($cuantos)? $entradas = $cuantos : $entradas = 10;
        
        return $this->render('PBVentasBundle:Presupuesto:index.html.twig', array(
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
        $filterForm = $this->createForm(new PresupuestoFilterType());
        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('PBVentasBundle:Presupuesto')->createQueryBuilder('e')->orderBy('e.id', 'DESC');
    
        // Reset filter
        if ($request->getMethod() == 'POST' && $request->get('filter_action') == 'reset') {
            $session->remove('PresupuestoControllerFilter');
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
                $session->set('PresupuestoControllerFilter', $filterData);
            }
        } else {
            // Get filter from session
            if ($session->has('PresupuestoControllerFilter')) {
                $filterData = $session->get('PresupuestoControllerFilter');
                $filterForm = $this->createForm(new PresupuestoFilterType(), $filterData);
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
            return $me->generateUrl('presupuesto', array('page' => $page));
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
     * Finds and displays a Presupuesto entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PBVentasBundle:Presupuesto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Presupuesto entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PBVentasBundle:Presupuesto:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    public function prenewAction()
    {
    	$entity = new Presupuesto();
    	$hoy = new \DateTime();
    	$entity->setFecha($hoy);
    	$form   = $this->createForm(new PresupuestoType(), $entity);
    
    	return $this->render('PBVentasBundle:Presupuesto:new.html.twig', array(
    			'entity' => $entity,
    			'formstep' => 1,
    			'form'   => $form->createView(),
    	));
    }
    public function newAction()
    {
        $entity  = new Presupuesto();
        $request = $this->getRequest();
        $form    = $this->createForm(new PresupuestoType(), $entity);
        $form->bind($request);
        
        if ($form->isValid()) {
        	$em = $this->getDoctrine()->getManager();
        	$em->persist($entity);
	    	return $this->render('PBVentasBundle:Presupuesto:new.html.twig', array(
	    			'entity' => $entity,
	    			'formstep' => 2,
	    			'form'   => $form->createView(),
	    	));
        }
        return $this->render('PBVentasBundle:Presupuesto:new.html.twig', array(
        		'entity' => $entity,
        		'formstep' => 1,
        		'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Presupuesto entity.
     *
     */
    public function createAction()
    {
        $entity  = new Presupuesto();
        $request = $this->getRequest();
        $form    = $this->createForm(new PresupuestoType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            foreach ($entity->getPresupuestolineas() as $linea)
            {
            	$linea->setPresupuesto($entity);
            }
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Nuevo Presupuesto Creado');

            return $this->redirect($this->generateUrl('presupuesto_show', array('id' => $entity->getId())));        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.create.error');
        }

        return $this->render('PBVentasBundle:Presupuesto:new.html.twig', array(
            'entity' => $entity, 'formstep' => 2,
            'form'   => $form->createView(),
        ));
    }
    public function preeditAction($id)
    {
    	$em = $this->getDoctrine()->getManager();
    	$entity = $em->getRepository('PBVentasBundle:Presupuesto')->find($id);
    	if (!$entity) {	throw $this->createNotFoundException('Unable to find Presupuesto entity.');}
    	$editForm = $this->createForm(new PresupuestoType(), $entity);
    	$deleteForm = $this->createDeleteForm($id);
    
    	return $this->render('PBVentasBundle:Presupuesto:edit.html.twig', array(
    			'entity'      => $entity,'formstep' => 1,
    			'form'   => $editForm->createView(),
    			'delete_form' => $deleteForm->createView(),
    	));
    }
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $entity = $em->getRepository('PBVentasBundle:Presupuesto')->find($id);

        if (!$entity) {   throw $this->createNotFoundException('Unable to find Presupuesto entity.'); }

        $form   = $this->createForm(new PresupuestoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);
        $form->bind($request);
        
        if ($form->isValid()) {
        	$em->persist($entity);
        	return $this->render('PBVentasBundle:Presupuesto:edit.html.twig', array(
        			'entity'      => $entity, 'formstep' => 2,
        			'form'   => $form->createView(),
        			'delete_form' => $deleteForm->createView(),
        	));
        }
        return $this->render('PBVentasBundle:Presupuesto:edit.html.twig', array(
        			'entity'      => $entity, 'formstep' => 1,
        			'form'   => $form->createView(),
        			'delete_form' => $deleteForm->createView(),
        	));
    }

    /**
     * Edits an existing Presupuesto entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PBVentasBundle:Presupuesto')->find($id);
        if (!$entity) {  throw $this->createNotFoundException('Unable to find Presupuesto entity.'); }
        
        $beforeSaveLineas = $currentLineasIds = array();
        foreach ($entity->getPresupuestolineas() as $linea)
        	$beforeSaveLineas [$linea->getId()] = $linea;
        
        $editForm   = $this->createForm(new PresupuestoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bind($request);

        if ($editForm->isValid()) {
        	foreach ($entity->getPresupuestolineas() as $linea){
        		$linea->setPresupuesto($entity);
        		if ($linea->getId()) $currentLineasIds[] = $linea->getId();
        	}
            $em->persist($entity);
            foreach ($beforeSaveLineas as $lineaId => $linea){
            	if (!in_array( $lineaId, $currentLineasIds)){
            		$em->remove($linea);
            	}
            }
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Presupuesto: '.$id.' Actualizado');

            return $this->redirect($this->generateUrl('presupuesto'));
        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.update.error');
        }

        return $this->render('PBVentasBundle:Presupuesto:edit.html.twig', array(
            'entity'      => $entity,  'formstep' => 2,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Presupuesto entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PBVentasBundle:Presupuesto')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Presupuesto entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.delete.success');
        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.delete.error');
        }

        return $this->redirect($this->generateUrl('presupuesto'));
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
    
    	$html = $this->getHtmlpdf($id);
    	$printer = new PrintPresupuesto(); //HTML2PDF
    	$response = new Response($printer->getPdf($html));
    	
    	$response->headers->set('Content-Type', 'application/pdf');
    	$response->headers->set('Content-Disposition', 'inline; filename="Presupuesto.pdf"');
    	return $response;
    }
    public function mailAction($id){
    	 
    	$em = $this->getDoctrine()->getManager();$request = $this->getRequest();
    	$entity = $em->getRepository('PBVentasBundle:Presupuesto')->find($id);
    	if (!$entity) {	throw $this->createNotFoundException('Unable to find Presupuesto entity.');}
    	 
    	$defaultData = array( 'email' => $entity->getCliente()->getEmail() , 'subject' => 'Presupuesto', 'message' => '');
    	$form = $this->createFormBuilder($defaultData)
    	->add('email', 'email')
    	->add('subject', 'text')
    	->add('body', 'textarea')
    	->getForm();
    	 
    	$html = $this->getHtmlpdf($id);
    	$printer = new PrintPresupuesto(); //HTML2PDF
    	$pdf = $printer->getPdf($html);
    	$attachment = \Swift_Attachment::newInstance($pdf, 'Presupuesto.pdf', 'application/pdf');
    	 
    	if($request->getMethod() == 'POST') {
    		$form->bindRequest($request);
    		$data = $form->getData();
    		$message = \Swift_Message::newInstance()
    		->setSubject($data['subject'])
    		->setFrom(array('plasticosbaltasar@gmail.com' => 'Plásticos Baltasar'))
    		->setTo($data['email'])
    		->setBody($data['body'])
    		->attach($attachment)	;
    		 
    		$this->get('mailer')->send($message);
    		$this->get('session')->getFlashBag()->add('success', 'Presupuesto enviado a: '. $data['email'].'');
    		return $this->redirect($this->generateUrl('presupuesto'));
    	}
    	 
    	return $this->render('PBVentasBundle:Presupuesto:mail.html.twig', array(
    			'entity'      => $entity,	'form'   => $form->createView(),
    	));
    }
    
    private function getHtmlpdf($id) {
    	$em = $this->getDoctrine()->getManager();
    	$entity = $em->getRepository('PBVentasBundle:Presupuesto')->find($id);
    	if (!$entity) {	throw $this->createNotFoundException('Unable to find Presupuesto entity.'); }
    	
    	$request = $this->getRequest();
    	$url = $this->container->getParameter('url');
    	$limit = 25;
    	$lineas = $entity->getPresupuestolineas(); $numl = count($lineas);
    	if ( $limit > $numl ) $lin = $limit-$numl; else $lin = $limit;
    	$html = $this->renderView('PBVentasBundle:Presupuesto:print.html.twig', array('entity' => $entity, 'url'  => $url, 'limit' => $lin));
    	
    	return $html;
    }
    
}
