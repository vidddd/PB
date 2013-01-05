<?php

namespace PB\AlmacenBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\View\TwitterBootstrapView;

use PB\AlmacenBundle\Entity\Producto;
use PB\AlmacenBundle\Form\ProductoType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Exception\ParseException;

/**
 * Proveedor controller.
 *
 */
class ProductoController extends Controller
{

    public function indexAction()
    {
    	$request = $this->getRequest();$session = $request->getSession(); $em = $this->getDoctrine()->getManager(); 
    	$queryBuilder = $em->getRepository('PBAlmacenBundle:Producto')->createQueryBuilder('p')->orderBy('p.id', 'ASC');
    	//var_dump($queryBuilder->getDql());
    	list($entities, $pagerHtml) = $this->paginatorBuscadorFacturas($queryBuilder);
    	return $this->render('PBAlmacenBundle:Producto:index.html.twig', array(
    			'entities' => $entities, 'cuantos' => '', 'entradas' => '',
    			'pagerHtml' => $pagerHtml,
    	));
    }
    
    protected function paginatorBuscadorFacturas($queryBuilder)
    {
    	// Paginator
    	$adapter = new DoctrineORMAdapter($queryBuilder);
    	$pagerfanta = new Pagerfanta($adapter);
    	$currentPage = $this->getRequest()->get('page', 1);
    	$cuantos = $this->getRequest()->get('cuantos');
        $pagerfanta->setMaxPerPage(50);
    	$pagerfanta->setCurrentPage($currentPage);
    
    	$entities = $pagerfanta->getCurrentPageResults();
    	$me = $this;
    	$routeGenerator = function($page) use ($me)
    	{
    		return $me->generateUrl('producto', array('page' => $page));
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
    	$entity = $em->getRepository('PBAlmacenBundle:Producto')->find($id);
    	if (!$entity) {
    		throw $this->createNotFoundException('No se Puede encontrar el producto.');
    	}
    	$deleteForm = $this->createDeleteForm($id);
    	return $this->render('PBAlmacenBundle:Producto:show.html.twig', array( 'entity'      => $entity, 'delete_form' => $deleteForm->createView(),        ));
    }
    
    public function newAction()
    {
    	$entity = new Producto();
    	$form   = $this->createForm(new ProductoType(), $entity);
    
    	return $this->render('PBAlmacenBundle:Producto:new.html.twig', array(
    			'entity' => $entity,
    			'form'   => $form->createView(),
    	));
    }
    
    public function createAction()
    {
    	$entity  = new Producto();
    	$request = $this->getRequest();
    	$form    = $this->createForm(new ProductoType(), $entity);
    	$form->bind($request);
    	if ($form->isValid()) {
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($entity);
    		$em->flush();
    		$this->get('session')->getFlashBag()->add('success', 'Nuevo Producto Creado');
    
    		return $this->redirect($this->generateUrl('producto'));
    	} else {
    		$this->get('session')->getFlashBag()->add('error', 'flash.create.error');
    	}
    
    	return $this->render('PBAlmacenBundle:Producto:new.html.twig', array('entity' => $entity,'form'   => $form->createView(),));
    }
    
    public function editAction($id)
    {
    	$em = $this->getDoctrine()->getManager();
    	$entity = $em->getRepository('PBAlmacenBundle:Producto')->find($id);
    	if (!$entity) {   throw $this->createNotFoundException('No se encuentra el Producto.'); }
    	$editForm = $this->createForm(new ProductoType(), $entity);
    	$deleteForm = $this->createDeleteForm($id);
    	return $this->render('PBAlmacenBundle:Producto:edit.html.twig', array('entity' => $entity, 'form'   => $editForm->createView(), 'delete_form' => $deleteForm->createView(), ));
    }
    
    public function updateAction($id)
    {
    	$em = $this->getDoctrine()->getManager();
    
    	$entity = $em->getRepository('PBAlmacenBundle:Producto')->find($id);
    	if (!$entity) {	throw $this->createNotFoundException('No se encuentra el Producto.'); }
    
    	$editForm   = $this->createForm(new ProductoType(), $entity);
    	$deleteForm = $this->createDeleteForm($id);
    	$request = $this->getRequest();
    	$editForm->bind($request);
    
    	if ($editForm->isValid()) {
    		$em->persist($entity);
    		$em->flush();
    		$this->get('session')->getFlashBag()->add('success', 'flash.update.success');
    		return $this->redirect($this->generateUrl('producto'));
    	} else { $this->get('session')->getFlashBag()->add('error', 'flash.update.error');	}
    
    	return $this->render('PBAlamacenBundle:Producto:edit.html.twig', array('entity' => $entity,'form'   => $editForm->createView(),'delete_form' => $deleteForm->createView(),));
    }
    
    public function deleteAction($id)
    {
    	$form = $this->createDeleteForm($id);
    	$request = $this->getRequest();
    	$form->bind($request);
    	if ($form->isValid()) {
    		$em = $this->getDoctrine()->getManager();
    		$entity = $em->getRepository('PBAlmacenBundle:Producto')->find($id);
    		if (!$entity) {
    			throw $this->createNotFoundException('Unable to find Producto entity.');
    		}
    		$em->remove($entity);
    		$em->flush();
    		$this->get('session')->getFlashBag()->add('success', 'flash.delete.success');
    	} else {$this->get('session')->getFlashBag()->add('error', 'flash.delete.error');
    	}
    
    	return $this->redirect($this->generateUrl('producto'));
    }
    
    private function createDeleteForm($id)
    {
    	return $this->createFormBuilder(array('id' => $id))->add('id', 'hidden')->getForm();
    }
}