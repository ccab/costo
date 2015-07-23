<?php

namespace Costo\OfertaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SitioType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nombre')
                //->add('materiales')
                /*->add('sitio_materiales', 'collection', array(
                    'type' => new SitioMaterialType(),
                    'allow_add' => TRUE,
                    'allow_delete' => TRUE,
                    'by_reference' => FALSE))*/;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Costo\OfertaBundle\Entity\Sitio'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'costo_ofertabundle_sitio';
    }

}
