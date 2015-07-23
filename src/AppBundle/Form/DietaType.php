<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Costo\UsersBundle\Security\LDAPService;
use Doctrine\ORM\EntityManager;

class DietaType extends AbstractType {

    private $ldap;
    private $em;

    public function __construct(LDAPService $ldap, EntityManager $em) {
        $this->ldap = $ldap;
        $this->em = $em;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
                ->add('nombreBeneficiario')
                ->add('areaBeneficiario', NULL, array('required' => TRUE))
                ->add('concepto', 'choice', array(
                    'choices' => array(
                        'Ejecucion',
                        'Supervision',
                        'Survey Proyecto'
                    )
                ))
                /*->add('provincia', NULL, array(
                    'required' => TRUE,
                    'preferred_choices' => array(
                        $this->em->getRepository('AppBundle:Provincia')
                        ->findOneByNombre('La Habana')
                    )
                ))*/
                ->add('numeroSolicitud')
                ->add('laborRealizar')
                ->add('numeroTarjeta')
                ->add('contratoPago', NULL, array('required' => TRUE))
                ->add('contratoDietas', 'collection', array(
                    'type' => new ContratoDietaType(),
                    'allow_add' => TRUE,
                    'by_reference' => FALSE,
                    'label' => FALSE
                ))
        ;

        if ($options['accion'] == 'anticipo' || $options['accion'] == 'modificar') {
            $builder
                    ->add('fechaSalidaEstimada', NULL, array(
                        'widget' => 'single_text',
                        'html5' => FALSE,
                        'format' => 'dd/MM/yyyy'
                    ))
                    ->add('fechaRegresoEstimada', NULL, array(
                        'widget' => 'single_text',
                        'html5' => FALSE,
                        'format' => 'dd/MM/yyyy'
                    ))
                    ->add('importeEntregadoDesayunoCUP')
                    ->add('importeEntregadoDesayunoCUC')
                    ->add('importeEntregadoAlmuerzoCUP')
                    ->add('importeEntregadoAlmuerzoCUC')
                    ->add('importeEntregadoComidaCUP')
                    ->add('importeEntregadoComidaCUC')
                    ->add('importeEntregadoHospedajeCUP')
                    ->add('importeEntregadoHospedajeCUC')
                    ->add('importeEntregadoOtrosCUP')
                    ->add('importeEntregadoOtrosCUC')
                    ->add('formaPagoDietaCUP', NULL, array('required' => TRUE))
                    ->add('formaPagoDietaCUC', NULL, array('required' => TRUE))
                    ->add('formaPagoHospedajeCUP', NULL, array(
                        'required' => TRUE,
                        'preferred_choices' => array(
                            $this->em->getRepository('AppBundle:FormaPago')
                            ->findOneByNombre('Tarjeta ISLAZUL')
                        )
                    ))
                    ->add('formaPagoHospedajeCUC', NULL, array(
                        'required' => TRUE,
                        'preferred_choices' => array(
                            $this->em->getRepository('AppBundle:FormaPago')
                            ->findOneByNombre('Tarjeta ISLAZUL')
                        )
                    ))

            ;
        } if ($options['accion'] == 'liquidacion' || $options['accion'] == 'modificar') {
            $builder
                    ->add('fechaSalidaReal', NULL, array(
                        'widget' => 'single_text',
                        'html5' => FALSE,
                        'format' => 'dd/MM/yyyy'
                    ))
                    ->add('fechaRegresoReal', NULL, array(
                        'widget' => 'single_text',
                        'html5' => FALSE,
                        'format' => 'dd/MM/yyyy'
                    ))
                    ->add('importeUtilizadoDesayunoCUP')
                    ->add('importeUtilizadoDesayunoCUC')
                    ->add('importeUtilizadoAlmuerzoCUP')
                    ->add('importeUtilizadoAlmuerzoCUC')
                    ->add('importeUtilizadoComidaCUP')
                    ->add('importeUtilizadoComidaCUC')
                    ->add('importeUtilizadoHospedajeCUP')
                    ->add('importeUtilizadoHospedajeCUC')
                    ->add('importeUtilizadoOtrosCUP')
                    ->add('importeUtilizadoOtrosCUC')
            ;
            /* ->add('diasReal')
              ->add('fechaRegresoReal', NULL, array(
              'widget' => 'single_text',
              'html5' => FALSE,
              'format' => 'dd/MM/yyyy'))
              ->add('fechaLiquidado', NULL, array(
              'widget' => 'single_text',
              'html5' => FALSE,
              'format' => 'dd/MM/yyyy'))
              ->add('importeEntregado')
              ->add('importeDevuelto'); */
        } if ($options['accion'] == 'reembolsar' || $options['accion'] == 'modificar') {
            $builder
                    ->add('numeroReembolso');
        }
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions (OptionsResolver $resolver) {
        $resolver
                ->setDefaults(array(
                    'data_class' => 'AppBundle\Entity\Dieta',
                    'accion' => 'anticipo'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'appbundle_dieta';
    }

}
