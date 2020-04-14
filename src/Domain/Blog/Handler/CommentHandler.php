<?php

namespace App\Domain\Blog\Handler;

use App\Domain\Blog\DataTransferObject\Comment;
use App\Domain\Blog\Form\CommentType;
use App\Infrastructure\Handler\AbstractHandler;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class CommentHandler
 * @package App\Domain\Blog\Handler
 */
class CommentHandler extends AbstractHandler
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    /**
     * CommentHandler constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @inheritDoc
     */
    protected function getFormType(): string
    {
        return CommentType::class;
    }

    /**
     * @inheritDoc
     */
    protected function process($data): void
    {
        $this->entityManager->persist($data);
        $this->entityManager->flush();
    }

    /**
     * @inheritDoc
     */
    protected function getDataTransferObject(): object
    {
        return new Comment();
    }
}
