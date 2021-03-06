<?php

namespace PB\AlmacenBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\View\TwitterBootstrapView;

use PB\AlmacenBundle\Entity\Almacen;
use PB\AlmacenBundle\Form\AlmacenType;
use PB\AlmacenBundle\Form\AlmacenFilterType;

/**
 * Almacen controller.
 *
 */
class AlmacenController extends Controller
{
    /**
     * Lists all Almacen entities.
     *
     */
    public function indexAction()
    {
        $request = $this->getRequest();$session = $request->getSession();
        
    	if($this->getRequest()->get('cuantos')) { $cuantos = $this->getRequest()->get('cuantos');
    	} else if ($session->get('AlamcenCuantos')){
    		$cuantos = $session->get('AlmacenCuantos');
    	} else { $cuantos = 10; }
    	
        list($filterForm, $queryBuilder) = $this->filter();
        list($entities, $pagerHtml) = $this->paginator($queryBuilder, $cuantos);

        $cuantosarr = array('10' => '10','25' => '25','50' => '50','100' => '100');
        if($cuantos) $session->set('ProveedorCuantos', $cuantos);
        ($cuantos)? $entradas = $cuantos : $entradas = 10;
        return $this->render('PBAlmacenBundle:Almacen:index.html.twig', array(
            'entities' => $entities,'cuantos' => $cuantosarr, 'entradas' => $entradas,
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
        $filterForm = $this->createForm(new AlmacenFilterType());
        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('PBAlmacenBundle:Almacen')->createQueryBuilder('e')->orderBy('e.id', 'DESC');

        if ($request->getMethod() == 'POST' && $request->get('filter_action') == 'reset') {
            $session->remove('AlmacenControllerFilter');
        }

        if ($request->getMethod() == 'POST' && $request->get('filter_action') == 'filter') {
            $filterForm->bind($request);

            if ($filterForm->isValid()) {
                $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($filterForm, $queryBuilder);
                // Save filter to session
                $filterData = $filterForm->getData();
                $session->set('AlmacenControllerFilter', $filterData);
            }
        } else {
            // Get filter from session
            if ($session->has('AlmacenControllerFilter')) {
                $filterData = $session->get('AlmacenControllerFilter');
                $filterForm = $this->createForm(new AlmacenFilterType(), $filterData);
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
        $pagerfanta->setCurrentPage($currentPage);
        $pagerfanta->setMaxPerPage($cuantos);
        $entities = $pagerfanta->getCurrentPageResults();
    
        // Paginator - route generator
        $me = $this;
        $routeGenerator = function($page) use ($me)
        {
            return $me->generateUrl('almacen', array('page' => $page));
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
     * Finds and displays a Almacen entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PBAlmacenBundle:Almacen')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Almacen entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PBAlmacenBundle:Almacen:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Almacen entity.
     *
     */
    public function newAction()
    {
        $entity = new Almacen();
        $form   = $this->createForm(new AlmacenType(), $entity);

        return $this->render('PBAlmacenBundle:Almacen:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Almacen entity.
     *
     */
    public function createAction()
    {
        $entity  = new Almacen();
        $request = $this->getRequest();
        $form    = $this->createForm(new AlmacenType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.create.success');

            return $this->redirect($this->generateUrl('almacen'));        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.create.error');
        }

        return $this->render('PBAlmacenBundle:Almacen:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    /**
     * Displays a form to edit an existing Almacen entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PBAlmacenBundle:Almacen')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Almacen entity.');
        }

        $editForm = $this->createForm(new AlmacenType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PBAlmacenBundle:Almacen:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Almacen entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PBAlmacenBundle:Almacen')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Almacen entity.');
        }

        $editForm   = $this->createForm(new AlmacenType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.update.success');

            return $this->redirect($this->generateUrl('almacen_edit', array('id' => $id)));
        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.update.error');
        }

        return $this->render('PBAlmacenBundle:Almacen:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Almacen entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PBAlmacenBundle:Almacen')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Almacen entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.delete.success');
        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.delete.error');
        }

        return $this->redirect($this->generateUrl('almacen'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
