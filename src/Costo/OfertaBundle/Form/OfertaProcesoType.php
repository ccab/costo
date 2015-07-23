<?php

namespace Costo\OfertaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OfertaProcesoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('proceso', NULL, array('required' => TRUE))
            ->add('principal', NULL, array('required' => FALSE));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Costo\OfertaBundle\Entity\OfertaProceso'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'costo_ofertabundle_ofertaproceso';
    }
}
