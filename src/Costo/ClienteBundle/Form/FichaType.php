<?php

namespace Costo\ClienteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\RequestStack;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

class FichaType extends AbstractType {

    private $securityContext;
    private $requestStack;
    private $em;
    private $user;

    public function __construct(SecurityContext $securityContext, RequestStack $requestStack, EntityManager $em) {
        $this->securityContext = $securityContext;
        $this->requestStack = $requestStack;
        $this->em = $em;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        //grab the user, do a quick sanity check that one exists
        $this->user = $this->securityContext->getToken()->getUser();
        if (!$this->user) {
            throw new \LogicException('Usuario no autenticado!');
        }

        switch ($options['step']) {
            case 1:
                $builder
                        ->add('nombre')
                        ->add('direccion')
                        ->add('reeup')
                        ->add('nit')
                        ->add('ministerio')
                        ->add('tipoempresa')
                        ->add('regComercial')
                        ->add('regMercantil')
                        ->add('licDivisas')
                ;
                break;
            case 2:
                $builder
                        ->add('cuentas', 'collection', array(
                            'label' => FALSE,
                            'type' => new CuentaType(),
                            'allow_add' => TRUE,
                            'allow_delete' => TRUE,
                            'by_reference' => FALSE));
                break;
            case 3:
                $builder
                        ->add('contactos', 'collection', array(
                            'label' => FALSE,
                            'type' => 'contacto_form',
                            'allow_add' => TRUE,
                            'allow_delete' => TRUE,
                            'by_reference' => FALSE));
                break;
            case 4:
                $builder
                        ->add('autorizados', 'collection', array(
                            'label' => FALSE,
                            'type' => 'autorizado_form',
                            'allow_add' => TRUE,
                            'allow_delete' => TRUE,
                            'by_reference' => FALSE));
                break;
            case 5:
                $builder
                        ->add('directivos', 'collection', array(
                            'label' => FALSE,
                            'type' => new DirectivoType(),
                            'allow_add' => TRUE,
                            'allow_delete' => TRUE,
                            'by_reference' => FALSE));
                break;
            case 6:
                $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                    $entity = $event->getData();
                    $form = $event->getForm();

                    $form->add('nombreElabora', NULL, array(
                        'data' => $entity->getNombreElabora() === null ? $this->user->getFullName() : $entity->getNombreElabora()
                    ));
                    $form->add('cargo');
                    $form->add('fechaElaboracion', NULL, array(
                        'format' => 'dd MM yyyy',
                        'data' => $entity->getFechaElaboracion() === null ? new \DateTime('today') : $entity->getFechaElaboracion()
                    ));
                });
                break;
        }
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Costo\ClienteBundle\Entity\Ficha',
            'step' => 1
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'ficha_form';
    }

}
