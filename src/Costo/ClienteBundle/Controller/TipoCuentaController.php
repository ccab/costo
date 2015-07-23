<?php

namespace Costo\ClienteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Costo\ClienteBundle\Entity\TipoCuenta;
use Costo\ClienteBundle\Form\TipoCuentaType;

/**
 * TipoCuenta controller.
 *
 */
class TipoCuentaController extends Controller
{

    /**
     * Lists all TipoCuenta entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ClienteBundle:TipoCuenta')->findAll();

        return $this->render('ClienteBundle:TipoCuenta:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new TipoCuenta entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new TipoCuenta();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tipocuenta_show', array('id' => $entity->getId())));
        }

        return $this->render('ClienteBundle:TipoCuenta:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a TipoCuenta entity.
    *
    * @param TipoCuenta $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(TipoCuenta $entity)
    {
        $form = $this->createForm(new TipoCuentaType(), $entity, array(
            'action' => $this->generateUrl('tipocuenta_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new TipoCuenta entity.
     *
     */
    public function newAction()
    {
        $entity = new TipoCuenta();
        $form   = $this->createCreateForm($entity);

        return $this->render('ClienteBundle:TipoCuenta:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TipoCuenta entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ClienteBundle:TipoCuenta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoCuenta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ClienteBundle:TipoCuenta:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing TipoCuenta entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ClienteBundle:TipoCuenta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoCuenta entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ClienteBundle:TipoCuenta:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a TipoCuenta entity.
    *
    * @param TipoCuenta $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TipoCuenta $entity)
    {
        $form = $this->createForm(new TipoCuentaType(), $entity, array(
            'action' => $this->generateUrl('tipocuenta_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing TipoCuenta entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ClienteBundle:TipoCuenta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoCuenta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('tipocuenta_edit', array('id' => $id)));
        }

        return $this->render('ClienteBundle:TipoCuenta:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a TipoCuenta entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ClienteBundle:TipoCuenta')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TipoCuenta entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tipocuenta'));
    }

    /**
     * Creates a form to delete a TipoCuenta entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tipocuenta_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
