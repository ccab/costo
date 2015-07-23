<?php

namespace Costo\OfertaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Costo\OfertaBundle\Entity\SitioMaterial;
use Costo\OfertaBundle\Form\SitioMaterialType;

/**
 * SitioMaterial controller.
 *
 * @Route("/sitio_material")
 */
class SitioMaterialController extends Controller
{

    /**
     * Lists all SitioMaterial entities.
     *
     * @Route("/", name="sitio_material")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CostoOfertaBundle:SitioMaterial')->findAll();

        return $this->render('CostoOfertaBundle:SitioMaterial:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    

    /**
     * Creates a new SitioMaterial entity.
     *
     * @Route("/adicionar", name="sitio_material_new")
     */
    public function newAction(Request $request)
    {
        $entity = new SitioMaterial();
        $form = $this->createForm(new SitioMaterialType(), $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success','SitioMaterial creada(o)');
            
            return $this->redirect($this->generateUrl('sitio_material_show', array('id' => $entity->getId())));            
        }

        return $this->render('CostoOfertaBundle:SitioMaterial:new.html.twig', array(
            'form'   => $form->createView(),
        ));
    }


    /**
     * Finds and displays a SitioMaterial entity.
     *
     * @Route("/{id}", name="sitio_material_show")
     * @Method("GET")
     */
    public function showAction(SitioMaterial $entity)
    {
        return $this->render('CostoOfertaBundle:SitioMaterial:show.html.twig', array(
            'entity'      => $entity
        ));
    }

    /**
     * Displays a form to edit an existing SitioMaterial entity.
     *
     * @Route("/modificar/{id}", name="sitio_material_edit")
     */
    public function editAction(Request $request, SitioMaterial $entity)
    {
        $form = $this->createForm(new SitioMaterialType(), $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->get('session')->getFlashBag()->add('success','SitioMaterial modificada(o)');
            return $this->redirect($this->generateUrl('sitio_material'));
        }

        return $this->render('CostoOfertaBundle:SitioMaterial:edit.html.twig', array(
            'entity'      => $entity,
            'form'        => $form->createView(),
        ));
    }


    /**
     * Deletes a SitioMaterial entity.
     *
     * @Route("/eliminar/{id}", name="sitio_material_delete")
     * @Method("GET")
     */
    public function deleteAction(SitioMaterial $entity)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add('success','SitioMaterial eliminada(o)');
        return $this->redirect($this->generateUrl('sitio_material'));
    }
  
    
}
