<?php

/**
 * Description of OfertaTypeSubscriber
 *
 * @author carlos
 */

namespace Costo\OfertaBundle\Form;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;

class OfertaTypeSubscriber implements EventSubscriberInterface {

    private $securityContext;
    private $request;
    private $em;
    private $options;

    public function __construct(SecurityContext $securityContext, Request $request, EntityManager $em, $options = array()) {
        $this->securityContext = $securityContext;
        $this->request = $request;
        $this->em = $em;
        $this->options = $options;
    }

    /*
     *  Tells the dispatcher that you want to listen on the form.pre_set_data
     *  event and that the preSetData method should be called.
     */

    public static function getSubscribedEvents() {
        return array(FormEvents::PRE_SET_DATA => 'preSetData');
    }

    public function preSetData(FormEvent $event) {
        $entity = $event->getData();
        $form = $event->getForm();
        //$session = $this->request->getSession();
        //$step = $session->get('step');
        $step = $this->options['step'];

        //grab the user, do a quick sanity check that one exists
        $user = $this->securityContext->getToken()->getUser();
        if (!$user) {
            throw new \LogicException('Usuario no autenticado!');
        }

        switch ($this->options['step']) {
            case 1:
                $form->add('ficha_cliente');
                break;
            case 2:
                $form->add('oferta_procesos', 'collection', array(
                    'label' => 'Procesos',
                    'type' => new OfertaProcesoType(),
                    'allow_add' => TRUE,
                    'allow_delete' => TRUE,
                    'by_reference' => FALSE
                ));
                break;
            case 3:
                $form->add('numero', null, array('read_only' => TRUE));
                $form->add('vigencia');
                $form->add('categorias', 'entity', array(
                    'class' => 'MaterialesBundle:subcategoria',
                    'multiple' => TRUE,
                    'group_by' => 'tipo'
                ));
                break;
            case 4:
                $form->add('sitios', 'collection', array(
                    'type' => new SitioType(),
                    'allow_add' => TRUE,
                    'allow_delete' => TRUE,
                    'by_reference' => FALSE
                ));
                break;
            case 5:
                $form->add('sitios', 'collection', array(
                    'type' => new SitioCollectionType(),
                    'allow_add' => TRUE,
                    'allow_delete' => TRUE,
                    'by_reference' => FALSE
                ));
                break;
            /*case 6:
                $form->add('oferta_material', 'collection', array(
                    'type' => new OfertaMaterialType(),
                    'allow_add' => TRUE,
                    'allow_delete' => TRUE,
                    'by_reference' => FALSE
                ));
                break;*/
        }
    }

}
