<?php

namespace App\Application\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * Class UniquePseudo
 * @package App\Application\Validator
 * @Annotation
 */
class UniquePseudo extends Constraint
{
    /**
     * @var string
     */
    public string $message = "This pseudo already exists.";
}
