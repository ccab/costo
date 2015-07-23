<?php

namespace Costo\MaterialesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Costo\MaterialesBundle\Entity\moneda;
use Costo\MaterialesBundle\Form\monedaType;

/**
 * moneda controller.
 *
 * @Route("/moneda")
 */
class monedaController extends Controller
{

    /**
     * Lists all moneda entities.
     *
     * @Route("/", name="moneda")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MaterialesBundle:moneda')->findAll();

        return $this->render('MaterialesBundle:moneda:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    

    /**
     * Creates a new moneda entity.
     *
     * @Route("/adicionar", name="moneda_new")
     */
    public function newAction(Request $request)
    {
        $entity = new moneda();
        $form = $this->createForm(new monedaType(), $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success','moneda creada(o)');
            
            return $this->redirect($this->generateUrl('moneda_show', array('id' => $entity->getId())));            
        }

        return $this->render('MaterialesBundle:moneda:new.html.twig', array(
            'form'   => $form->createView(),
        ));
    }


    /**
     * Finds and displays a moneda entity.
     *
     * @Route("/{id}", name="moneda_show")
     * @Method("GET")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MaterialesBundle:moneda')->find($id);

        if (!$entity) 
        {
            $this->get('session')->getFlashBag()->add('alert','No existe el(la) moneda');
            return $this->redirect($this->generateUrl('moneda'));
        }

        return $this->render('MaterialesBundle:moneda:show.html.twig', array(
            'entity'      => $entity
        ));
    }

    /**
     * Displays a form to edit an existing moneda entity.
     *
     * @Route("/modificar/{id}", name="moneda_edit")
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('MaterialesBundle:moneda')->find($id);

        if (!$entity) 
        {
            $this->get('session')->getFlashBag()->add('alert','No existe el(la) moneda');
            return $this->redirect($this->generateUrl('moneda'));
        }
        
        $form = $this->createForm(new monedaType(), $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $em->flush();

            $this->get('session')->getFlashBag()->add('success','moneda modificada(o)');
            return $this->redirect($this->generateUrl('moneda'));

        }

        return $this->render('MaterialesBundle:moneda:edit.html.twig', array(
            'entity'      => $entity,
            'form'        => $form->createView(),
        ));
    }


    /**
     * Deletes a moneda entity.
     *
     * @Route("/eliminar/{id}", name="moneda_delete")
     * @Method("GET")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('MaterialesBundle:moneda')->find($id);

        if (!$entity) 
        {
            $this->get('session')->getFlashBag()->add('alert','No existe el(la) moneda');
            return $this->redirect($this->generateUrl('moneda'));
        }
        
        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add('success','moneda eliminada(o)');
        return $this->redirect($this->generateUrl('moneda'));
    }
  
    
}
