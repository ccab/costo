<?php

namespace Costo\ClienteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Costo\ClienteBundle\Entity\Contacto;
use Costo\ClienteBundle\Form\ContactoType;

/**
 * Contacto controller.
 *
 * @Route("/contacto")
 */
class ContactoController extends Controller
{

    /**
     * Lists all Contacto entities.
     *
     * @Route("/", name="contacto")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ClienteBundle:Contacto')->findAll();

        return $this->render('ClienteBundle:Contacto:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    

    /**
     * Creates a new Contacto entity.
     *
     * @Route("/adicionar", name="contacto_new")
     */
    public function newAction(Request $request)
    {
        $entity = new Contacto();
        $form = $this->createForm('contacto_form', $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success','Contacto creada(o)');
            
            return $this->redirect($this->generateUrl('contacto_show', array('id' => $entity->getId())));            
        }

        return $this->render('ClienteBundle:Contacto:new.html.twig', array(
            'form'   => $form->createView(),
        ));
    }


    /**
     * Finds and displays a Contacto entity.
     *
     * @Route("/{id}", name="contacto_show")
     * @Method("GET")
     */
    public function showAction(Contacto $entity)
    {
        return $this->render('ClienteBundle:Contacto:show.html.twig', array(
            'entity'      => $entity
        ));
    }

    /**
     * Displays a form to edit an existing Contacto entity.
     *
     * @Route("/modificar/{id}", name="contacto_edit")
     */
    public function editAction(Request $request, Contacto $entity)
    {
        $form = $this->createForm('contacto_form', $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->get('session')->getFlashBag()->add('success','Contacto modificada(o)');
            return $this->redirect($this->generateUrl('contacto'));
        }

        return $this->render('ClienteBundle:Contacto:edit.html.twig', array(
            'entity'      => $entity,
            'form'        => $form->createView(),
        ));
    }


    /**
     * Deletes a Contacto entity.
     *
     * @Route("/eliminar/{id}", name="contacto_delete")
     * @Method("GET")
     */
    public function deleteAction(Contacto $entity)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add('success','Contacto eliminada(o)');
        return $this->redirect($this->generateUrl('contacto'));
    }
  
    
}
