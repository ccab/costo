<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Costo\UsersBundle\Security\LDAPService;

class DietaSearchType extends AbstractType {

    private $ldap;

    public function __construct(LDAPService $ldap) {
        $this->ldap = $ldap;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('numero', NULL, array('required' => FALSE))
                ->add('numeroReembolso', NULL, array('required' => FALSE))
                ->add('fechaPago', 'date', array(
                    'widget' => 'single_text',
                    'html5' => FALSE,
                    'format' => 'dd/MM/yyyy',
                    'required' => FALSE,))
                ->add('fechaSalidaRango', 'text')
                ->add('fechaSalida', 'date', array(
                    'widget' => 'single_text',
                    'html5' => FALSE,
                    'format' => 'dd/MM/yyyy',
                    'required' => FALSE,))
                ->add('fechaRegresoReal', 'date', array(
                    'widget' => 'single_text',
                    'html5' => FALSE,
                    'format' => 'dd/MM/yyyy',
                    'required' => FALSE,
                    'data' => NULL))
                ->add('fechaLiquidado', 'date', array(
                    'widget' => 'single_text',
                    'html5' => FALSE,
                    'format' => 'dd/MM/yyyy',
                    'required' => FALSE,))
                ->add('areaBeneficiario', 'entity', array(
                    'class' => 'CostoUsersBundle:Area',
                    'required' => FALSE))
                ->add('nombreBeneficiario', 'choice', array(
                    'choices' => $this->ldap->findAll(),
                    'required' => FALSE));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'appbundle_dieta_search';
    }

}
