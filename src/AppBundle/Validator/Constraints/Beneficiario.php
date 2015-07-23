<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Constraint para impedir que un Beneficiario tenga 2 dietas pendientes
 * 
 * Basado en:
 *   Cookbook: How to create a custom Validation Constraint
 *   http://knpuniversity.com/screencast/question-answer-day/custom-validation-property-path
 *
 * @author Carlos Rafael
 * 
 * @Annotation
 */
class Beneficiario extends Constraint { 
    public $message = "Este beneficiario tiene registrada una Dieta pendiente";

    public function validatedBy() {
        return 'beneficiario_no_pendiente';
    }
    
    public function getTargets() {
        return self::CLASS_CONSTRAINT;
    }
}
