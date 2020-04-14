<?php

namespace App\Infrastructure\Representation;

use Countable;
use Doctrine\ORM\QueryBuilder;
use Iterator;
use Symfony\Component\HttpFoundation\Request;

/**
 * Interface RepresentationInterface
 * @package App\Infrastructure\Representation
 */
interface RepresentationInterface extends Countable, Iterator, RepresentationBuilderInterface
{
    /**
     * @param array $options
     * @return RepresentationInterface
     */
    public function paginate(array $options = []): RepresentationInterface;

    /**
     * @param Request $request
     * @return RepresentationInterface
     */
    public function handleRequest(Request $request): RepresentationInterface;

    /**
     * @param PaginatorInterface $paginator
     * @return RepresentationInterface
     */
    public function setPaginator(PaginatorInterface $paginator): RepresentationInterface;

    /**
     * @return string
     */
    public function getRoute(): string;

    /**
     * @return array
     */
    public function getRouteParams(): array;

    /**
     * @return string
     */
    public function getField(): string;

    /**
     * @return string
     */
    public function getOrder(): string;

    /**
     * @return int
     */
    public function getLimit(): int;

    /**
     * @return int
     */
    public function getPages(): int;

    /**
     * @return int
     */
    public function getPage(): int;

    /**
     * @return int[]
     */
    public function getRange(): array;

    /**
     * @return int
     */
    public function getFirstResult(): int;

    /**
     * @return int
     */
    public function getLastResult(): int;
}
