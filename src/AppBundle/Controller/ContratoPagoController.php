<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\ContratoPago;
use AppBundle\Form\ContratoPagoType;

/**
 * ContratoPago controller.
 *
 * @Route("/contratopago")
 */
class ContratoPagoController extends Controller
{

    /**
     * Lists all ContratoPago entities.
     *
     * @Route("/", name="contratopago")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:ContratoPago')->findAll();

        return $this->render('AppBundle:ContratoPago:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    

    /**
     * Creates a new ContratoPago entity.
     *
     * @Route("/adicionar", name="contratopago_new")
     */
    public function newAction(Request $request)
    {
        $entity = new ContratoPago();
        $form = $this->createForm(new ContratoPagoType(), $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success','ContratoPago creada(o)');
            
            return $this->redirect($this->generateUrl('contratopago_show', array('id' => $entity->getId())));            
        }

        return $this->render('AppBundle:ContratoPago:new.html.twig', array(
            'form'   => $form->createView(),
        ));
    }


    /**
     * Finds and displays a ContratoPago entity.
     *
     * @Route("/{id}", name="contratopago_show", options={"expose"=true})
     * @Method("GET")
     */
    public function showAction(ContratoPago $entity)
    {
        return $this->render('AppBundle:ContratoPago:show.html.twig', array(
            'entity'      => $entity
        ));
    }

    /**
     * Displays a form to edit an existing ContratoPago entity.
     *
     * @Route("/modificar/{id}", name="contratopago_edit")
     */
    public function editAction(Request $request, ContratoPago $entity)
    {
        $form = $this->createForm(new ContratoPagoType(), $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->get('session')->getFlashBag()->add('success','ContratoPago modificada(o)');
            return $this->redirect($this->generateUrl('contratopago'));
        }

        return $this->render('AppBundle:ContratoPago:edit.html.twig', array(
            'entity'      => $entity,
            'form'        => $form->createView(),
        ));
    }


    /**
     * Deletes a ContratoPago entity.
     *
     * @Route("/eliminar/{id}", name="contratopago_delete")
     * @Method("GET")
     */
    public function deleteAction(ContratoPago $entity)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add('success','ContratoPago eliminada(o)');
        return $this->redirect($this->generateUrl('contratopago'));
    }
  
    
}
