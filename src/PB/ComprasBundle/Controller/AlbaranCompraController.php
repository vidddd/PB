<?php

namespace PB\ComprasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\View\TwitterBootstrapView;
use PB\ComprasBundle\Entity\AlbaranCompra;
use PB\ComprasBundle\Form\AlbaranCompraType;
use PB\ComprasBundle\Form\AlbaranCompraFilterType;
use PB\AlmacenBundle\Entity\Almacen;
use PB\AlmacenBundle\Form\AlmacenType;

/**
 * AlbaranCompra controller.
 *
 */
class AlbaranCompraController extends Controller
{
    /**
     * Lists all AlbaranCompra entities.
     *
     */
    public function indexAction()
    {
    	$request = $this->getRequest();$session = $request->getSession();
    	
    	if($this->getRequest()->get('cuantos')) {
    		$cuantos = $this->getRequest()->get('cuantos');
    	} else if ($session->get('AlbaranCompraCuantos')){
    		$cuantos = $session->get('AlbaranCompraCuantos');
    	} else { $cuantos = 10; }
    	 
    	list($filterForm, $queryBuilder) = $this->filter();
        list($entities, $pagerHtml) = $this->paginator($queryBuilder, $cuantos);
        
        $cuantosarr = array('10' => '10','25' => '25','50' => '50','100' => '100');  
        if($cuantos) $session->set('AlbaranCompraCuantos', $cuantos);
        ($cuantos)? $entradas = $cuantos : $entradas = 10;

        return $this->render('PBComprasBundle:AlbaranCompra:index.html.twig', array(
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
        $filterForm = $this->createForm(new AlbaranCompraFilterType());
        $em = $this->getDoctrine()->getManager();
        //INNER JOIN CON PROVEEDORES PARA FILTRAR POR EL TIPO 
        $queryBuilder = $em->getRepository('PBComprasBundle:AlbaranCompra')
        					->createQueryBuilder('e')
        					->innerJoin('e.proveedor', 'p')->orderBy('e.id', 'DESC')
        					->select('DISTINCT e, p')
        					;

        if ($request->getMethod() == 'POST' && $request->get('filter_action') == 'reset') {
            $session->remove('AlbaranCompraControllerFilter');
        }
    
        if ($request->getMethod() == 'POST' && $request->get('filter_action') == 'filter') {
            // Bind values from the request
            $filterForm->bind($request);

            if ($filterForm->isValid()) {
                $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($filterForm, $queryBuilder);
                $filterData = $filterForm->getData();
                $session->set('AlbaranCompraControllerFilter', $filterData);
            }
        } else {
            if ($session->has('AlbaranCompraControllerFilter')) {
                $filterData = $session->get('AlbaranCompraControllerFilter');
                $filterForm = $this->createForm(new AlbaranCompraFilterType(), $filterData);
                $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($filterForm, $queryBuilder);
            }
        }
        // var_dump($queryBuilder->getDql());
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
        $pagerfanta->setCurrentPage($currentPage);
        $pagerfanta->setMaxPerPage($cuantos);
        $entities = $pagerfanta->getCurrentPageResults();
    
        // Paginator - route generator
        $me = $this;
        $routeGenerator = function($page) use ($me)
        {
            return $me->generateUrl('albarancompra', array('page' => $page));
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
     * Finds and displays a AlbaranCompra entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('PBComprasBundle:AlbaranCompra')->find($id);
        if (!$entity) {  throw $this->createNotFoundException('Unable to find AlbaranCompra entity.'); }
        $deleteForm = $this->createDeleteForm($id);
        return $this->render('PBComprasBundle:AlbaranCompra:show.html.twig', array(
            'entity'      => $entity,    'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new AlbaranCompra entity.
     *
     */
    public function newAction()
    {
        $entity = new AlbaranCompra();
        $form   = $this->createForm(new AlbaranCompraType(), $entity);
        return $this->render('PBComprasBundle:AlbaranCompra:new.html.twig', array(
            'entity' => $entity,  'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new AlbaranCompra entity.
     *
     */
    public function createAction()
    {
        $entity  = new AlbaranCompra();
        $request = $this->getRequest();
        $form    = $this->createForm(new AlbaranCompraType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.create.success');

            return $this->redirect($this->generateUrl('albarancompra_show', array('id' => $entity->getId())));        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.create.error');
        }

        return $this->render('PBComprasBundle:AlbaranCompra:new.html.twig', array(
            'entity' => $entity,  'form'   => $form->createView(),
        ));
    }
    
    /**
     * Displays a form to edit an existing AlbaranCompra entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('PBComprasBundle:AlbaranCompra')->find($id);
        if (!$entity) {  throw $this->createNotFoundException('Unable to find AlbaranCompra entity.'); }
        $editForm = $this->createForm(new AlbaranCompraType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PBComprasBundle:AlbaranCompra:edit.html.twig', array(
            'entity'      => $entity,   'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing AlbaranCompra entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('PBComprasBundle:AlbaranCompra')->find($id);
        if (!$entity) {  throw $this->createNotFoundException('Unable to find AlbaranCompra entity.'); }
        $beforeSaveLineas = $currentLineasIds = array();
        foreach ($entity->getAlbarancompralineas() as $linea)
        	$beforeSaveLineas [$linea->getId()] = $linea;
        

        $editForm   = $this->createForm(new AlbaranCompraType(), $entity);
        $deleteForm = $this->createDeleteForm($id);
        $request = $this->getRequest();
        $editForm->bind($request);

        if ($editForm->isValid()) {
        	foreach ($entity->getAlbarancompralineas() as $linea){
        		$linea->setAlbarancompralinea($entity);
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

            return $this->redirect($this->generateUrl('albarancompra_edit', array('id' => $id)));
        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.update.error');
        }

        return $this->render('PBComprasBundle:AlbaranCompra:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a AlbaranCompra entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PBComprasBundle:AlbaranCompra')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find AlbaranCompra entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.delete.success');
        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.delete.error');
        }

        return $this->redirect($this->generateUrl('albarancompra'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))            ->add('id', 'hidden')->getForm();
    }
public function recibirAction($id)
    {
    	$em = $this->getDoctrine()->getManager(); $request = $this->getRequest();
    	$albaran = $em->getRepository('PBComprasBundle:AlbaranCompra')->find($id);
    	 
    	if (!$albaran) { throw $this->createNotFoundException('Unable to find Albaran entity.'); }
    	$form   = $this->createForm(new AlbaranCompraType(), $albaran);
    	
    	if ($request->getMethod() == 'POST') {
    		$form->bind($request);
    		if ($form->isValid()) {
    			$em->persist($albaran);	$em->flush();
    		
    			$this->get('session')->getFlashBag()->add('success', 'Albaran Recibido');
    			//return $this->redirect($this->generateUrl('factura_show', array('id' => $factura->getId())));
    			return $this->redirect($this->generateUrl('albarancompra'));
    		} else {
    			$this->get('session')->getFlashBag()->add('error', 'flash.update.error');
    		}
    	}
    	
    	return $this->render('PBComprasBundle:AlbaranCompra:recibir.html.twig', array(
    			'entity' => $albaran,'id' => $albaran->getId(), 'form'   => $form->createView(),
    	));
    }
    public function procesarAction($id)
    {
    	// recibimos el id de la linea albarancompra
    	$em = $this->getDoctrine()->getManager(); $request = $this->getRequest();
    	$linea = $em->getRepository('PBComprasBundle:AlbaranCompraLinea')->find($id);
    	if (!$linea) { throw $this->createNotFoundException('Unable to find Albaran Linea entity.'); }
    	
    	$almacen = new Almacen(); $reload = '';
    	$almacen->setCantidad($linea->getCantidad());
        $almacen->setDescripcion($linea->getDescripcion());
        $almacen->setCantidad($linea->getCantidad());
        $almacen->setReferencia($linea->getReferencia());
        $almacen->setAlbarancompralinea($linea);
    	$form   = $this->createForm(new AlmacenType(), $almacen);
    	
    	if ($request->getMethod() == 'POST' && $form->getName() == 'almacen') {
    		$form->bind($request);
    		if ($form->isValid()) {
    			$em->persist($almacen);	
    			$em->persist($linea);
    			$em->flush();
    			$this->get('session')->getFlashBag()->add('success', 'Guardado en Almacen');// $reload = 'ok';
    		} else {
    			$this->get('session')->getFlashBag()->add('error', 'flash.update.error');
    		}
    	}
    	$query = $em->createQuery('SELECT p FROM PBAlmacenBundle:Almacen p WHERE p.albarancompralinea = :id ORDER BY p.id DESC')->setParameter('id', $id);
    	$almacenes = $query->getResult();
    	return $this->render('PBComprasBundle:AlbaranCompra:procesar.html.twig', array(
    			'entity' => $almacen, 'id' => $id, 'reload' => $reload, 'almacenes' => $almacenes,
    			'form'   => $form->createView(),
    	));
    }
    public function procesarEstadoAction($id)
    {
    	// recibimos el id de la linea albarancompra
    	$em = $this->getDoctrine()->getManager(); $request = $this->getRequest();
    	$linea = $em->getRepository('PBComprasBundle:AlbaranCompraLinea')->find($id);
    	if (!$linea) {
    		throw $this->createNotFoundException('Unable to find Albaran Linea entity.');
    	}
    	
    	$almacen = new Almacen(); $reload = '';
    	$almacen->setCantidad($linea->getCantidad());
    	$almacen->setDescripcion($linea->getDescripcion());
    	$almacen->setCantidad($linea->getCantidad());
    	$almacen->setReferencia($linea->getReferencia());
    	$almacen->setAlbarancompralinea($linea);
    	$form   = $this->createForm(new AlmacenType(), $almacen);
    	if ($request->getMethod() == 'POST') {
			
			$linea->setEstado($this->getRequest()->get('estado')); $em->persist($linea);
    		$em->flush();
    		//$this->get('session')->getFlashBag()->add('success', 'Guardado en Almacen');
    		$reload = 'ok';
    
    	}
    	$query = $em->createQuery('SELECT p FROM PBAlmacenBundle:Almacen p WHERE p.albarancompralinea = :id ORDER BY p.id DESC')->setParameter('id', $id);
    	$almacenes = $query->getResult();
    	return $this->render('PBComprasBundle:AlbaranCompra:procesar.html.twig', array(
    			'entity' => $almacen, 'id' => $id, 'reload' => $reload, 'almacenes' => $almacenes,
    			'form'   => $form->createView(),
    	));
    }
    
 public function eliminarAlmacenAction($id)
    {
    	// recibimos el id de la linea albarancompra
    	$em = $this->getDoctrine()->getManager(); $request = $this->getRequest();
    	$linea = $em->getRepository('PBComprasBundle:AlbaranCompraLinea')->find($id);
    	if (!$linea) { throw $this->createNotFoundException('Unable to find Albaran Linea entity.'); }
    	
    	$almacen = new Almacen(); $reload = '';
    	$almacen->setCantidad($linea->getCantidad());
        $almacen->setDescripcion($linea->getDescripcion());
        $almacen->setCantidad($linea->getCantidad());
        $almacen->setReferencia($linea->getReferencia());
        $almacen->setAlbarancompralinea($linea);
    	$form   = $this->createForm(new AlmacenType(), $almacen);
				
		$entity = $em->getRepository('PBAlmacenBundle:Almacen')->find($this->getRequest()->get('aid'));
		if (!$entity) {
			throw $this->createNotFoundException('Unable to find Albaran Entity.');
		}
			$em->remove($entity);
			$em->flush();
		
    	$query = $em->createQuery('SELECT p FROM PBAlmacenBundle:Almacen p WHERE p.albarancompralinea = :id ORDER BY p.id DESC')->setParameter('id', $id);
    	$almacenes = $query->getResult();
    	return $this->render('PBComprasBundle:AlbaranCompra:procesar.html.twig', array(
    			'entity' => $almacen, 'id' => $id, 'reload' => $reload, 'almacenes' => $almacenes,
    			'form'   => $form->createView(),
    	));
    }
}
