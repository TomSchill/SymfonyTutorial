<?php namespace Opifer\BlogBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ContainsLettersValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if(!preg_match('/^[a-zA-Za ]+$/', $value, $matches))
        {
            $this->context->addViolation(
                'The string "%string%" can only contain letters.',
                array('%string%' => $value)
            );
        }
    }
} 