<?php

namespace PB\VentasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\View\TwitterBootstrapView;

use PB\VentasBundle\Entity\PedidoCliente;
use PB\VentasBundle\Form\PedidoClienteType;
use PB\VentasBundle\Form\PedidoClienteFilterType;
use PB\VentasBundle\Printer\PrintPedidoCliente;
use Symfony\Component\HttpFoundation\Response;

/**
 * PedidoCliente controller.
 *
 */
class PedidoClienteController extends Controller
{
    /**
     * Lists all PedidoCliente entities.
     *
     */
    public function indexAction()
    {
    	$request = $this->getRequest();$session = $request->getSession();
    	
    	list($filterForm, $queryBuilder) = $this->filter();
    	if($this->getRequest()->get('cuantos')) {
    		$cuantos = $this->getRequest()->get('cuantos');
    	} else if ($session->get('PedidoCuantos')){
    		$cuantos = $session->get('PedidoCuantos');
    	} else { $cuantos = 10;
    	}
    	
        list($entities, $pagerHtml) = $this->paginator($queryBuilder, $cuantos);
        
        $cuantosarr = array('10' => '10','25' => '25','50' => '50','100' => '100');
        if($cuantos) $session->set('PedidoCuantos', $cuantos);
        ($cuantos)? $entradas = $cuantos : $entradas = 10;
    
        return $this->render('PBVentasBundle:PedidoCliente:index.html.twig', array(
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
        $filterForm = $this->createForm(new PedidoClienteFilterType());
        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('PBVentasBundle:PedidoCliente')->createQueryBuilder('e')->orderBy('e.id', 'DESC');

        if ($request->getMethod() == 'POST' && $request->get('filter_action') == 'reset') {
            $session->remove('PedidoClienteControllerFilter');
        }
       if ($request->getMethod() == 'POST' && $request->get('filter_action') == 'filter') {
            // Bind values from the request
            $filterForm->bind($request);

            if ($filterForm->isValid()) {
                // Build the query from the given form object
                $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($filterForm, $queryBuilder);
                // Save filter to session
                $filterData = $filterForm->getData();
                $session->set('PedidoClienteControllerFilter', $filterData);
            }
        } else {
            // Get filter from session
            if ($session->has('PedidoClienteControllerFilter')) {
                $filterData = $session->get('PedidoClienteControllerFilter');
                $filterForm = $this->createForm(new PedidoClienteFilterType(), $filterData);
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
        $pagerfanta->setMaxPerPage($cuantos);
        $currentPage = $this->getRequest()->get('page', 1);
        $pagerfanta->setCurrentPage($currentPage);
        $entities = $pagerfanta->getCurrentPageResults();
    
        // Paginator - route generator
        $me = $this;
        $routeGenerator = function($page) use ($me)
        {
            return $me->generateUrl('pedidocliente', array('page' => $page));
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
     * Finds and displays a PedidoCliente entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PBVentasBundle:PedidoCliente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PedidoCliente entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PBVentasBundle:PedidoCliente:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new PedidoCliente entity.
     *
     */
    public function newAction()
    {
        $entity = new PedidoCliente();
        $form   = $this->createForm(new PedidoClienteType(), $entity);

        return $this->render('PBVentasBundle:PedidoCliente:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new PedidoCliente entity.
     *
     */
    public function createAction()
    {
        $entity  = new PedidoCliente();
        $request = $this->getRequest();
        $form    = $this->createForm(new PedidoClienteType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Nuevo Pedido Creado');

            return $this->redirect($this->generateUrl('pedidocliente', array('id' => $entity->getId())));        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.create.error');
        }

        return $this->render('PBVentasBundle:PedidoCliente:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    /**
     * Displays a form to edit an existing PedidoCliente entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PBVentasBundle:PedidoCliente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PedidoCliente entity.');
        }

        $editForm = $this->createForm(new PedidoClienteType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PBVentasBundle:PedidoCliente:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing PedidoCliente entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PBVentasBundle:PedidoCliente')->find($id);

        if (!$entity) {    throw $this->createNotFoundException('Unable to find PedidoCliente entity.'); }

        $editForm   = $this->createForm(new PedidoClienteType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Pedido actualizado correctamente');

            return $this->redirect($this->generateUrl('pedidocliente_show', array('id' => $id)));
        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.update.error');
        }

        return $this->render('PBVentasBundle:PedidoCliente:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a PedidoCliente entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PBVentasBundle:PedidoCliente')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PedidoCliente entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.delete.success');
        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.delete.error');
        }

        return $this->redirect($this->generateUrl('pedidocliente'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    public function printAction($id)
    {
    
    	$html = $this->getHtmlpdf($id);
    	$printer = new PrintPedidoCliente(); //HTML2PDF
    	$response = new Response($printer->getPdf($html));
    	 
    	$response->headers->set('Content-Type', 'application/pdf');
    	$response->headers->set('Content-Disposition', 'inline; filename="PedidoCliente.pdf"');
    	return $response;
    }
    /*
    public function mailAction($id){
    
    	$em = $this->getDoctrine()->getManager();$request = $this->getRequest();
    	$entity = $em->getRepository('PBVentasBundle:Presupuesto')->find($id);
    	if (!$entity) {
    		throw $this->createNotFoundException('Unable to find Presupuesto entity.');
    	}
    
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
    }*/
    
    private function getHtmlpdf($id) {
    	$em = $this->getDoctrine()->getManager();
    	$entity = $em->getRepository('PBVentasBundle:PedidoCliente')->find($id);
    	if (!$entity) {	throw $this->createNotFoundException('Unable to find Pedido Cliente entity.'); }
    	 
    	$request = $this->getRequest();
    	$url = $this->container->getParameter('url');
    	
    	$html = $this->renderView('PBVentasBundle:PedidoCliente:print.html.twig', array('entity' => $entity,'url'  => $url));
    	 
    	return $html;
    }
    
}
