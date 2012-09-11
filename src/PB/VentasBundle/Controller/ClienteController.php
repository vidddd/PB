<?php

namespace PB\VentasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use PB\VentasBundle\Entity\Cliente;
use PB\VentasBundle\Form\ClienteType;

/**
 * Cliente controller.
 *
 */
class ClienteController extends Controller
{

	protected $_commonNamespace;
	
	/**
	*/
    public function indexAction()
    {
    	$params = array(
    			'itemPerPage' => 10,
    			'pageRange' => 20
    	);
        $params['order'] = 'a.id DESC';
        $clientes = $this->paginator('PBVentasBundle:Cliente', $params);
        
        return $this->render('PBVentasBundle:Cliente:index.html.twig', array(
        	'clientes' => $clientes
        ));
    }

    /**
     * Finds and displays a Cliente entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('PBVentasBundle:Cliente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cliente entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PBVentasBundle:Cliente:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Cliente entity.
     *
     */
    public function newAction()
    {
        $entity = new Cliente();
        $form   = $this->createForm(new ClienteType(), $entity);

        
        return $this->render('PBVentasBundle:Cliente:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Cliente entity.
     *
     */
    public function createAction()
    {
        $entity  = new Cliente();
        $request = $this->getRequest();
        $form    = $this->createForm(new ClienteType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('cliente_show', array('id' => $entity->getId())));
            
        }

        return $this->render('PBVentasBundle:Cliente:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Cliente entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('PBVentasBundle:Cliente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cliente entity.');
        }

        $editForm = $this->createForm(new ClienteType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PBVentasBundle:Cliente:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Cliente entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('PBVentasBundle:Cliente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cliente entity.');
        }

        $editForm   = $this->createForm(new ClienteType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('cliente_edit', array('id' => $id)));
        }

        return $this->render('PBVentasBundle:Cliente:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Cliente entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('PBVentasBundle:Cliente')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Cliente entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('cliente'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    
    public function paginator($entity, $options = array()) {
    
    	$_default_options = array(
    			'itemPerPage' => 5,
    			'pageRange' => 5
    	);
    
    	$options = array_merge($_default_options, $options);
    	 
    	if ($entity instanceof \Doctrine\ORM\Query) {
    		$query = $entity;
    	} else {
    		//$entity = isset($options['entity']) ? $options['entity'] : $entity;
    
    		$dql = "SELECT a FROM " . $entity . " a";
    
    		if (isset($options['where']))
    			$dql .= ' WHERE ' . $options['where'];
    
    		if (isset($options['order']))
    			$dql .= ' ORDER BY ' . $options['order'];
    
    		$query = $this->getEm()->createQuery($dql);
    	}
    
    	$paginator = $this->get('knp_paginator');
    	$pagination = $paginator->paginate(
    			$query,
    			$this->get('request')->query->get('page', 1)/*page number*/,
    			$options['itemPerPage']/*limit per page*/
    	);
    	 
    	return $pagination;
    }
    public function getEm() {
    	return $this->get('doctrine')->getEntityManager();
    }
}
