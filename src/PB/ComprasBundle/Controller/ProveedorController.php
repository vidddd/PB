<?php

namespace PB\ComprasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\View\TwitterBootstrapView;

use PB\ComprasBundle\Entity\Proveedor;
use PB\ComprasBundle\Form\ProveedorType;
use PB\ComprasBundle\Form\ProveedorFilterType;
use PB\ComprasBundle\Form\ProveedorBuscadorFilterType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Exception\ParseException;

/**
 * Proveedor controller.
 *
 */
class ProveedorController extends Controller
{
    /**
     * Lists all Proveedor entities.
     *
     */
    public function indexAction()
    {
    	$request = $this->getRequest();$session = $request->getSession();
    	 
    	if($this->getRequest()->get('cuantos')) { $cuantos = $this->getRequest()->get('cuantos');
    	} else if ($session->get('ProveedorCuantos')){
    		$cuantos = $session->get('ProveedorCuantos');
    	} else { $cuantos = 10; }
    	
        list($filterForm, $queryBuilder) = $this->filter();
        list($entities, $pagerHtml) = $this->paginator($queryBuilder, $cuantos);

        $cuantosarr = array('10' => '10','25' => '25','50' => '50','100' => '100');
        if($cuantos) $session->set('ProveedorCuantos', $cuantos);
        ($cuantos)? $entradas = $cuantos : $entradas = 10;
        
        return $this->render('PBComprasBundle:Proveedor:index.html.twig', array(
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
        $filterForm = $this->createForm(new ProveedorFilterType());
        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('PBComprasBundle:Proveedor')->createQueryBuilder('e')->orderBy('e.id', 'DESC');
    
        // Reset filter
        if ($request->getMethod() == 'POST' && $request->get('filter_action') == 'reset') {
            $session->remove('ProveedorControllerFilter');
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
                
                $session->set('ProveedorControllerFilter', $filterData);
            }
        } else {
            // Get filter from session
            if ($session->has('ProveedorControllerFilter')) {
                $filterData = $session->get('ProveedorControllerFilter');
                $filterForm = $this->createForm(new ProveedorFilterType(), $filterData);
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
            return $me->generateUrl('proveedor', array('page' => $page));
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
    
    public function buscadorProveedorAction()
    {
    	list($filterForm, $queryBuilder) = $this->filterBuscador();
    
    	list($entities, $pagerHtml) = $this->paginatorBuscador($queryBuilder);
    
    
    	return $this->render('PBComprasBundle:Proveedor:buscador.html.twig', array(
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
    	$filterForm = $this->createForm(new ProveedorBuscadorFilterType());
    	$em = $this->getDoctrine()->getManager();
    	$queryBuilder = $em->getRepository('PBComprasBundle:Proveedor')->createQueryBuilder('e')->orderBy('e.id', 'DESC');
    
    	// Reset filter
    	if ($request->getMethod() == 'POST' && $request->get('filter_action') == 'reset') {
    		$session->remove('ProveedorControllerFilter');
    	}
    
    	// Filter action
    	if ($request->getMethod() == 'POST' && $request->get('filter_action') == 'filter') {
    		// Bind values from the request
    		$filterForm->bind($request);
    		 
    		if ($filterForm->isValid()) {
    			$this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($filterForm, $queryBuilder);
    			$filterData = $filterForm->getData();
    			$session->set('ProveedorControllerFilter', $filterData);
    		}
    	} else {

    		if ($session->has('ProveedorControllerFilter')) {
    			$filterData = $session->get('ProveedorControllerFilter');
    			$filterForm = $this->createForm(new ProveedorBuscadorFilterType(), $filterData);
    			$this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($filterForm, $queryBuilder);
    		}
    	}
    	//var_dump($queryBuilder->getDql());
    	return array($filterForm, $queryBuilder);
    }
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
    		return $me->generateUrl('buscador_proveedor', array('page' => $page));
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
     * Finds and displays a Proveedor entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $yaml = new Parser();
        try {
        	$value = $yaml->parse(file_get_contents(__DIR__ . '/../Resources/config/compras.yml'));
        } catch (ParseException $e) {
        	printf("Unable to parse the YAML string: %s", $e->getMessage());
        }
         
        $tipos = $value['tipo_proveedor'];$medios = $value['medio_envio'];
        $entity = $em->getRepository('PBComprasBundle:Proveedor')->find($id);
		$entity->setTipoproveedor($tipos[$entity->getTipoproveedor()]);
		$entity->setMedioEnvio($medios[$entity->getMedioenvio()]);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Proveedor entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PBComprasBundle:Proveedor:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Proveedor entity.
     *
     */
    public function newAction()
    {
        $entity = new Proveedor();
        $form   = $this->createForm(new ProveedorType(), $entity);

        return $this->render('PBComprasBundle:Proveedor:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        	'errors' => array()
        ));
    }

    /**
     * Creates a new Proveedor entity.
     *
     */
    public function createAction()
    {
        $entity  = new Proveedor();
        $request = $this->getRequest();
        $form    = $this->createForm(new ProveedorType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->setFlash('success', 'El proveedor se ha guardado!');
            return $this->redirect($this->generateUrl('proveedor'));
        }
        
       $validator = $this->get('validator');
        $errors = $validator->validate($form);
        
        return $this->render('PBComprasBundle:Proveedor:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        	'errors' => $errors
        ));
    }

    /**
     * Displays a form to edit an existing Proveedor entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PBComprasBundle:Proveedor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Proveedor entity.');
        }

        $editForm = $this->createForm(new ProveedorType(), $entity);

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PBComprasBundle:Proveedor:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Proveedor entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PBComprasBundle:Proveedor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Proveedor entity.');
        }

        $editForm   = $this->createForm(new ProveedorType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            $this->get('session')->setFlash('success', 'Los cambios se han guardado!');
            
            return $this->redirect($this->generateUrl('proveedor'));
        }

        return $this->render('PBComprasBundle:Proveedor:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Proveedor entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PBComprasBundle:Proveedor')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Proveedor entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('proveedor'));
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
    	 
    	$cliente = $em->getRepository('PBComprasBundle:Proveedor')->findOneById($id);
    	if($cliente && is_numeric($id)) {
    		return new Response(json_encode(array('nombre' => $cliente->getNombre())));
    	} else {
    		return new Response(json_encode(array('nombre' => '<span class="error-nombre">Código de proveedor erróneo</span>')));
    	}
    }
    
    public function csvAction(){
    	$request = $this->getRequest();$session = $request->getSession();
    	$em = $this->get('doctrine')->getEntityManager();
    	$query = $em->getRepository('PBComprasBundle:Proveedor')->createQueryBuilder('e')->orderBy('e.id', 'DESC');
    	
    	if ($session->has('ProveedorControllerFilter')) {
    		$filterData = $session->get('ProveedorControllerFilter');
    		//print_r($filterData); die;
    		$filterForm = $this->createForm(new ProveedorBuscadorFilterType(), $filterData);
    		$this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($filterForm, $query);
    	}
    	
    	$data = $query->getQuery()->getResult(); 
    	$filename = "Proveedores.csv";
    	
    	$response = $this->render('PBComprasBundle:Proveedor:csv.html.twig', array('data' => $data));
    	$response->headers->set('Content-Type', 'text/csv');	
    	$response->headers->set('Content-Disposition', 'attachment; filename='.$filename);
    	return $response;
    }
}