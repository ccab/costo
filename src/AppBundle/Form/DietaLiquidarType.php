<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DietaType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero')
            ->add('numeroReembolso')
            ->add('diasEstimado')
            ->add('diasReal')
            ->add('fechaPago')
            ->add('fechaSalida')
            ->add('fechaRegresoReal')
            ->add('fechaLiquidado')
            ->add('importeAnticipo')
            ->add('importeEntregado')
            ->add('importeDevuelto')
            ->add('observaciones')        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Dieta'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_dieta';
    }
}
