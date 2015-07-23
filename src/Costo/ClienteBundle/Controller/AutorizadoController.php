<?php

namespace Costo\ClienteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Costo\ClienteBundle\Entity\Autorizado;
use Costo\ClienteBundle\Form\AutorizadoType;

/**
 * Autorizado controller.
 *
 * @Route("/autorizado")
 */
class AutorizadoController extends Controller
{

    /**
     * Lists all Autorizado entities.
     *
     * @Route("/", name="autorizado")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ClienteBundle:Autorizado')->findAll();

        return $this->render('ClienteBundle:Autorizado:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    

    /**
     * Creates a new Autorizado entity.
     *
     * @Route("/adicionar", name="autorizado_new")
     */
    public function newAction(Request $request)
    {
        $entity = new Autorizado();
        $form = $this->createForm('autorizado_form', $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success','Autorizado creada(o)');
            
            return $this->redirect($this->generateUrl('autorizado_show', array('id' => $entity->getId())));            
        }

        return $this->render('ClienteBundle:Autorizado:new.html.twig', array(
            'form'   => $form->createView(),
        ));
    }


    /**
     * Finds and displays a Autorizado entity.
     *
     * @Route("/{id}", name="autorizado_show")
     * @Method("GET")
     */
    public function showAction(Autorizado $entity)
    {
        return $this->render('ClienteBundle:Autorizado:show.html.twig', array(
            'entity'      => $entity
        ));
    }

    /**
     * Displays a form to edit an existing Autorizado entity.
     *
     * @Route("/modificar/{id}", name="autorizado_edit")
     */
    public function editAction(Request $request, Autorizado $entity)
    {
        $form = $this->createForm('autorizado_form', $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->get('session')->getFlashBag()->add('success','Autorizado modificada(o)');
            return $this->redirect($this->generateUrl('autorizado'));
        }

        return $this->render('ClienteBundle:Autorizado:edit.html.twig', array(
            'entity'      => $entity,
            'form'        => $form->createView(),
        ));
    }


    /**
     * Deletes a Autorizado entity.
     *
     * @Route("/eliminar/{id}", name="autorizado_delete")
     * @Method("GET")
     */
    public function deleteAction(Autorizado $entity)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add('success','Autorizado eliminada(o)');
        return $this->redirect($this->generateUrl('autorizado'));
    }
  
    
}
