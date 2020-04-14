<?php

namespace App\Application\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * Class UniqueEmail
 * @package App\Application\Validator
 * @Annotation
 */
class UniqueEmail extends Constraint
{
    /**
     * @var string
     */
    public string $message = "This email already exists.";
}
