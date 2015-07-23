<?php

namespace Costo\MaterialesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Costo\MaterialesBundle\Entity\material;
use Costo\MaterialesBundle\Form\materialType;

/**
 * material controller.
 *
 * @Route("/material")
 */
class materialController extends Controller
{

    /**
     * Lists all material entities.
     *
     * @Route("/", name="material")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MaterialesBundle:material')->findAll();

        return $this->render('MaterialesBundle:material:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    

    /**
     * Creates a new material entity.
     *
     * @Route("/adicionar", name="material_new")
     */
    public function newAction(Request $request)
    {
        $entity = new material();
        $form = $this->createForm(new materialType(), $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success','material creada(o)');
            
            return $this->redirect($this->generateUrl('material_show', array('id' => $entity->getId())));            
        }

        return $this->render('MaterialesBundle:material:new.html.twig', array(
            'form'   => $form->createView(),
        ));
    }


    /**
     * Finds and displays a material entity.
     *
     * @Route("/{id}", name="material_show")
     * @Method("GET")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MaterialesBundle:material')->find($id);

        if (!$entity) 
        {
            $this->get('session')->getFlashBag()->add('alert','No existe el(la) material');
            return $this->redirect($this->generateUrl('material'));
        }

        return $this->render('MaterialesBundle:material:show.html.twig', array(
            'entity'      => $entity
        ));
    }

    /**
     * Displays a form to edit an existing material entity.
     *
     * @Route("/modificar/{id}", name="material_edit")
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('MaterialesBundle:material')->find($id);

        if (!$entity) 
        {
            $this->get('session')->getFlashBag()->add('alert','No existe el(la) material');
            return $this->redirect($this->generateUrl('material'));
        }
        
        $form = $this->createForm(new materialType(), $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $em->flush();

            $this->get('session')->getFlashBag()->add('success','material modificada(o)');
            return $this->redirect($this->generateUrl('material'));

        }

        return $this->render('MaterialesBundle:material:edit.html.twig', array(
            'entity'      => $entity,
            'form'        => $form->createView(),
        ));
    }


    /**
     * Deletes a material entity.
     *
     * @Route("/eliminar/{id}", name="material_delete")
     * @Method("GET")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('MaterialesBundle:material')->find($id);

        if (!$entity) 
        {
            $this->get('session')->getFlashBag()->add('alert','No existe el(la) material');
            return $this->redirect($this->generateUrl('material'));
        }
        
        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add('success','material eliminada(o)');
        return $this->redirect($this->generateUrl('material'));
    }
  
    
}
