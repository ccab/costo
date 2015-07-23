<?php

namespace Costo\ServicioBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Costo\ServicioBundle\Entity\Servicio;
use Costo\ServicioBundle\Form\ServicioType;

/**
 * Servicio controller.
 *
 * @Route("/servicio")
 */
class ServicioController extends Controller
{

    /**
     * Lists all Servicio entities.
     *
     * @Route("/", name="servicio")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CostoServicioBundle:Servicio')->findAll();

        return $this->render('CostoServicioBundle:Servicio:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    

    /**
     * Creates a new Servicio entity.
     *
     * @Route("/adicionar", name="servicio_new")
     */
    public function newAction(Request $request)
    {
        $entity = new Servicio();
        $form = $this->createForm(new ServicioType(), $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success','Servicio creada(o)');
            
            return $this->redirect($this->generateUrl('servicio_show', array('id' => $entity->getId())));            
        }

        return $this->render('CostoServicioBundle:Servicio:new.html.twig', array(
            'form'   => $form->createView(),
        ));
    }


    /**
     * Finds and displays a Servicio entity.
     *
     * @Route("/{id}", name="servicio_show")
     * @Method("GET")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CostoServicioBundle:Servicio')->find($id);

        if (!$entity) 
        {
            $this->get('session')->getFlashBag()->add('alert','No existe el(la) Servicio');
            return $this->redirect($this->generateUrl('servicio'));
        }

        return $this->render('CostoServicioBundle:Servicio:show.html.twig', array(
            'entity'      => $entity
        ));
    }

    /**
     * Displays a form to edit an existing Servicio entity.
     *
     * @Route("/modificar/{id}", name="servicio_edit")
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CostoServicioBundle:Servicio')->find($id);

        if (!$entity) 
        {
            $this->get('session')->getFlashBag()->add('alert','No existe el(la) Servicio');
            return $this->redirect($this->generateUrl('servicio'));
        }
        
        $form = $this->createForm(new ServicioType(), $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $em->flush();

            $this->get('session')->getFlashBag()->add('success','Servicio modificada(o)');
            return $this->redirect($this->generateUrl('servicio'));

        }

        return $this->render('CostoServicioBundle:Servicio:edit.html.twig', array(
            'entity'      => $entity,
            'form'        => $form->createView(),
        ));
    }


    /**
     * Deletes a Servicio entity.
     *
     * @Route("/eliminar/{id}", name="servicio_delete")
     * @Method("GET")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CostoServicioBundle:Servicio')->find($id);

        if (!$entity) 
        {
            $this->get('session')->getFlashBag()->add('alert','No existe el(la) Servicio');
            return $this->redirect($this->generateUrl('servicio'));
        }
        
        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add('success','Servicio eliminada(o)');
        return $this->redirect($this->generateUrl('servicio'));
    }
  
    
}
