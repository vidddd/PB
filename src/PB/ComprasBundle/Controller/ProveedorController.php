<?php

namespace PB\ComprasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use PB\ComprasBundle\Entity\Proveedor;
use PB\ComprasBundle\Form\ProveedorType;

/**
 * Proveedor controller.
 *
 */
class ProveedorController extends Controller
{
    /**
     * Lists all Proveedor entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('PBComprasBundle:Proveedor')->findAll();

        return $this->render('PBComprasBundle:Proveedor:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Proveedor entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('PBComprasBundle:Proveedor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Proveedor entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PBComprasBundle:Proveedor:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Proveedor entity.
     *
     */
    public function newAction()
    {
        $entity = new Proveedor();
        $form   = $this->createForm(new ProveedorType(), $entity);
        
        return $this->render('PBComprasBundle:Proveedor:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Proveedor entity.
     *
     */
    public function createAction()
    {
        $entity  = new Proveedor();
        $request = $this->getRequest();
        $form    = $this->createForm(new ProveedorType(), $entity);
        $form->bindRequest($request);
/*
        $validator = $this->get('validator');
        $errors = $validator->validate($entity);
        
        if (count($errors) > 0) {
  
        	//return new Response(print_r($errors, true));
        } else {
        	//return new Response('The author is valid! Yes!');
        }
        */
        
        if ($form->isValid()) {
            
        	$em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('proveedor_show', array('id' => $entity->getId())));
            
        }

        return $this->render('PBComprasBundle:Proveedor:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Proveedor entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('PBComprasBundle:Proveedor')->find($id);
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Proveedor entity.');
        }

        $editForm = $this->createForm(new ProveedorType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PBComprasBundle:Proveedor:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Proveedor entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('PBComprasBundle:Proveedor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Proveedor entity.');
        }

        $editForm   = $this->createForm(new ProveedorType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('proveedor_edit', array('id' => $id)));
        }

        return $this->render('PBComprasBundle:Proveedor:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Proveedor entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('PBComprasBundle:Proveedor')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Proveedor entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('proveedor'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
