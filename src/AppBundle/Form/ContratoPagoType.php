<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContratoPagoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('impEntregadoDesayunoCUP')
            ->add('impEntregadoDesayunoCUC')
            ->add('impEntregadoAlmuerzoCUP')
            ->add('impEntregadoAlmuerzoCUC')
            ->add('impEntregadoComidaCUP')
            ->add('impEntregadoComidaCUC')        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\ContratoPago'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_contratopago';
    }
}
