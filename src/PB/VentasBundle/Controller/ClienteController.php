<?php

namespace PB\VentasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\View\TwitterBootstrapView;

use PB\VentasBundle\Entity\Cliente;
use PB\VentasBundle\Form\ClienteType;
use PB\VentasBundle\Form\ClienteFilterType;
use PB\VentasBundle\Form\ClienteBuscadorFilterType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Cliente controller.
 *
 */
class ClienteController extends Controller
{
    /**
     * Lists all Cliente entities.
     *
     */
    public function indexAction()
    {
    	$request = $this->getRequest();$session = $request->getSession();
    	
    	list($filterForm, $queryBuilder) = $this->filter();
    	if($this->getRequest()->get('cuantos')) {
    		$cuantos = $this->getRequest()->get('cuantos');
    	} else if ($session->get('ClienteCuantos')){
    		$cuantos = $session->get('ClienteCuantos');
    	} else { $cuantos = 10;
    	}
    	
        list($entities, $pagerHtml) = $this->paginator($queryBuilder, $cuantos);
        
        $cuantosarr = array('10' => '10','25' => '25','50' => '50','100' => '100');  
        if($cuantos) $session->set('ClienteCuantos', $cuantos);
        ($cuantos)? $entradas = $cuantos : $entradas = 10;
        
        return $this->render('PBVentasBundle:Cliente:index.html.twig', array(
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
        $filterForm = $this->createForm(new ClienteFilterType());
        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('PBVentasBundle:Cliente')->createQueryBuilder('e')->orderBy('e.id', 'DESC');
    
        // Reset filter
        if ($request->getMethod() == 'POST' && $request->get('filter_action') == 'reset') {
            $session->remove('ClienteControllerFilter');
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
                $session->set('ClienteControllerFilter', $filterData);
            }
        } else {
            // Get filter from session
            if ($session->has('ClienteControllerFilter')) {
                $filterData = $session->get('ClienteControllerFilter');
                $filterForm = $this->createForm(new ClienteFilterType(), $filterData);
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
            return $me->generateUrl('cliente', array('page' => $page));
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
    
    public function buscadorClienteAction()
    {
    	list($filterForm, $queryBuilder) = $this->filterBuscador();
    
    	list($entities, $pagerHtml) = $this->paginatorBuscador($queryBuilder);
    
    
    	return $this->render('PBVentasBundle:Cliente:buscador.html.twig', array(
    			'entities' => $entities,
    			'pagerHtml' => $pagerHtml,
    			'filterForm' => $filterForm->createView(),
    	));
    }
    /**
     * Create filter form and process filter request.
     *
     */
    
    protected function filterBuscador()
    {
    	$request = $this->getRequest();
    	$session = $request->getSession();
    	$filterForm = $this->createForm(new ClienteBuscadorFilterType());
    	$em = $this->getDoctrine()->getManager();
    	$queryBuilder = $em->getRepository('PBVentasBundle:Cliente')->createQueryBuilder('e')->orderBy('e.id', 'DESC');
    
    	// Reset filter
    	if ($request->getMethod() == 'POST' && $request->get('filter_action') == 'reset') {
    		$session->remove('ClienteControllerFilterBuscador');
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
    
    			$session->set('ClienteControllerFilter', $filterData);
    		}
    	} else {
    		// Get filter from session
    		if ($session->has('ClienteControllerFilterBuscador')) {
    			$filterData = $session->get('ClienteControllerFilterBuscador');
    			$filterForm = $this->createForm(new ClienteBuscadorFilterType(), $filterData);
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
    protected function paginatorBuscador($queryBuilder)
    {
    	// Paginator
    	$adapter = new DoctrineORMAdapter($queryBuilder);
    	$pagerfanta = new Pagerfanta($adapter);
    	$currentPage = $this->getRequest()->get('page', 1);
    	$pagerfanta->setCurrentPage($currentPage);
    	$entities = $pagerfanta->getCurrentPageResults();
    
    	// Paginator - route generator
    	$me = $this;
    	$routeGenerator = function($page) use ($me)
    	{
    		return $me->generateUrl('buscador_cliente', array('page' => $page));
    	};
    
    	// Paginator - view
    	$translator = $this->get('translator');
    	$view = new TwitterBootstrapView();
    	$pagerHtml = $view->render($pagerfanta, $routeGenerator, array(
    			'proximity' => 10,
    			'prev_message' => $translator->trans('views.index.pagprev', array(), 'JordiLlonchCrudGeneratorBundle'),
    			'next_message' => $translator->trans('views.index.pagnext', array(), 'JordiLlonchCrudGeneratorBundle'),
    	));
    
    	return array($entities, $pagerHtml);
    }
    /**
     * Finds and displays a Cliente entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PBVentasBundle:Cliente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cliente entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PBVentasBundle:Cliente:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Cliente entity.
     *
     */
    public function newAction()
    {
        $entity = new Cliente();
        $form   = $this->createForm(new ClienteType(), $entity);

        return $this->render('PBVentasBundle:Cliente:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Cliente entity.
     *
     */
    public function createAction()
    {
        $entity  = new Cliente();
        $request = $this->getRequest();
        $form    = $this->createForm(new ClienteType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.create.success');

            return $this->redirect($this->generateUrl('cliente', array('id' => $entity->getId())));        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.create.error');
        }

        return $this->render('PBVentasBundle:Cliente:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    /**
     * Displays a form to edit an existing Cliente entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PBVentasBundle:Cliente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cliente entity.');
        }

        $editForm = $this->createForm(new ClienteType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PBVentasBundle:Cliente:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Cliente entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PBVentasBundle:Cliente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cliente entity.');
        }

        $editForm   = $this->createForm(new ClienteType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.update.success');

            return $this->redirect($this->generateUrl('cliente', array('id' => $id)));
        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.update.error');
        }

        return $this->render('PBVentasBundle:Cliente:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Cliente entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PBVentasBundle:Cliente')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Cliente entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.delete.success');
        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.delete.error');
        }

        return $this->redirect($this->generateUrl('cliente'));
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
    public function getNombreAction(){
    	$request = $this->get('request');
    	$id=$request->request->get('id');
    	$em = $this->get('doctrine')->getEntityManager();
    	
    	$cliente = $em->getRepository('PBVentasBundle:Cliente')->findOneById($id);
    	//echo $id;
    	if($cliente) {if($cliente->getComercialCliente())
	    		$comercial = $cliente->getComercialCliente()->getNombre();
	        else $comercial ='';
    	}
    	$fp = $cliente->getFormapagoCliente()->getId();
    	$dias = $cliente->getFormapagoCliente()->getDias();
        if($cliente && is_numeric($id) && $id != '') {
    		return new Response(json_encode(array('nombre' => $cliente->getNombre(), 'comercial' => $comercial, 'descuento' => $cliente->getDescuento(), 'recargo' => $cliente->getRecargo(), 'fp' => $fp, 'dias' => $dias)));
        } else {
        	return new Response(json_encode(array('nombre' => '<span class="error-nombre">Código de cliente erróneo</span>')));
        }
    }
    public function csvAction(){
    	$request = $this->getRequest();$session = $request->getSession();
    	$em = $this->get('doctrine')->getEntityManager();
    	$query = $em->getRepository('PBVentasBundle:Cliente')->createQueryBuilder('e')->orderBy('e.id', 'DESC');
    	 
    	if ($session->get('ClienteCuantos')){
    		$cuantos = $session->get('ClienteCuantos');
    	} else { $cuantos = 10;
    	}
    	$query->setMaxResults($cuantos);
    	 
    	if ($session->has('ClienteControllerFilter')) {
    		$filterData = $session->get('ClienteControllerFilter');
    
    		$filterForm = $this->createForm(new ClienteBuscadorFilterType(), $filterData);
    		//print_r($filterData);
    		$this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($filterForm, $query);
    		//print_r($query->getDql()); die;
    		//print_r($filterData);
    	}
    	 
    	$data = $query->getQuery()->getResult();
    	$filename = "Clientes.csv";
    	 
    	$response = $this->render('PBComprasBundle:Proveedor:csv.html.twig', array('data' => $data));
    	$response->headers->set('Content-Type', 'text/csv');
    	$response->headers->set('Content-Disposition', 'attachment; filename='.$filename);
    	return $response;
    }
}
