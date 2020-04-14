<?php

namespace App\Application\Validator;

use App\Application\Repository\UserRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class UniqueEmailValidator
 * @package App\Application\Validator
 */
class UniqueEmailValidator extends ConstraintValidator
{
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    /**
     * UniqueEmailValidator constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @inheritDoc
     */
    public function validate($value, Constraint $constraint)
    {
        if ($this->userRepository->count(["email" => $value]) > 0) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}
