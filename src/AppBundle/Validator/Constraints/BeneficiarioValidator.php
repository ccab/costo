<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Constraint;
use Doctrine\ORM\EntityManager;

/**
 * Constraint para impedir que un Beneficiario tenga 2 dietas pendientes
 * 
 * Basado en:
 *   Cookbook: How to create a custom Validation Constraint
 *   http://knpuniversity.com/screencast/question-answer-day/custom-validation-property-path
 *
 * @author Carlos Rafael
 */
class BeneficiarioValidator extends ConstraintValidator {
    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function validate($entity, Constraint $constraint) {
        $pendiente = $this->em
                ->getRepository('AppBundle:Dieta')
                ->isBeneficiarioPendiente($entity->getNombreBeneficiario(), $entity->getId());
        
        if (count($pendiente) > 0) {
            $this->context->buildViolation($constraint->message)
                    ->atPath('nombreBeneficiario')
                    ->addViolation();
        }
    }

}
