<?php

namespace Costo\MaterialesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class materialType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('codigo')
            ->add('unidad_medida')
            ->add('fabricante')
            ->add('descripcion')
            ->add('precio_10_porciento')
            ->add('cantidad_inventario')
            ->add('cantidad_compra')
            ->add('cantidad_contrato')
            ->add('cantidad_oferta')
            ->add('cantidad_disponible')
            ->add('subcategoria')        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Costo\MaterialesBundle\Entity\material'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'costo_materialesbundle_material';
    }
}
