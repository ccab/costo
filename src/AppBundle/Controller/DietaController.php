<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Dieta;

/**
 * Dieta controller.
 *
 * @Route("/dieta")
 */
class DietaController extends Controller
{

    /**
     * Lists all Dieta entities.
     *
     * @Route("/", name="dieta")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AppBundle:Dieta')->findAll();

        $form = $this->createForm('appbundle_dieta_search');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entities = $this->getDoctrine()->getRepository('AppBundle:Dieta')->findBySearch($form->getData());
            $this->get('session')->getFlashBag()->add('info', 'Resultados de la busqueda');
        }

        return $this->render(
            'dieta/index.html.twig',
            array(
                'entities' => $entities,
                'form' => $form->createView()
            )
        );
    }

    /**
     * Creates a new Dieta entity.
     *
     * @Route("/solicitar/anticipo", name="solicitar_anticipo")
     */
    public function anticipoAction(Request $request)
    {
        $entity = new Dieta();
        $form = $this->createForm('appbundle_dieta', $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $entity->setEstado('Pendiente Aprobacion');
            if ($this->getDoctrine()
                ->getRepository('AppBundle:Dieta')
                ->isBeneficiarioPendiente(
                    $entity->getNombreBeneficiario(),
                    $entity->getId()
                )
            ) {
                $entity->setEstado('temporal');
            }
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Dieta creada(o)');

            return $this->redirect($this->generateUrl('dieta'));
        }

        return $this->render(
            'dieta/anticipo.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Creates a new Dieta entity.
     *
     * @Route("/duplicar/anticipo/{id}", name="duplicar_anticipo")
     */
    public function duplicarAnticipoAction(Request $request, Dieta $entity)
    {
        $entityDuplicate = clone $entity;
        dump($entityDuplicate);
        $form = $this->createForm('appbundle_dieta', $entityDuplicate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            if ($this->getDoctrine()
                ->getRepository('AppBundle:Dieta')
                ->isBeneficiarioPendiente(
                    $entityDuplicate->getNombreBeneficiario()
                )
            ) {
                $entityDuplicate->setEstado('temporal');
            }

            $em->persist($entityDuplicate);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Dieta creada(o)');

            return $this->redirect($this->generateUrl('dieta'));
        }

        return $this->render(
            'dieta/anticipo.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Creates a new Dieta entity.
     *
     * @Route("/imprimir/anticipo/{id}", name="imprimir_anticipo")
     */
    public function imprimirAnticipoAction(Request $request, Dieta $entity)
    {
        return $this->render(
            'dieta/imprimir.html.twig',
            array(
                'entity' => $entity,
            )
        );
    }

    /**
     * Creates a new Dieta entity.
     *
     * @Route("/solicitar/liquidacion", name="dieta_liquidacion")
     */
    public function liquidacionAction(Request $request)
    {
        $entity = new Dieta();
        $form = $this->createForm('appbundle_dieta', $entity, array('accion' => 'liquidacion'));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $entity->setEstado('Pendiente Liquidacion');
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Dieta creada(o)');

            return $this->redirect($this->generateUrl('dieta'));
        }

        return $this->render(
            'dieta/liquidacion.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Creates a new Dieta entity.
     *
     * @Route("/liquidar/{id}", name="dieta_liquidar", defaults={"id" = 0})
     */
    public function liquidarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $id == 0 ? new Dieta() : $em->getRepository('AppBundle:Dieta')->find($id);
        $accion = $id == 0 ? 'liquidar_directo' : 'liquidar';
        $template = $id == 0 ? 'dieta/liquidar_directo.html.twig' : 'dieta/liquidar.html.twig';

        $form = $this->createForm('appbundle_dieta', $entity, array('accion' => $accion));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $find = $em->getRepository('AppBundle:Dieta')->findBy(
                array(
                    'nombreBeneficiario' => $entity->getNombreBeneficiario(),
                    'estado' => 'Liquidar'
                )
            );

            if ($find) {
                $this->get('session')->getFlashBag()->add('alert', 'El beneficiario tiene una solicitud pendiente');

                return $this->redirect($this->generateUrl('dieta'));
            }

            $entity->setEstado('Reembolsar');
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Dieta liquidada(o)');

            return $this->redirect($this->generateUrl('dieta', array('id' => $entity->getId())));
        }

        return $this->render(
            $template,
            array(
                'form' => $form->createView(),
                'entity' => $entity
            )
        );
    }

    /**
     * Creates a new Dieta entity.
     *
     * @Route("/reembolsar/{id}", name="dieta_reembolsar")
     */
    public function reembolsarAction(Request $request, Dieta $entity)
    {
        $form = $this->createForm('appbundle_dieta', $entity, array('accion' => 'reembolsar'));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entity->setEstado('Completado');
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Dieta reembolsada(o)');

            return $this->redirect($this->generateUrl('dieta', array('id' => $entity->getId())));
        }

        return $this->render(
            'dieta/reembolsar.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }

    /**
     * @Route("/getAllUsers", name="all_users")
     * @Method("GET")
     */
    public function getAllUsersAction()
    {
        $all = $this->get('ldap_service')->findAll();
        $wk = array();
        foreach ($all as $value) {
            $wk[] = array('name' => $value);
        }

        return new \Symfony\Component\HttpFoundation\JsonResponse($wk);
    }

    /**
     * Finds and displays a Dieta entity.
     *
     * @Route("/{id}", name="dieta_show")
     * @Method("GET")
     */
    public function showAction(Dieta $entity)
    {
        return $this->render(
            'dieta/show.html.twig',
            array(
                'entity' => $entity
            )
        );
    }

    /**
     * Displays a form to edit an existing Dieta entity.
     *
     * @Route("/modificar/{id}", name="dieta_edit")
     */
    public function editAction(Request $request, Dieta $entity)
    {
        $form = $this->createForm('appbundle_dieta', $entity, array('accion' => 'modificar'));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Dieta modificada(o)');

            return $this->redirect($this->generateUrl('dieta'));
        }

        return $this->render(
            'dieta/edit.html.twig',
            array(
                'entity' => $entity,
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Deletes a Dieta entity.
     *
     * @Route("/eliminar/{id}", name="dieta_delete")
     * @Method("GET")
     */
    public function deleteAction(Dieta $entity)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add('success', 'Dieta eliminada(o)');

        return $this->redirect($this->generateUrl('dieta'));
    }

}
