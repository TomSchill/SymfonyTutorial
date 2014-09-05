<?php namespace Opifer\BlogBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;


/**
 * @Annotaion
 */
class ContainsLetters extends Constraint
{
    public $messege = 'The string "%string%" can only contain letters.';
} 