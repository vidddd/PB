<?php

namespace PB\ComprasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\View\TwitterBootstrapView;

use PB\ComprasBundle\Entity\PedidoCompra;
use PB\ComprasBundle\Entity\PedidoCompraLinea;
use PB\ComprasBundle\Form\PedidoCompraType;
use PB\ComprasBundle\Form\PedidoCompraFilterType;
use PB\ComprasBundle\Form\PedidoCompraLineaType;

use PB\ComprasBundle\Form\Factory\PedidoCompraFactory;
use PB\ComprasBundle\Form\PedidoCompraFormType;

/**
 * PedidoCompra controller.
 *
 */
class PedidoCompraController extends Controller
{
    /**
     * Lists all PedidoCompra entities.
     *
     */
    public function indexAction()
    {
        list($filterForm, $queryBuilder) = $this->filter();

        list($entities, $pagerHtml) = $this->paginator($queryBuilder);

    
        return $this->render('PBComprasBundle:PedidoCompra:index.html.twig', array(
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
        $filterForm = $this->createForm(new PedidoCompraFilterType());
        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('PBComprasBundle:PedidoCompra')->createQueryBuilder('e')->orderBy('e.id', 'DESC');
    
        // Reset filter
        if ($request->getMethod() == 'POST' && $request->get('filter_action') == 'reset') {
            $session->remove('PedidoCompraControllerFilter');
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
                $session->set('PedidoCompraControllerFilter', $filterData);
            }
        } else {
            // Get filter from session
            if ($session->has('PedidoCompraControllerFilter')) {
                $filterData = $session->get('PedidoCompraControllerFilter');
                $filterForm = $this->createForm(new PedidoCompraFilterType(), $filterData);
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
            return $me->generateUrl('compras_pedidocompra', array('page' => $page));
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
     * Finds and displays a PedidoCompra entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository('PBComprasBundle:PedidoCompra')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PedidoCompra entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PBComprasBundle:PedidoCompra:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new PedidoCompra entity.
     *
     */
    public function newAction()
    {
    	$em = $this->getDoctrine()->getEntityManager();
    	$entity = new PedidoCompra();
        
        $entity2 = new PedidoCompraLinea();
        //$entity->addPedidocompralinea($entity2);
        
        $form    = $this->createForm(new PedidoCompraType(), $entity);
        //$factory = new PedidoCompraFactory($em);
        
        //$form = $this->createForm(new PedidoCompraFormType(), $factory);
        return $this->render('PBComprasBundle:PedidoCompra:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new PedidoCompra entity.
     *
     */
    public function createAction()
    {
    	$em = $this->getDoctrine()->getEntityManager();
    	$request = $this->getRequest();
    	$entity  = new PedidoCompra();
    	$entity2 = new PedidoCompraLinea();

        $form    = $this->createForm(new PedidoCompraType(), $entity);
               
        $form->bind($request); 

        if ($form->isValid()) {
        	//$request->request->get('pedidocompralineas')
          $entity->setPedidocompralineas();
        	
        	/*
        	$em = $this->getDoctrine()->getEntityManager();
        	$task = $em->getRepository('AcmeTaskBundle:Task')->find($id);
        	
        	if (!$task) {
        		throw $this->createNotFoundException('No task found for is '.$id);
        	}
        	
        	// Se crea una matriz de los objetos etiqueta actuales en la base de datos
        	foreach ($task->getTags() as $tag) $originalTags[] = $tag;
        	
        	$editForm = $this->createForm(new TaskType(), $task);
        	
        	if ('POST' === $request->getMethod()) {
        		$editForm->bindRequest($this->getRequest());
        	
        		if ($editForm->isValid()) {
        	
        			// filtra $originalTags para que contenga las etiquetas
        			// que ya no están presentes
        			foreach ($task->getTags() as $tag) {
        				foreach ($originalTags as $key => $toDel) {
        					if ($toDel->getId() === $tag->getId()) {
        						unset($originalTags[$key]);
        					}
        				}
        			}
        	
        			// Elimina la relación entre la etiqueta y la Tarea
        			foreach ($originalTags as $tag) {
        				// Elimina la Tarea de la Etiqueta
        				$tag->getTasks()->removeElement($task);
        	
        				// Si se tratara de una relación MuchosAUno, elimina la relación con esto
        				// $tag->setTask(null);
        	
        				$em->persist($tag);
        	
        				// Si deseas eliminar la etiqueta completamente, también lo puedes hacer
        				// $em->remove($tag);
        			}
        	
        			$em->persist($task);
        			$em->flush();
        	
        			// Redirige de nuevo a alguna página de edición
        			return $this->redirect($this->generateUrl('task_edit', array('id' => $id)));
        		}
        	}*/
        	
        	/*
        	$order = new Order();
        	$order->setCustomer($this->customer);
        	
        	foreach (->items as $item) {
        		$order->addItem($item);
        	}        	
        	return $order;
        	 */
        	
        	$em->persist($entity);

            try {$em->flush(); } catch(Exception $e) {
            	die('ERROR: '.$e->getMessage());
            }
            
            $this->get('session')->getFlashBag()->add('success', 'flash.create.success');

            //return $this->redirect($this->generateUrl('compras_pedidocompra'));        } else {
            //$this->get('session')->getFlashBag()->add('error', 'flash.create.error');
        }

        return $this->render('PBComprasBundle:PedidoCompra:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    /**
     * Displays a form to edit an existing PedidoCompra entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PBComprasBundle:PedidoCompra')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PedidoCompra entity.');
        }

        $editForm = $this->createForm(new PedidoCompraType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PBComprasBundle:PedidoCompra:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing PedidoCompra entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PBComprasBundle:PedidoCompra')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PedidoCompra entity.');
        }

        $editForm   = $this->createForm(new PedidoCompraType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.update.success');

            return $this->redirect($this->generateUrl('compras_pedidocompra_edit', array('id' => $id)));
        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.update.error');
        }

        return $this->render('PBComprasBundle:PedidoCompra:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a PedidoCompra entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PBComprasBundle:PedidoCompra')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PedidoCompra entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.delete.success');
        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.delete.error');
        }

        return $this->redirect($this->generateUrl('compras_pedidocompra'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
