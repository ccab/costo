<?php

namespace Costo\ClienteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\SecurityContext;

class AutorizadoType extends AbstractType {

    private $securityContext;

    public function __construct(SecurityContext $securityContext) {
        $this->securityContext = $securityContext;
    }
    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        //grab the user, do a quick sanity check that one exists
        $user = $this->securityContext->getToken()->getUser();
        if (!$user) {
            throw new \LogicException('Usuario no autenticado!');
        }
        
        
        $builder
                ->add('nombre')
                ->add('ci', NULL, array('label' => 'CI'))
                ->add('observacion')
                ->add('area', NULL, array(
                    'preferred_choices' => array($user->getArea()),
                    'required' => TRUE))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Costo\ClienteBundle\Entity\Autorizado'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'autorizado_form';
    }

}
