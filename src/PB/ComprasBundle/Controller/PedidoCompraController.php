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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use PB\ComprasBundle\Printer\PrintPedidoCompra3;
use PB\ComprasBundle\Entity\AlbaranCompra;
use PB\ComprasBundle\Entity\AlbaranCompraLinea;


class PedidoCompraController extends Controller
{
    public function indexAction()
    {
    	$request = $this->getRequest();$session = $request->getSession();
    	
    	if($this->getRequest()->get('cuantos')) {
    		$cuantos = $this->getRequest()->get('cuantos');
    	} else if ($session->get('PedidoCompraCuantos')){
    		$cuantos = $session->get('PedidoCompraCuantos');
    	} else { $cuantos = 10; }
    	 
    	list($filterForm, $queryBuilder) = $this->filter();
        list($entities, $pagerHtml) = $this->paginator($queryBuilder, $cuantos);
        
        $cuantosarr = array('10' => '10','25' => '25','50' => '50','100' => '100');  
        if($cuantos) $session->set('PedidoCompraCuantos', $cuantos);
        ($cuantos)? $entradas = $cuantos : $entradas = 10;

        return $this->render('PBComprasBundle:PedidoCompra:index.html.twig', array(
            'entities' => $entities, 'cuantos' => $cuantosarr, 'entradas' => $entradas,
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
        //INNER JOIN CON PROVEEDORES PARA FILTRAR POR EL TIPO 
        $queryBuilder = $em->getRepository('PBComprasBundle:PedidoCompra')
        					->createQueryBuilder('e')
        					->innerJoin('e.proveedor', 'p')->orderBy('e.id', 'DESC')
        					->select('DISTINCT e, p');
   
        if ($request->getMethod() == 'POST' && $request->get('filter_action') == 'reset') {$session->remove('PedidoCompraControllerFilter');}
        if ($request->getMethod() == 'POST' && $request->get('filter_action') == 'filter') {
            $filterForm->bind($request);

            if ($filterForm->isValid()) {
                $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($filterForm, $queryBuilder);
                $filterData = $filterForm->getData();
                $session->set('PedidoCompraControllerFilter', $filterData);
            }
        } else {
            if ($session->has('PedidoCompraControllerFilter')) {
                $filterData = $session->get('PedidoCompraControllerFilter');
                $filterForm = $this->createForm(new PedidoCompraFilterType(), $filterData);
                $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($filterForm, $queryBuilder);
            }
        }
       // var_dump($queryBuilder->getDql());
        return array($filterForm, $queryBuilder);
    }

    protected function paginator($queryBuilder, $cuantos)
    {
        $request = $this->getRequest(); $session = $request->getSession();
        $adapter = new DoctrineORMAdapter($queryBuilder);
        $pagerfanta = new Pagerfanta($adapter);
        $currentPage = $this->getRequest()->get('page', 1);
        $pagerfanta->setMaxPerPage($cuantos);
        $pagerfanta->setCurrentPage($currentPage);
        $entities = $pagerfanta->getCurrentPageResults();
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

        return $this->render('PBComprasBundle:PedidoCompra:show.html.twig', array( 'entity'      => $entity,  'delete_form' => $deleteForm->createView(),        ));
    }
    
    public function showLightboxAction($id)
    {
    	$em = $this->getDoctrine()->getManager();
    	$yaml = new Parser(); try {	$value = $yaml->parse(file_get_contents(__DIR__ . '/../Resources/config/compras.yml'));
    	} catch (ParseException $e) {
    		printf("Unable to parse the YAML string: %s", $e->getMessage());
    	}
    	$entity = $em->getRepository('PBComprasBundle:PedidoCompra')->find($id);
    	$medios = $value['medio_envio'];

    	//$entity->setFormaEnvio($medios[$entity->getFormaEnvio()]);
    
    	if (!$entity) {
    		throw $this->createNotFoundException('Unable to find PedidoCompra entity.');
    	}
    
    	$deleteForm = $this->createDeleteForm($id);
    
    	return $this->render('PBComprasBundle:PedidoCompra:show_lightbox.html.twig', array( 'entity'      => $entity,  'delete_form' => $deleteForm->createView(),        ));
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
        	// CREANDO ALBARAN DE COMPRA
        	$albaran = new AlbaranCompra();
        	$albaran->setProveedor($entity->getProveedor());
        	$albaran->setReferencia($entity->getReferencia());
        	$albaran->setImporte($entity->getImporte());
        	$albaran->setTotal($entity->getTotal());
        	$albaran->setIva($entity->getIva());
        	$albaran->setDescuento($entity->getDescuento());
        	$albaran->setObservaciones($entity->getObservaciones());
        	$albaran->setEstado($entity->getEstado());
        	$albaran->setFecha(new \DateTime());
        	$albaran->setAlbarancompraPedido($entity);
        	
        	foreach ($entity->getPedidocompralineas() as $linea)
        	{
        		$alinea = new AlbaranCompraLinea();
        		 //$flinea->setFactura($factura);	
        		$alinea->setAlbarancompralinea($albaran);
        		$alinea->setReferencia($linea->getReferencia());
        		$alinea->setDescripcion($linea->getDescripcion());
        		$alinea->setCantidad($linea->getCantidad());
        		$alinea->setPrecio($linea->getPrecio());
        		$alinea->setDescuento($linea->getDescuento());
        		$alinea->setTotal($linea->getTotal());
        		$alinea->setEstado(1);
        		$albaran->addAlbarancompralinea($alinea);
        	}
        	
        	$em->persist($entity); $em->persist($albaran); 
        	$em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Nuevo Pedido de compra creado');
            $this->get('session')->getFlashBag()->add('success', 'Nuevo Albaran de compra creado');
            
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
            $this->get('session')->getFlashBag()->add('success', 'Pedido de Compra eliminado');
        } else {$this->get('session')->getFlashBag()->add('error', 'flash.delete.error'); }

        return $this->redirect($this->generateUrl('compras_pedidocompra'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))->add('id', 'hidden')->getForm();
    }
    
    /**
     */
    public function imprimirAction($id)
    {	   
	    $html = $this->getHtmlpdf($id);
	    
	    $printer = new PrintPedidoCompra3(); //HTML2PDF
	    $response = new Response($printer->getPdf($html));
	    $response->headers->set('Content-Type', 'application/pdf'); 
	    $response->headers->set('Content-Disposition', 'inline; filename="PedidoCompra.pdf"');
	    return $response;
	  
    
    }
    public function mailAction($id){
    	
    	$em = $this->getDoctrine()->getManager();$request = $this->getRequest();
    	$entity = $em->getRepository('PBComprasBundle:PedidoCompra')->find($id);
    	if (!$entity) {throw $this->createNotFoundException('Unable to find PedidoCompra entity.');}
    	
    	$defaultData = array( 'email' => $entity->getProveedor()->getEmail() , 'subject' => 'Pedido de Compra', 'message' => '');
    	$form = $this->createFormBuilder($defaultData)
    	->add('email', 'email')
    	->add('subject', 'text')
    	->add('body', 'textarea')
    	->getForm();
    	
    	$html = $this->getHtmlpdf($id);
    	$printer = new PrintPedidoCompra3(); //HTML2PDF
    	$pdf = $printer->getPdf($html);
    	$attachment = \Swift_Attachment::newInstance($pdf, 'PedidoCompra.pdf', 'application/pdf');
    	
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
		   $this->get('session')->getFlashBag()->add('success', 'Pedido de Compra enviado a: '. $data['email'].'');
		   return $this->redirect($this->generateUrl('compras_pedidocompra'));
    	}
    	
    	return $this->render('PBComprasBundle:PedidoCompra:mail.html.twig', array(
    			'entity'      => $entity,	'form'   => $form->createView(),
    	));
    }
    private function getHtmlpdf($id) {
    	$em = $this->getDoctrine()->getManager();
    	$entity = $em->getRepository('PBComprasBundle:PedidoCompra')->find($id);
    	if (!$entity) {throw $this->createNotFoundException('Unable to find PedidoCompra entity.');}
    	$request = $this->getRequest();
    	$url = $this->container->getParameter('url');
    	$limit = 13;
    	$lineas = $entity->getPedidocompralineas(); $numl = count($lineas);
    	if ( $limit >= $numl ) $lin = $limit-$numl; else $lin = 0;
    	
    	$html = $this->renderView('PBComprasBundle:PedidoCompra:print.html.twig', array('entity' => $entity, 'url' => $url, 'limit' => $lin));
    	 
 		return $html;
    }
}
