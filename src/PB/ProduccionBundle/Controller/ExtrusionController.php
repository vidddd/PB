<?php

namespace PB\ProduccionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PB\ProduccionBundle\Entity\Extrusion;
use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Exception\ParseException;

class ExtrusionController extends Controller
{
	public function indexAction()
	{
		return $this->render('PBProduccionBundle:Extrusion:index.html.twig');
	}
    public function extrusionAction($maquina)
    {
    	$request = $this->get('request');    	$em = $this->getDoctrine()->getManager();
    	
    	$maquinae = $em->getRepository('PBProduccionBundle:Maquina')->find($maquina);
    	
		$yaml = new Parser(); try { $value = $yaml->parse(file_get_contents(__DIR__ . '/../../VentasBundle/Resources/config/ventas.yml')); } catch (ParseException $e) {	printf("Unable to parse the YAML string: %s", $e->getMessage()); }
		$tipos = $value['tipo_material'];
		
		$defaultData = array();
		
		$form = $this->createFormBuilder($defaultData)
		->add('material', 'choice', array( 'choices' => $tipos,'error_bubbling' => true, 'empty_value' => ''))
		->add('ancho', 'text')->add('orden', 'text')
		->add('galga', 'text')
		->getForm();
		
    	$query = $em->createQueryBuilder()->select('e')->from('PBProduccionBundle:Extrusion', 'e')
    			->where('e.maquina = :maq')
    			->setParameter('maq', $maquina);
    	
    	$extrusion = $query->getQuery()->getResult();
		
    	return $this->render('PBProduccionBundle:Extrusion:extrusion.html.twig', array('maquina' => $maquina,'codigo' => $maquinae->getCodigo(),'nombre' => $maquinae->getNombre(), 'form' => $form->createView(), 'extrusion' => $extrusion));
    }
    
    public function anadirTrabajoAction()
    {

    	$em = $this->getDoctrine()->getManager();
    	$request = $this->get('request');
    	// Saca los trabajos en estado nuevo
    	
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
    public function anadirOrdenFabricacionAction()
    {
    
    	$em = $this->getDoctrine()->getManager();
    	$request = $this->get('request');
    	// Saca los trabajos en estado nuevo
    	$qb = $em->getRepository('PBProduccionBundle:Orden')->createQueryBuilder('o')->orderBy('o.id', 'DESC');
    	$qb->andwhere('o.estado = :estadoi');  	$qb->setParameter('estadoi', 1);
    	
    	$entity = $qb->getQuery()->getResult();
    	
    	//echo $query->getSql();
    	return $this->render('PBProduccionBundle:Extrusion:anadir_orden_fabricacion.html.twig', array(
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
