<?php

namespace PB\ProduccionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PB\ProduccionBundle\Entity\Extrusion;

class ExtrusionController extends Controller
{
    public function indexAction()
    {
    	$request = $this->get('request');    	$em = $this->getDoctrine()->getManager();
    	$id = $request->get('id');
		if($id) {
			$maquina = 1;
			$this->anadirOrdenTrabajo($id, $maquina);	
		}
    	
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
    	
    	//$query = $em->createQuery('SELECT o FROM PBProduccionBundle:Orden o LEFT JOIN PBProduccionBundle:Extrusion e WHERE o.estado = 1 ORDER BY o.fecha DESC')->setParameter('esta', '1');
    	//$query = $em->createQuery('SELECT o FROM PBProduccionBundle:Orden o WHERE o.estado = :esta AND o.extrusion=1 ORDER BY o.fecha DESC')->setParameter('esta', '1');
    	$query = $em->createQueryBuilder()->select('o')
    			->from('PBProduccionBundle:Extrusion', 'e')
    			->innerJoin('PBProduccionBundle:Orden', 'o')
    			->where('o.estado = :temporada')
    			->setParameter('temporada', '1');
    	
    	$entity = $query->getQuery()->getResult();
	    //echo $query->getSql();
    	return $this->render('PBProduccionBundle:Extrusion:anadir_trabajo.html.twig', array(
    			'entity' => $entity,
    			'error' => '',
    	));
    }
    
    function anadirOrdenTrabajo($id, $maquinaid) {
    	$em = $this->getDoctrine()->getManager();
    	$orden = $em->getRepository('PBProduccionBundle:Orden')->find($id);
    	if (!$orden) { 		throw $this->createNotFoundException('Unable to find Orden entity.'); }
    	
    	$maquina = $em->getRepository('PBProduccionBundle:Maquina')->find($maquinaid);
    	if (!$maquina) { throw $this->createNotFoundException('Unable to find Maquina entity.'); }
    	
    	$extrusion = new Extrusion();
    	
    	$extrusion->setOrden($orden);
    	$extrusion->setMaquina($maquina);
    	$extrusion->setAncho($orden->getAncho());
    	$extrusion->setGalga($orden->getGalga());
    	($orden->getMetrose()) ? $metros = $orden->getMetrose() : $metros = '';
    	$extrusion->setMetros($metros);
    	$extrusion->setPesoneto('');
    	$extrusion->setPesoteorico('');
    	$orden->setEstado(2);
    	$em->persist($extrusion); $em->persist($orden);	
    	$em->flush();
    	
    }
}
