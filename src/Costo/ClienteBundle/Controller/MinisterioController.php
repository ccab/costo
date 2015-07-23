<?php

namespace Costo\ClienteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Costo\ClienteBundle\Entity\Ministerio;
use Costo\ClienteBundle\Form\MinisterioType;

/**
 * Ministerio controller.
 *
 * @Route("/ministerio")
 */
class MinisterioController extends Controller
{

    /**
     * Lists all Ministerio entities.
     *
     * @Route("/", name="ministerio")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ClienteBundle:Ministerio')->findAll();

        return $this->render('ClienteBundle:Ministerio:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    

    /**
     * Creates a new Ministerio entity.
     *
     * @Route("/adicionar", name="ministerio_new")
     */
    public function newAction(Request $request)
    {
        $entity = new Ministerio();
        $form = $this->createForm(new MinisterioType(), $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success','Ministerio creada(o)');
            
            return $this->redirect($this->generateUrl('ministerio_show', array('id' => $entity->getId())));            
        }

        return $this->render('ClienteBundle:Ministerio:new.html.twig', array(
            'form'   => $form->createView(),
        ));
    }


    /**
     * Finds and displays a Ministerio entity.
     *
     * @Route("/{id}", name="ministerio_show")
     * @Method("GET")
     */
    public function showAction(Ministerio $entity)
    {
        return $this->render('ClienteBundle:Ministerio:show.html.twig', array(
            'entity'      => $entity
        ));
    }

    /**
     * Displays a form to edit an existing Ministerio entity.
     *
     * @Route("/modificar/{id}", name="ministerio_edit")
     */
    public function editAction(Request $request, Ministerio $entity)
    {
        $form = $this->createForm(new MinisterioType(), $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->get('session')->getFlashBag()->add('success','Ministerio modificada(o)');
            return $this->redirect($this->generateUrl('ministerio'));
        }

        return $this->render('ClienteBundle:Ministerio:edit.html.twig', array(
            'entity'      => $entity,
            'form'        => $form->createView(),
        ));
    }


    /**
     * Deletes a Ministerio entity.
     *
     * @Route("/eliminar/{id}", name="ministerio_delete")
     * @Method("GET")
     */
    public function deleteAction(Ministerio $entity)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add('success','Ministerio eliminada(o)');
        return $this->redirect($this->generateUrl('ministerio'));
    }
  
    
}
