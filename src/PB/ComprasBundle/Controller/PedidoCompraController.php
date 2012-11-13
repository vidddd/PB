<?php

namespace PB\ComprasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\View\TwitterBootstrapView;
use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Exception\ParseException;
use PB\ComprasBundle\Entity\PedidoCompra;
use PB\ComprasBundle\Entity\PedidoCompraLinea;
use PB\ComprasBundle\Form\PedidoCompraType;
use PB\ComprasBundle\Form\PedidoCompraFilterType;
use PB\ComprasBundle\Form\PedidoCompraLineaType;
use Symfony\Component\HttpFoundation\Response;
use PB\ComprasBundle\Form\Factory\PedidoCompraFactory;
use PB\ComprasBundle\Form\PedidoCompraFormType;
use Ps\PdfBundle\Annotation\Pdf;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use PB\ComprasBundle\Printer\PrintPedidoCompra3;


class PedidoCompraController extends Controller
{
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

    protected function filter()
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        $filterForm = $this->createForm(new PedidoCompraFilterType());
        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('PBComprasBundle:PedidoCompra')->createQueryBuilder('e')->orderBy('e.id', 'DESC');
    
        // Reset filter
        if ($request->getMethod() == 'POST' && $request->get('filter_action') == 'reset') {$session->remove('PedidoCompraControllerFilter');}
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
        //var_dump($queryBuilder->getDql());
        return array($filterForm, $queryBuilder);
    }

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
    
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $yaml = new Parser(); try {	$value = $yaml->parse(file_get_contents(__DIR__ . '/../Resources/config/compras.yml'));} catch (ParseException $e) {printf("Unable to parse the YAML string: %s", $e->getMessage());}        
        $entity = $em->getRepository('PBComprasBundle:PedidoCompra')->find($id);
        $medios = $value['medio_envio'];
        //$entity->setFormaEnvio($medios[$entity->getFormaEnvio()]);
        
        if (!$entity) {throw $this->createNotFoundException('Unable to find PedidoCompra entity.'); }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PBComprasBundle:PedidoCompra:show.html.twig', array(            'entity'      => $entity,  'delete_form' => $deleteForm->createView(),        ));
    }

    public function newAction()
    {
    	//$em = $this->getDoctrine()->getEntityManager();
    	$entity = new PedidoCompra();
        $form    = $this->createForm(new PedidoCompraType(), $entity);
        return $this->render('PBComprasBundle:PedidoCompra:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function createAction()
    {
    	$em = $this->getDoctrine()->getEntityManager();
    	$request = $this->getRequest();
    	$entity  = new PedidoCompra();
        $form    = $this->createForm(new PedidoCompraType(), $entity);               
        $form->bind($request); 

        if ($form->isValid()) {
        	foreach ($entity->getPedidocompralineas() as $linea)
        	{
        		$linea->setPedidocompralinea($entity);
        	}
        	$em->persist($entity);
            try {$em->flush(); } catch(Exception $e) {die('ERROR: '.$e->getMessage());}
            
            $this->get('session')->getFlashBag()->add('success', 'Nuevo Pedido de compra creado');
            
            return $this->redirect($this->generateUrl('compras_pedidocompra_show', array('id' => $entity->getId())));       } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.create.error');
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
        if (!$entity) {throw $this->createNotFoundException('Unable to find PedidoCompra entity.');}

        $editForm = $this->createForm(new PedidoCompraType(), $entity);

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PBComprasBundle:PedidoCompra:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
          //  'delete_form' => $deleteForm->createView(),
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

        if (!$entity) {throw $this->createNotFoundException('Unable to find PedidoCompra entity.'); }

        $beforeSaveLineas = $currentLineasIds = array();
        foreach ($entity->getPedidocompralineas() as $linea)
        	$beforeSaveLineas [$linea->getId()] = $linea;

        $editForm   = $this->createForm(new PedidoCompraType(), $entity);
        $deleteForm = $this->createDeleteForm($id);
        $request = $this->getRequest();
        $editForm->bind($request);
        
        if ($editForm->isValid()) {
        	
        	foreach ($entity->getPedidocompralineas() as $linea){
        		$linea->setPedidocompralinea($entity);
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

            return $this->redirect($this->generateUrl('compras_pedidocompra_show', array('id' => $id)));
        } else {            $this->get('session')->getFlashBag()->add('error', 'flash.update.error');}
        return $this->render('PBComprasBundle:PedidoCompra:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest(); $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager(); $entity = $em->getRepository('PBComprasBundle:PedidoCompra')->find($id);
            if (!$entity) { throw $this->createNotFoundException('Unable to find PedidoCompra entity.');}
            $em->remove($entity); $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.delete.success');
        } else {$this->get('session')->getFlashBag()->add('error', 'flash.delete.error'); }

        return $this->redirect($this->generateUrl('compras_pedidocompra'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))->add('id', 'hidden')->getForm();
    }
    
    /**
     * @Pdf()
     * @Template()
     */
    public function imprimirAction($id)
    {
	   
	    $em = $this->getDoctrine()->getManager();
	    $yaml = new Parser(); try {	$value = $yaml->parse(file_get_contents(__DIR__ . '/../Resources/config/compras.yml'));
	    } catch (ParseException $e) { 	printf("Unable to parse the YAML string: %s", $e->getMessage());}
	    $entity = $em->getRepository('PBComprasBundle:PedidoCompra')->find($id);
	    $medios = $value['medio_envio'];
	    //$entity->setFormaEnvio($medios[$entity->getFormaEnvio()]);
	    if (!$entity) {	throw $this->createNotFoundException('Unable to find PedidoCompra entity.'); }
	    
	    $html = $this->renderView('PBComprasBundle:PedidoCompra:print.html.twig', array('entity' => $entity));
	    
	    //$printer = new PrintPedidoCompra();  //TCPDF
	    //$printer = new PrintPedidoCompra2(); //DOMPDF
	    $printer = new PrintPedidoCompra3(); //HTML2PDF
	    $response = new Response($printer->getPdf($html));
	    $response->headers->set('Content-Type', 'application/pdf'); 
	    $response->headers->set('Content-Disposition', 'inline; filename="PedidoCompra.pdf"');
	    return $response;
	  
    
    }
   
}
