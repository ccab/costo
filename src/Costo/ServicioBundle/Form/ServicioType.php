<?php

namespace Costo\ServicioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ServicioType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('codigo')
            ->add('unidad')
            ->add('salario')
            ->add('precio_unit_cuc')
            ->add('precio_unit_cup')
            ->add('deprec_cuc')
            ->add('deprec_cup')
            ->add('alojamiento_cuc')
            ->add('alojamiento_cup')
            ->add('dieta_cuc')
            ->add('dieta_cup')
            ->add('mat_prim_cuc')
            ->add('mat_prim_cup')
            ->add('portadores_cuc')
            ->add('portadores_cup')
            ->add('arrend_cuc')
            ->add('arrend_cup')
            ->add('area')
            ->add('proceso')
            ->add('subcategoria')        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Costo\ServicioBundle\Entity\Servicio'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'costo_serviciobundle_servicio';
    }
}
