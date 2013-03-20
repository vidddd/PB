<?php

namespace PB\ProduccionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ExtrusionController extends Controller
{
    public function indexAction()
    {
		$tabla1 = array();
    	return $this->render('PBProduccionBundle:Extrusion:index.html.twig', array('tabla1' => $tabla1));
    }
    
    public function anadirTrabajoAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$request = $this->get('request');
    	// Saca los trabajos en estado nuevo
    	$query = $em->createQuery('SELECT o FROM PBProduccionBundle:Orden o WHERE o.estado = :esta ORDER BY o.fecha DESC')
    	->setParameter('esta', '1');
    	$entity = $query->getResult();
    
    	return $this->render('PBProduccionBundle:Extrusion:anadir_trabajo.html.twig', array(
    			'entity' => $entity,
    			'error' => '',
    	));
    }
}
