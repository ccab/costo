<?php

namespace Costo\OfertaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Costo\OfertaBundle\Form\OfertaTypeSubscriber;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\RequestStack;
use Doctrine\ORM\EntityManager;

class OfertaType extends AbstractType {

    private $securityContext;
    private $requestStack;
    private $em;
     
    public function __construct(SecurityContext $securityContext, RequestStack $requestStack, EntityManager $em)
    {
        $this->securityContext = $securityContext;
        $this->requestStack = $requestStack;
        $this->em = $em;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->addEventSubscriber(new OfertaTypeSubscriber(  $this->securityContext,
                                                                $this->requestStack->getCurrentRequest(), 
                                                                $this->em, 
                                                                $options)
                );
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Costo\OfertaBundle\Entity\Oferta',
            'step' => 1,
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'oferta_form';
    }

}
