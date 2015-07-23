<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Costo\ClienteBundle\Entity\Ficha;

/**
 * Ficha controller.
 *
 * @Route("/ficha")
 */
class FichaController extends Controller
{

    /**
     * Lists all Ficha entities.
     *
     * @Route("/", name="ficha")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ClienteBundle:Ficha')->findAll();

        return $this->render('Ficha/index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Ficha entity.
     *
     * @Route("/{id}", name="ficha_show")
     * @Method("GET")
     */
    public function showAction(Ficha $entity)
    {
        return $this->render('Ficha/show.html.twig', array(
            'entity'      => $entity
        ));
    }


    /**
     * Deletes a Ficha entity.
     *
     * @Route("/eliminar/{id}", name="ficha_delete", defaults={"id"=0})
     * @Method("GET")
     */
    public function deleteAction(Ficha $entity)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add('success','Ficha eliminada(o)');
        return $this->redirect($this->generateUrl('ficha'));
    }
  
    
}
