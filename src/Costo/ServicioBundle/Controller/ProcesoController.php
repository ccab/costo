<?php

namespace Costo\ServicioBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Costo\ServicioBundle\Entity\Proceso;
use Costo\ServicioBundle\Form\ProcesoType;

/**
 * Proceso controller.
 *
 * @Route("/proceso")
 */
class ProcesoController extends Controller
{

    /**
     * Lists all Proceso entities.
     *
     * @Route("/", name="proceso")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CostoServicioBundle:Proceso')->findBy(array(), array('nombre' => 'ASC'));

        return $this->render('CostoServicioBundle:Proceso:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    

    /**
     * Creates a new Proceso entity.
     *
     * @Route("/adicionar", name="proceso_new")
     */
    public function newAction(Request $request)
    {
        $entity = new Proceso();
        $form = $this->createForm(new ProcesoType(), $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success','Proceso creada(o)');
            
            return $this->redirect($this->generateUrl('proceso_show', array('id' => $entity->getId())));            
        }

        return $this->render('CostoServicioBundle:Proceso:new.html.twig', array(
            'form'   => $form->createView(),
        ));
    }


    /**
     * Finds and displays a Proceso entity.
     *
     * @Route("/{id}", name="proceso_show")
     * @Method("GET")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CostoServicioBundle:Proceso')->find($id);

        if (!$entity) 
        {
            $this->get('session')->getFlashBag()->add('alert','No existe el(la) Proceso');
            return $this->redirect($this->generateUrl('proceso'));
        }

        return $this->render('CostoServicioBundle:Proceso:show.html.twig', array(
            'entity'      => $entity
        ));
    }

    /**
     * Displays a form to edit an existing Proceso entity.
     *
     * @Route("/modificar/{id}", name="proceso_edit")
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CostoServicioBundle:Proceso')->find($id);

        if (!$entity) 
        {
            $this->get('session')->getFlashBag()->add('alert','No existe el(la) Proceso');
            return $this->redirect($this->generateUrl('proceso'));
        }
        
        $form = $this->createForm(new ProcesoType(), $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $em->flush();

            $this->get('session')->getFlashBag()->add('success','Proceso modificada(o)');
            return $this->redirect($this->generateUrl('proceso'));

        }

        return $this->render('CostoServicioBundle:Proceso:edit.html.twig', array(
            'entity'      => $entity,
            'form'        => $form->createView(),
        ));
    }


    /**
     * Deletes a Proceso entity.
     *
     * @Route("/eliminar/{id}", name="proceso_delete")
     * @Method("GET")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CostoServicioBundle:Proceso')->find($id);

        if (!$entity) 
        {
            $this->get('session')->getFlashBag()->add('alert','No existe el(la) Proceso');
            return $this->redirect($this->generateUrl('proceso'));
        }
        
        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add('success','Proceso eliminada(o)');
        return $this->redirect($this->generateUrl('proceso'));
    }
  
    
}
