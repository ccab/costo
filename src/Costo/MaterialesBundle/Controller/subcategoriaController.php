<?php

namespace Costo\MaterialesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Costo\MaterialesBundle\Entity\subcategoria;
use Costo\MaterialesBundle\Form\subcategoriaType;

/**
 * subcategoria controller.
 *
 * @Route("/categoria")
 */
class subcategoriaController extends Controller
{

    /**
     * Lists all subcategoria entities.
     *
     * @Route("/", name="categoria")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MaterialesBundle:subcategoria')->findAll();

        return $this->render('MaterialesBundle:subcategoria:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    

    /**
     * Creates a new subcategoria entity.
     *
     * @Route("/adicionar", name="categoria_new")
     */
    public function newAction(Request $request)
    {
        $entity = new subcategoria();
        $form = $this->createForm(new subcategoriaType(), $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success','subcategoria creada(o)');
            
            return $this->redirect($this->generateUrl('categoria_show', array('id' => $entity->getId())));            
        }

        return $this->render('MaterialesBundle:subcategoria:new.html.twig', array(
            'form'   => $form->createView(),
        ));
    }


    /**
     * Finds and displays a subcategoria entity.
     *
     * @Route("/{id}", name="categoria_show")
     * @Method("GET")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MaterialesBundle:subcategoria')->find($id);

        if (!$entity) 
        {
            $this->get('session')->getFlashBag()->add('alert','No existe el(la) subcategoria');
            return $this->redirect($this->generateUrl('categoria'));
        }

        return $this->render('MaterialesBundle:subcategoria:show.html.twig', array(
            'entity'      => $entity
        ));
    }

    /**
     * Displays a form to edit an existing subcategoria entity.
     *
     * @Route("/modificar/{id}", name="categoria_edit")
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('MaterialesBundle:subcategoria')->find($id);

        if (!$entity) 
        {
            $this->get('session')->getFlashBag()->add('alert','No existe el(la) subcategoria');
            return $this->redirect($this->generateUrl('categoria'));
        }
        
        $form = $this->createForm(new subcategoriaType(), $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $em->flush();

            $this->get('session')->getFlashBag()->add('success','subcategoria modificada(o)');
            return $this->redirect($this->generateUrl('categoria'));

        }

        return $this->render('MaterialesBundle:subcategoria:edit.html.twig', array(
            'entity'      => $entity,
            'form'        => $form->createView(),
        ));
    }


    /**
     * Deletes a subcategoria entity.
     *
     * @Route("/eliminar/{id}", name="categoria_delete")
     * @Method("GET")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('MaterialesBundle:subcategoria')->find($id);

        if (!$entity) 
        {
            $this->get('session')->getFlashBag()->add('alert','No existe el(la) subcategoria');
            return $this->redirect($this->generateUrl('categoria'));
        }
        
        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add('success','subcategoria eliminada(o)');
        return $this->redirect($this->generateUrl('categoria'));
    }
  
    
}
