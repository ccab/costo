<?php

namespace Costo\OfertaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Costo\OfertaBundle\Entity\Sitio;
use Costo\OfertaBundle\Form\SitioType;

/**
 * Sitio controller.
 *
 * @Route("/sitio")
 */
class SitioController extends Controller
{

    /**
     * Lists all Sitio entities.
     *
     * @Route("/", name="sitio")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CostoOfertaBundle:Sitio')->findAll();

        return $this->render('CostoOfertaBundle:Sitio:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    

    /**
     * Creates a new Sitio entity.
     *
     * @Route("/adicionar", name="sitio_new")
     */
    public function newAction(Request $request)
    {
        $entity = new Sitio();
        $form = $this->createForm(new SitioType(), $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success','Sitio creada(o)');
            
            return $this->redirect($this->generateUrl('sitio_show', array('id' => $entity->getId())));            
        }

        return $this->render('CostoOfertaBundle:Sitio:new.html.twig', array(
            'form'   => $form->createView(),
        ));
    }


    /**
     * Finds and displays a Sitio entity.
     *
     * @Route("/{id}", name="sitio_show")
     * @Method("GET")
     */
    public function showAction(Sitio $entity)
    {
        return $this->render('CostoOfertaBundle:Sitio:show.html.twig', array(
            'entity'      => $entity
        ));
    }

    /**
     * Displays a form to edit an existing Sitio entity.
     *
     * @Route("/modificar/{id}", name="sitio_edit")
     */
    public function editAction(Request $request, Sitio $entity)
    {
        $form = $this->createForm(new SitioType(), $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->get('session')->getFlashBag()->add('success','Sitio modificada(o)');
            return $this->redirect($this->generateUrl('sitio'));
        }

        return $this->render('CostoOfertaBundle:Sitio:edit.html.twig', array(
            'entity'      => $entity,
            'form'        => $form->createView(),
        ));
    }


    /**
     * Deletes a Sitio entity.
     *
     * @Route("/eliminar/{id}", name="sitio_delete")
     * @Method("GET")
     */
    public function deleteAction(Sitio $entity)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add('success','Sitio eliminada(o)');
        return $this->redirect($this->generateUrl('sitio'));
    }
  
    
}
