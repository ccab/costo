<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\ContratoDieta;
use AppBundle\Form\ContratoDietaType;

/**
 * ContratoDieta controller.
 *
 * @Route("/contratodieta")
 */
class ContratoDietaController extends Controller
{

    /**
     * Lists all ContratoDieta entities.
     *
     * @Route("/", name="contratodieta")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:ContratoDieta')->findAll();

        return $this->render('AppBundle:ContratoDieta:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    

    /**
     * Creates a new ContratoDieta entity.
     *
     * @Route("/adicionar", name="contratodieta_new")
     */
    public function newAction(Request $request)
    {
        $entity = new ContratoDieta();
        $form = $this->createForm(new ContratoDietaType(), $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success','ContratoDieta creada(o)');
            
            return $this->redirect($this->generateUrl('contratodieta_show', array('id' => $entity->getId())));            
        }

        return $this->render('AppBundle:ContratoDieta:new.html.twig', array(
            'form'   => $form->createView(),
        ));
    }


    /**
     * Finds and displays a ContratoDieta entity.
     *
     * @Route("/{id}", name="contratodieta_show")
     * @Method("GET")
     */
    public function showAction(ContratoDieta $entity)
    {
        return $this->render('AppBundle:ContratoDieta:show.html.twig', array(
            'entity'      => $entity
        ));
    }

    /**
     * Displays a form to edit an existing ContratoDieta entity.
     *
     * @Route("/modificar/{id}", name="contratodieta_edit")
     */
    public function editAction(Request $request, ContratoDieta $entity)
    {
        $form = $this->createForm(new ContratoDietaType(), $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->get('session')->getFlashBag()->add('success','ContratoDieta modificada(o)');
            return $this->redirect($this->generateUrl('contratodieta'));
        }

        return $this->render('AppBundle:ContratoDieta:edit.html.twig', array(
            'entity'      => $entity,
            'form'        => $form->createView(),
        ));
    }


    /**
     * Deletes a ContratoDieta entity.
     *
     * @Route("/eliminar/{id}", name="contratodieta_delete")
     * @Method("GET")
     */
    public function deleteAction(ContratoDieta $entity)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add('success','ContratoDieta eliminada(o)');
        return $this->redirect($this->generateUrl('contratodieta'));
    }
  
    
}
