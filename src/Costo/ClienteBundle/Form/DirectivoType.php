<?php

namespace Costo\ClienteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DirectivoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('telefono')
            ->add('tipo', 'choice', array('choices' => array("Director o Gerente General" => "Director o Gerente General", "Director o Genrente Económico" => "Director o Genrente Económico")))
            ->add('email')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Costo\ClienteBundle\Entity\Directivo'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'costo_clientebundle_directivo';
    }
}
