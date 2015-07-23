<?php

namespace Costo\ClienteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Costo\ClienteBundle\Entity\Cuenta;
use Costo\ClienteBundle\Form\CuentaType;

/**
 * Cuenta controller.
 *
 * @Route("/cuenta")
 */
class CuentaController extends Controller
{

    /**
     * Lists all Cuenta entities.
     *
     * @Route("/", name="cuenta")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ClienteBundle:Cuenta')->findAll();

        return $this->render('ClienteBundle:Cuenta:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    

    /**
     * Creates a new Cuenta entity.
     *
     * @Route("/adicionar", name="cuenta_new")
     */
    public function newAction(Request $request)
    {
        $entity = new Cuenta();
        $form = $this->createForm(new CuentaType(), $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success','Cuenta creada(o)');
            
            return $this->redirect($this->generateUrl('cuenta_show', array('id' => $entity->getId())));            
        }

        return $this->render('ClienteBundle:Cuenta:new.html.twig', array(
            'form'   => $form->createView(),
        ));
    }


    /**
     * Finds and displays a Cuenta entity.
     *
     * @Route("/{id}", name="cuenta_show")
     * @Method("GET")
     */
    public function showAction(Cuenta $entity)
    {
        return $this->render('ClienteBundle:Cuenta:show.html.twig', array(
            'entity'      => $entity
        ));
    }

    /**
     * Displays a form to edit an existing Cuenta entity.
     *
     * @Route("/modificar/{id}", name="cuenta_edit")
     */
    public function editAction(Request $request, Cuenta $entity)
    {
        $form = $this->createForm(new CuentaType(), $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->get('session')->getFlashBag()->add('success','Cuenta modificada(o)');
            return $this->redirect($this->generateUrl('cuenta'));
        }

        return $this->render('ClienteBundle:Cuenta:edit.html.twig', array(
            'entity'      => $entity,
            'form'        => $form->createView(),
        ));
    }


    /**
     * Deletes a Cuenta entity.
     *
     * @Route("/eliminar/{id}", name="cuenta_delete")
     * @Method("GET")
     */
    public function deleteAction(Cuenta $entity)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add('success','Cuenta eliminada(o)');
        return $this->redirect($this->generateUrl('cuenta'));
    }
  
    
}
