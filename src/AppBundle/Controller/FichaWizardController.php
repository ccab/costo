<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Costo\ClienteBundle\Entity\Ficha;
use Costo\ClienteBundle\Form\FichaType;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Ficha controller.
 *
 * @Route("/ficha")
 */
class FichaWizardController extends Controller {

    /**
     * Creates a new Ficha entity.
     *
     * @Route("/gestionar/entidad/{id}", name="ficha_entidad", defaults={"id"=0})
     */
    public function entidadAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $entity = $id == 0 ? new Ficha() : $em->getRepository('ClienteBundle:Ficha')->find($id);
        $form = $this->createForm('ficha_form', $entity, array(
            //'attr' => array('novalidate' => 'novalidate'),
            'validation_groups' => array('entidad')
            ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('ficha_cuentas', array('id' => $entity->getId())));
        }

        return $this->render('FichaWizard/entidad.html.twig', array(
                    'form' => $form->createView(),
                    'entity' => $entity
        ));
    }

    /**
     * Creates a new Ficha entity.
     *
     * @Route("/gestionar/cuentas/{id}", name="ficha_cuentas", defaults={"id"=0})
     */
    public function cuentasAction(Request $request, Ficha $entity) {
        $cuenta = new \Costo\ClienteBundle\Entity\Cuenta();
        $cuenta->setBanco('Banco');
        $entity->getCuentas()->add($cuenta);
        $form = $this->createForm('ficha_form', $entity, array('step' => 2));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $cuentasOriginales = $em->getRepository('ClienteBundle:Cuenta')->findCuentasDeFicha($entity->getId());
            
            // remove the relationship between the Cuenta & Ficha
            foreach ($cuentasOriginales as $cuenta) {
                if (false === $entity->getCuentas()->contains($cuenta)) {
                    $em->remove($cuenta);
                }
            }
            
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('ficha_contactos', array('id' => $entity->getId())));
        }

        return $this->render('FichaWizard/cuentas.html.twig', array(
                    'form' => $form->createView(),
                    'entity' => $entity
        ));
    }
    
    
    /**
     * Creates a new Ficha entity.
     *
     * @Route("/gestionar/contactos/{id}", name="ficha_contactos", defaults={"id"=0})
     */
    public function contactosAction(Request $request, Ficha $entity) {
        $form = $this->createForm('ficha_form', $entity, array(
            'step' => 3,
            //'attr' => array('novalidate' => 'novalidate'),
            'validation_groups' => array('contactos'),
            'cascade_validation' => TRUE,
            ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $contactosOriginales = $em->getRepository('ClienteBundle:Contacto')->findContactosDeFicha($entity->getId());
            
            foreach ($contactosOriginales as $contacto) {
                if (false === $entity->getContactos()->contains($contacto)) {
                    $em->remove($contacto);
                }
            }

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('ficha_autorizados', array('id' => $entity->getId())));
        }

        return $this->render('FichaWizard/contactos.html.twig', array(
                    'form' => $form->createView(),
                    'entity' => $entity
        ));
    }

    
    /**
     * Creates a new Ficha entity.
     *
     * @Route("/gestionar/autorizados/{id}", name="ficha_autorizados", defaults={"id"=0})
     */
    public function autorizadosAction(Request $request, Ficha $entity) {
        $form = $this->createForm('ficha_form', $entity, array('step' => 4));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $autorizadosOriginales = $em->getRepository('ClienteBundle:Autorizado')->findAutorizadosDeFicha($entity->getId());
            
            foreach ($autorizadosOriginales as $autorizado) {
                if (false === $entity->getAutorizados()->contains($autorizado)) {
                    $em->remove($autorizado);
                }
            }

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('ficha_directivos', array('id' => $entity->getId())));
        }

        return $this->render('FichaWizard/autorizados.html.twig', array(
                    'form' => $form->createView(),
                    'entity' => $entity
        ));
    }
    
    
    /**
     * Creates a new Ficha entity.
     *
     * @Route("/gestionar/directivos/{id}", name="ficha_directivos", defaults={"id"=0})
     */
    public function directivosAction(Request $request, Ficha $entity) {
        $form = $this->createForm('ficha_form', $entity, array(
            'step' => 5,
            //'attr' => array('novalidate' => 'novalidate'),
            'validation_groups' => array('directivos'),
            'cascade_validation' => TRUE,
            ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $directivosOriginales = $em->getRepository('ClienteBundle:Directivo')->findDirectivoDeFicha($entity->getId());
            
            foreach ($directivosOriginales as $directivos) {
                if (false === $entity->getDirectivos()->contains($directivos)) {
                    $em->remove($directivos);
                }
            }
            
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('ficha_elaboracion', array('id' => $entity->getId())));
        }

        return $this->render('FichaWizard/directivos.html.twig', array(
                    'form' => $form->createView(),
                    'entity' => $entity
        ));
    }
    
    /**
     * Creates a new Ficha entity.
     *
     * @Route("/gestionar/elaboracion/{id}", name="ficha_elaboracion", defaults={"id"=0})
     */
    public function elaboracionAction(Request $request, Ficha $entity) {
        //$entity->setNombreElabora($this->getUser()->getFullName());
        
        $form = $this->createForm('ficha_form', $entity, array(
            'step' => 6,
            'cascade_validation' => TRUE,
            ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('ficha_show', array('id' => $entity->getId())));
        }

        return $this->render('FichaWizard/elaboracion.html.twig', array(
                    'form' => $form->createView(),
                    'entity' => $entity
        ));
    }
}
