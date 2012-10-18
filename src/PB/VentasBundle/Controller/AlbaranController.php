<?php

namespace PB\VentasBundle\Controller;

use
    Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Template
;

use
    PB\VentasBundle\Entity\Factory\AlbaranFactory,
    PB\VentasBundle\Entity\Albaran,
    PB\VentasBundle\Form\AlbaranFormType
;


class AlbaranController extends Controller
{
    /**
     */
    public function indexAction()
    {
    	return $this->render('PBVentasBundle:Albaran:index.html.twig');
    }
    
    public function newAction(){
    	$em = $this->getDoctrine()->getEntityManager();
    	
    	$factory = new AlbaranFactory($em);
    	
    	$form = $this->createForm(new AlbaranFormType(), $factory);
    	
    	$request = $this->getRequest();
    	
    	if ('POST' === $request->getMethod()) {
    	
    		$form->bindRequest($request);
    	
    		if ($form->isValid()) {
    	
    			$em->persist($order = $factory->make());
    			$em->flush();
    	
    			$this->get('session')->setFlash('success', 'New order were saved!');
    	        /*
    			return $this->redirect($this->generateUrl('albaran_new', array(
    					'id' => $order->getId(),
    			)));*/
    		}
    	}
    	return $this->render('PBVentasBundle:Albaran:new.html.twig', array(
    			//'entity' => $entity,
    			'form'   => $form->createView(),
    	));
    	//return array('form' => $form->createView());
    }
}
