<?php

namespace PB\CalidadBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\View\TwitterBootstrapView;

use PB\CalidadBundle\Entity\Noconformidad;
use PB\CalidadBundle\Form\NoconformidadType;
use PB\CalidadBundle\Form\NoconformidadFilterType;

/**
 * Noconformidad controller.
 *
 */
class NoconformidadController extends Controller
{
    public function indexAction()
    {
    	$request = $this->getRequest();$session = $request->getSession();   	 
    	if($this->getRequest()->get('cuantos')) {
    		$cuantos = $this->getRequest()->get('cuantos');
    	} else if ($session->get('NoconformidadCuantos')){
    		$cuantos = $session->get('NoconformidadCuantos');
    	} else { $cuantos = 10;
    	}
    	
    	list($filterForm, $queryBuilder) = $this->filter();
        list($entities, $pagerHtml) = $this->paginator($queryBuilder, $cuantos);
        $cuantosarr = array('10' => '10','25' => '25','50' => '50','100' => '100');
        if($cuantos) $session->set('NoconformidadCuantos', $cuantos);
        ($cuantos)? $entradas = $cuantos : $entradas = 10;
        
        return $this->render('PBCalidadBundle:Noconformidad:index.html.twig', array(
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
        $filterForm = $this->createForm(new NoconformidadFilterType());
        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('PBCalidadBundle:Noconformidad')->createQueryBuilder('e');
    
        // Reset filter
        if ($request->getMethod() == 'POST' && $request->get('filter_action') == 'reset') {
            $session->remove('NoconformidadControllerFilter');
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
                $session->set('NoconformidadControllerFilter', $filterData);
            }
        } else {
            // Get filter from session
            if ($session->has('NoconformidadControllerFilter')) {
                $filterData = $session->get('NoconformidadControllerFilter');
                $filterForm = $this->createForm(new NoconformidadFilterType(), $filterData);
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
        $adapter = new DoctrineORMAdapter($queryBuilder);
        $pagerfanta = new Pagerfanta($adapter);
        $currentPage = $this->getRequest()->get('page', 1);
        $pagerfanta->setCurrentPage($currentPage);
        $pagerfanta->setMaxPerPage($cuantos);
        $entities = $pagerfanta->getCurrentPageResults();
        $me = $this;
        $routeGenerator = function($page) use ($me)
        {
            return $me->generateUrl('noconformidad', array('page' => $page));
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
    
    /**
     * Finds and displays a Noconformidad entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('PBCalidadBundle:Noconformidad')->find($id);
        if (!$entity) {  throw $this->createNotFoundException('Unable to find Noconformidad entity.'); }
        $deleteForm = $this->createDeleteForm($id);
        return $this->render('PBCalidadBundle:Noconformidad:show.html.twig', array('entity' => $entity,  'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Noconformidad entity.
     *
     */
    public function newAction()
    {
        $entity = new Noconformidad();
        $form   = $this->createForm(new NoconformidadType(), $entity);

        return $this->render('PBCalidadBundle:Noconformidad:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Noconformidad entity.
     *
     */
    public function createAction()
    {
        $entity  = new Noconformidad();
        $request = $this->getRequest();
        $form    = $this->createForm(new NoconformidadType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.create.success');

            return $this->redirect($this->generateUrl('noconformidad_show', array('id' => $entity->getId())));        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.create.error');
        }

        return $this->render('PBCalidadBundle:Noconformidad:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    /**
     * Displays a form to edit an existing Noconformidad entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PBCalidadBundle:Noconformidad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Noconformidad entity.');
        }

        $editForm = $this->createForm(new NoconformidadType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PBCalidadBundle:Noconformidad:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Noconformidad entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PBCalidadBundle:Noconformidad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Noconformidad entity.');
        }

        $editForm   = $this->createForm(new NoconformidadType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.update.success');

            return $this->redirect($this->generateUrl('noconformidad_edit', array('id' => $id)));
        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.update.error');
        }

        return $this->render('PBCalidadBundle:Noconformidad:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Noconformidad entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PBCalidadBundle:Noconformidad')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Noconformidad entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.delete.success');
        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.delete.error');
        }

        return $this->redirect($this->generateUrl('noconformidad'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
