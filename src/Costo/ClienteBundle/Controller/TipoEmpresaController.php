<?php

namespace Costo\ClienteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Costo\ClienteBundle\Entity\TipoEmpresa;
use Costo\ClienteBundle\Form\TipoEmpresaType;

/**
 * TipoEmpresa controller.
 *
 * @Route("/empresa")
 */
class TipoEmpresaController extends Controller
{

    /**
     * Lists all TipoEmpresa entities.
     *
     * @Route("/", name="empresa")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ClienteBundle:TipoEmpresa')->findAll();

        return $this->render('ClienteBundle:TipoEmpresa:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    

    /**
     * Creates a new TipoEmpresa entity.
     *
     * @Route("/adicionar", name="empresa_new")
     */
    public function newAction(Request $request)
    {
        $entity = new TipoEmpresa();
        $form = $this->createForm(new TipoEmpresaType(), $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success','Empresa creada(o)');
            
            return $this->redirect($this->generateUrl('empresa_show', array('id' => $entity->getId())));            
        }

        return $this->render('ClienteBundle:TipoEmpresa:new.html.twig', array(
            'form'   => $form->createView(),
        ));
    }


    /**
     * Finds and displays a TipoEmpresa entity.
     *
     * @Route("/{id}", name="empresa_show")
     * @Method("GET")
     */
    public function showAction(TipoEmpresa $entity)
    {
        return $this->render('ClienteBundle:TipoEmpresa:show.html.twig', array(
            'entity'      => $entity
        ));
    }

    /**
     * Displays a form to edit an existing TipoEmpresa entity.
     *
     * @Route("/modificar/{id}", name="empresa_edit")
     */
    public function editAction(Request $request, TipoEmpresa $entity)
    {
        $form = $this->createForm(new TipoEmpresaType(), $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->get('session')->getFlashBag()->add('success','Empresa modificada(o)');
            return $this->redirect($this->generateUrl('empresa'));
        }

        return $this->render('ClienteBundle:TipoEmpresa:edit.html.twig', array(
            'entity'      => $entity,
            'form'        => $form->createView(),
        ));
    }


    /**
     * Deletes a TipoEmpresa entity.
     *
     * @Route("/eliminar/{id}", name="empresa_delete")
     * @Method("GET")
     */
    public function deleteAction(TipoEmpresa $entity)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add('success','Empresa eliminada(o)');
        return $this->redirect($this->generateUrl('empresa'));
    }
  
    
}
