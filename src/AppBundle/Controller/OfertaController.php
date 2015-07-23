<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Costo\OfertaBundle\Entity\Oferta;
use Costo\OfertaBundle\Form\OfertaType;

/**
 * Oferta controller.
 *
 * @Route("/oferta")
 */
class OfertaController extends Controller
{

    /**
     * Lists all Oferta entities.
     *
     * @Route("/", name="oferta")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CostoOfertaBundle:Oferta')->findAll();

        return $this->render('Oferta/index.html.twig', array(
            'entities' => $entities,
        ));
    }
    

    public function newAction(Request $request)
    {
        $entity = new Oferta();
        $form = $this->createForm(new OfertaType(), $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success','Oferta creada(o)');
            
            return $this->redirect($this->generateUrl('oferta_show', array('id' => $entity->getId())));            
        }

        return $this->render('CostoOfertaBundle:Oferta:new.html.twig', array(
            'form'   => $form->createView(),
        ));
    }


    /**
     * Finds and displays a Oferta entity.
     *
     * @Route("/{id}", name="oferta_show")
     * @Method("GET")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CostoOfertaBundle:Oferta')->find($id);

        if (!$entity) 
        {
            $this->get('session')->getFlashBag()->add('alert','No existe el(la) Oferta');
            return $this->redirect($this->generateUrl('oferta'));
        }

        return $this->render('Oferta/show.html.twig', array(
            'entity'      => $entity
        ));
    }

    /**
     * Displays a form to edit an existing Oferta entity.
     *
     * @Route("/modificar/{id}", name="oferta_edit")
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CostoOfertaBundle:Oferta')->find($id);

        if (!$entity) 
        {
            $this->get('session')->getFlashBag()->add('alert','No existe el(la) Oferta');
            return $this->redirect($this->generateUrl('oferta'));
        }
        
        $form = $this->createForm(new OfertaType(), $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $em->flush();

            $this->get('session')->getFlashBag()->add('success','Oferta modificada(o)');
            return $this->redirect($this->generateUrl('oferta'));

        }

        return $this->render('CostoOfertaBundle:Oferta:edit.html.twig', array(
            'entity'      => $entity,
            'form'        => $form->createView(),
        ));
    }


    /**
     * Deletes a Oferta entity.
     *
     * @Route("/eliminar/{id}", name="oferta_delete")
     * @Method("GET")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CostoOfertaBundle:Oferta')->find($id);

        if (!$entity) 
        {
            $this->get('session')->getFlashBag()->add('alert','No existe el(la) Oferta');
            return $this->redirect($this->generateUrl('oferta'));
        }
        
        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add('success','Oferta eliminada(o)');
        return $this->redirect($this->generateUrl('oferta'));
    }
  
    
}
