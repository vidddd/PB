<?php

namespace PB\VentasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\View\TwitterBootstrapView;

use PB\VentasBundle\Entity\Pedido;
use PB\VentasBundle\Form\PedidoType;
use PB\VentasBundle\Form\PedidoFilterType;

/**
 * Pedido controller.
 *
 */
class PedidoController extends Controller
{
    /**
     * Lists all Pedido entities.
     *
     */
    public function indexAction()
    {
        list($filterForm, $queryBuilder) = $this->filter();
        list($entities, $pagerHtml) = $this->paginator($queryBuilder);
        return $this->render('PBVentasBundle:Pedido:index.html.twig', array(
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
        $filterForm = $this->createForm(new PedidoFilterType());
        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('PBVentasBundle:Pedido')->createQueryBuilder('e')->orderBy('e.id', 'DESC');
    
        // Reset filter
        if ($request->getMethod() == 'POST' && $request->get('filter_action') == 'reset') {$session->remove('PedidoControllerFilter');}
    
        // Filter action
        if ($request->getMethod() == 'POST' && $request->get('filter_action') == 'filter') {
            // Bind values from the request
            $filterForm->bind($request);

            if ($filterForm->isValid()) {
                // Build the query from the given form object
                $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($filterForm, $queryBuilder);
                // Save filter to session
                $filterData = $filterForm->getData();
                $session->set('PedidoControllerFilter', $filterData);
            }
        } else {
            // Get filter from session
            if ($session->has('PedidoControllerFilter')) {
                $filterData = $session->get('PedidoControllerFilter');
                $filterForm = $this->createForm(new PedidoFilterType(), $filterData);
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
            return $me->generateUrl('pedido', array('page' => $page));
        };
    
        // Paginator - view
        $translator = $this->get('translator');
        $view = new TwitterBootstrapView();
        $pagerHtml = $view->render($pagerfanta, $routeGenerator, array(
            'proximity' => 3,
            'prev_message' => $translator->trans('views.index.pagprev', array(), 'JordiLlonchCrudGeneratorBundle'),
            'next_message' => $translator->trans('views.index.pagnext', array(), 'JordiLlonchCrudGeneratorBundle'),
        ));
       // var_dump($queryBuilder->getDql());
        return array($entities, $pagerHtml);
    }
    
    /**
     * Finds and displays a Pedido entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('PBVentasBundle:Pedido')->find($id);
        if (!$entity) { throw $this->createNotFoundException('Unable to find Pedido entity.');}
        $deleteForm = $this->createDeleteForm($id);
        return $this->render('PBVentasBundle:Pedido:show.html.twig', array('entity'      => $entity,'delete_form' => $deleteForm->createView(),        ));
    }
    
    public function imprimirAction($id)
    {
    	$em = $this->getDoctrine()->getManager();
    	$entity = $em->getRepository('PBVentasBundle:Pedido')->find($id);
    	if (!$entity) {	throw $this->createNotFoundException('No se puede encontrar el pedido.');}
    
    	$pdf = new \Fpdf_Fpdf;
    	$pdf->AddPage();
    	$pdf->Ln();$pdf->Ln();
    	//$pdf->Image('./logo/PBbn.jpg',20,10,30);// (x,y,ancho)
    	$pdf->Ln();
    	$pdf->Cell(95);
    	$pdf->Cell(80,10,"",'',0,'C');
    	$pdf->Ln(8);
    	
    	$pdf->SetFillColor(255,255,255);
    	$pdf->SetTextColor(0);
    	$pdf->SetDrawColor(0,0,0);
    	$pdf->SetLineWidth(.2);
    	$pdf->SetFont('Arial','B',20);
    	
    	$pdf->Cell(40,65,'PEDIDO');
    	$pdf->SetX(10);
    	
    	$pdf->SetFont('Arial','B',9);
    	$pdf->Cell(95);
    	$pdf->Cell(80,4,"",'LRT',0,'L',1);
    	$pdf->Ln(4);
    	
    	$pdf->Cell(95);
    	$pdf->Cell(80,4,'David','LR',0,'L',1);
    	$pdf->Ln(4);
    	
    	$pdf->Cell(95);
    	$pdf->Cell(80,4,'','LR',0,'L',1);
    	$pdf->Ln(4);
    	//Calculamos la provinci
    	$pdf->Cell(95);
    	$pdf->Cell(80,4,'','LR',0,'L',1);
    	$pdf->Ln(4);
    	
    	$pdf->Cell(95);
    	$pdf->Cell(80,4,"Tlfno:   " . "Fax:",'LR',0,'L',1);
    	$pdf->Ln(4);
    	
    	$pdf->Cell(95);
    	$pdf->Cell(80,4,"",'LRB',0,'L',1);
    	$pdf->Ln(10);
        $fichier = $pdf->Output();;

        $response = new Response();
        $response->clearHttpHeaders();
        $response->setContent(file_get_contents($fichier));
        $response->headers->set('Content-Type', 'application/force-download');
        $response->headers->set('Content-disposition', 'filename='. $fichier);
 
        return $response;
    }

    /**
     * Displays a form to create a new Pedido entity.
     *
     */
    public function newAction()
    {
        $entity = new Pedido();
        $form   = $this->createForm(new PedidoType(), $entity);
        return $this->render('PBVentasBundle:Pedido:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Pedido entity.
     *
     */
    public function createAction()
    {
        $entity  = new Pedido();
        $request = $this->getRequest();
        $form    = $this->createForm(new PedidoType(), $entity);
        $form->bind($request);
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.create.success');

            return $this->redirect($this->generateUrl('pedido_show', array('id' => $entity->getId())));        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.create.error');
        }

        return $this->render('PBVentasBundle:Pedido:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    /**
     * Displays a form to edit an existing Pedido entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PBVentasBundle:Pedido')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pedido entity.');
        }

        $editForm = $this->createForm(new PedidoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PBVentasBundle:Pedido:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Pedido entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PBVentasBundle:Pedido')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pedido entity.');
        }

        $editForm   = $this->createForm(new PedidoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.update.success');

            return $this->redirect($this->generateUrl('pedido_show', array('id' => $id)));
        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.update.error');
        }

        return $this->render('PBVentasBundle:Pedido:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Pedido entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PBVentasBundle:Pedido')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Pedido entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.delete.success');
        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.delete.error');
        }

        return $this->redirect($this->generateUrl('pedido'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
