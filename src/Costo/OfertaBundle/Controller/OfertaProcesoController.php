<?php

namespace Costo\OfertaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Costo\OfertaBundle\Entity\OfertaProceso;
use Costo\OfertaBundle\Form\OfertaProcesoType;

/**
 * OfertaProceso controller.
 *
 * @Route("/oferta_proceso")
 */
class OfertaProcesoController extends Controller
{

    /**
     * Lists all OfertaProceso entities.
     *
     * @Route("/", name="oferta_proceso")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CostoOfertaBundle:OfertaProceso')->findAll();

        return $this->render('CostoOfertaBundle:OfertaProceso:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    

    /**
     * Creates a new OfertaProceso entity.
     *
     * @Route("/adicionar", name="oferta_proceso_new")
     */
    public function newAction(Request $request)
    {
        $entity = new OfertaProceso();
        $form = $this->createForm(new OfertaProcesoType(), $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success','OfertaProceso creada(o)');
            
            return $this->redirect($this->generateUrl('oferta_proceso_show', array('id' => $entity->getId())));            
        }

        return $this->render('CostoOfertaBundle:OfertaProceso:new.html.twig', array(
            'form'   => $form->createView(),
        ));
    }


    /**
     * Finds and displays a OfertaProceso entity.
     *
     * @Route("/{id}", name="oferta_proceso_show")
     * @Method("GET")
     */
    public function showAction(OfertaProceso $entity)
    {
        return $this->render('CostoOfertaBundle:OfertaProceso:show.html.twig', array(
            'entity'      => $entity
        ));
    }

    /**
     * Displays a form to edit an existing OfertaProceso entity.
     *
     * @Route("/modificar/{id}", name="oferta_proceso_edit")
     */
    public function editAction(Request $request, OfertaProceso $entity)
    {
        $form = $this->createForm(new OfertaProcesoType(), $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->get('session')->getFlashBag()->add('success','OfertaProceso modificada(o)');
            return $this->redirect($this->generateUrl('oferta_proceso'));
        }

        return $this->render('CostoOfertaBundle:OfertaProceso:edit.html.twig', array(
            'entity'      => $entity,
            'form'        => $form->createView(),
        ));
    }


    /**
     * Deletes a OfertaProceso entity.
     *
     * @Route("/eliminar/{id}", name="oferta_proceso_delete")
     * @Method("GET")
     */
    public function deleteAction(OfertaProceso $entity)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add('success','OfertaProceso eliminada(o)');
        return $this->redirect($this->generateUrl('oferta_proceso'));
    }
  
    
}
