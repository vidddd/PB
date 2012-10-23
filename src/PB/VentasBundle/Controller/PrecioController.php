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


class PrecioController extends Controller
{
    public function indexAction()
    {
        list($filterForm, $queryBuilder) = $this->filter();
        list($entities, $pagerHtml) = $this->paginator($queryBuilder);
        return $this->render('PBVentasBundle:Precio:index.html.twig', array(
            'entities' => $entities,
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
        //$entity2 = new PrecioLinea();
        //$entity->addPrecioLinea($entity2);
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
}