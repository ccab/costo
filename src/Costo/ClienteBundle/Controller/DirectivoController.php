<?php

namespace Costo\ClienteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Costo\ClienteBundle\Entity\Directivo;
use Costo\ClienteBundle\Form\DirectivoType;

/**
 * Directivo controller.
 *
 * @Route("/directivo")
 */
class DirectivoController extends Controller
{

    /**
     * Lists all Directivo entities.
     *
     * @Route("/", name="directivo")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ClienteBundle:Directivo')->findAll();

        return $this->render('ClienteBundle:Directivo:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    

    /**
     * Creates a new Directivo entity.
     *
     * @Route("/adicionar", name="directivo_new")
     */
    public function newAction(Request $request)
    {
        $entity = new Directivo();
        $form = $this->createForm(new DirectivoType(), $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success','Directivo creada(o)');
            
            return $this->redirect($this->generateUrl('directivo_show', array('id' => $entity->getId())));            
        }

        return $this->render('ClienteBundle:Directivo:new.html.twig', array(
            'form'   => $form->createView(),
        ));
    }


    /**
     * Finds and displays a Directivo entity.
     *
     * @Route("/{id}", name="directivo_show")
     * @Method("GET")
     */
    public function showAction(Directivo $entity)
    {
        return $this->render('ClienteBundle:Directivo:show.html.twig', array(
            'entity'      => $entity
        ));
    }

    /**
     * Displays a form to edit an existing Directivo entity.
     *
     * @Route("/modificar/{id}", name="directivo_edit")
     */
    public function editAction(Request $request, Directivo $entity)
    {
        $form = $this->createForm(new DirectivoType(), $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->get('session')->getFlashBag()->add('success','Directivo modificada(o)');
            return $this->redirect($this->generateUrl('directivo'));
        }

        return $this->render('ClienteBundle:Directivo:edit.html.twig', array(
            'entity'      => $entity,
            'form'        => $form->createView(),
        ));
    }


    /**
     * Deletes a Directivo entity.
     *
     * @Route("/eliminar/{id}", name="directivo_delete")
     * @Method("GET")
     */
    public function deleteAction(Directivo $entity)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add('success','Directivo eliminada(o)');
        return $this->redirect($this->generateUrl('directivo'));
    }
  
    
}
