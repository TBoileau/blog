<?php

namespace App\Domain\User\Handler;

use App\Domain\User\DataTransferObject\User;
use App\Domain\User\Form\UserType;
use App\Infrastructure\Handler\AbstractHandler;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class RegistrationHandler
 * @package App\Handler
 */
class RegistrationHandler extends AbstractHandler
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    /**
     * RegistrationHandler constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @inheritDoc
     */
    protected function getDataTransferObject(): object
    {
        return new User();
    }

    /**
     * @inheritDoc
     */
    protected function getFormType(): string
    {
        return UserType::class;
    }

    /**
     * @inheritDoc
     */
    protected function process($data): void
    {
        $this->entityManager->persist($data);
        $this->entityManager->flush();
    }
}
