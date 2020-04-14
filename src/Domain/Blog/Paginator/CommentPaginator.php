<?php

namespace App\Domain\Blog\Paginator;

use App\Application\Repository\CommentRepository;
use App\Infrastructure\Representation\AbstractPaginator;
use App\Infrastructure\Representation\RepresentationBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class CommentPaginator
 * @package App\Domain\Blog\Paginator
 */
class CommentPaginator extends AbstractPaginator
{
    /**
     * @var CommentRepository
     */
    private CommentRepository $commentRepository;

    /**
     * CommentPaginator constructor.
     * @param CommentRepository $commentRepository
     */
    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    /**
     * @inheritDoc
     */
    public function build(RepresentationBuilderInterface $builder, array $options): void
    {
        $builder->setQueryBuilder($this->commentRepository->getPaginatedComments($options["post"]));
    }

    /**
     * @inheritDoc
     */
    public function configure(OptionsResolver $resolver): void
    {
        $resolver->setRequired("post");
        $resolver->setDefault("route", "blog_read");
        $resolver->setDefault("route_params", []);
        $resolver->setDefault("field", "c.postedAt");
        $resolver->setDefault("order", "desc");
    }
}
