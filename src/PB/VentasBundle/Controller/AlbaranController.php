<?php

namespace PB\VentasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\View\TwitterBootstrapView;

use PB\VentasBundle\Entity\Albaran;
use PB\VentasBundle\Form\AlbaranType;
use PB\VentasBundle\Form\AlbaranFilterType;

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
        list($filterForm, $queryBuilder) = $this->filter();

        list($entities, $pagerHtml) = $this->paginator($queryBuilder);

    
        return $this->render('PBVentasBundle:Albaran:index.html.twig', array(
            'entities' => $entities,
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
    
        // Reset filter
        if ($request->getMethod() == 'POST' && $request->get('filter_action') == 'reset') {
            $session->remove('AlbaranControllerFilter');
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
                $session->set('AlbaranControllerFilter', $filterData);
            }
        } else {
            // Get filter from session
            if ($session->has('AlbaranControllerFilter')) {
                $filterData = $session->get('AlbaranControllerFilter');
                $filterForm = $this->createForm(new AlbaranFilterType(), $filterData);
                $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($filterForm, $queryBuilder);
            }
        }
    
        return array($filterForm, $queryBuilder);
    }

    /**
    * Get results from paginator and get paginator view.
    *
    */
    protected function paginator($queryBuilder)
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
            foreach ($entity->getAlbaranLineas() as $linea)
            {
            	$linea->setAlbaran($entity);
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
}
