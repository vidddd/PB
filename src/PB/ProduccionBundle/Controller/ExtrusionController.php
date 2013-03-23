<?php

namespace PB\ProduccionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ExtrusionController extends Controller
{
    public function indexAction($id)
    {
    	if($id != '1') {
    		echo $id;
    	}
    	$em = $this->getDoctrine()->getManager();
		
		$extrusion = $em->getRepository('PBProduccionBundle:Extrusion');
		$tabla1 = $extrusion->getExtrusion(1);
		$tabla2 = $extrusion->getExtrusion(2);
		$tabla3 = $extrusion->getExtrusion(3);
		$tabla4 = $extrusion->getExtrusion(4);
		$tabla5 = $extrusion->getExtrusion(5);
		
    	return $this->render('PBProduccionBundle:Extrusion:index.html.twig', array('tabla1' => $tabla1, 'tabla2' => $tabla2));
    }
    
    public function anadirTrabajoAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$request = $this->get('request');
    	// Saca los trabajos en estado nuevo
    	$query = $em->createQuery('SELECT o FROM PBProduccionBundle:Orden o WHERE o.estado = :esta AND o.extrusion=1 ORDER BY o.fecha DESC')
    	->setParameter('esta', '1');
    	$entity = $query->getResult();
        echo '222'; die;
    	return $this->render('PBProduccionBundle:Extrusion:anadir_trabajo.html.twig', array(
    			'entity' => $entity,
    			'error' => '',
    	));
    }
}
