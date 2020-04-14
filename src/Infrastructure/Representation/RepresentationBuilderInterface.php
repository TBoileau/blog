<?php

namespace App\Infrastructure\Representation;

use Doctrine\ORM\QueryBuilder;

/**
 * Interface RepresentationBuilderInterface
 * @package App\Infrastructure\Representation
 */
interface RepresentationBuilderInterface
{
    /**
     * @param QueryBuilder $queryBuilder
     * @return $this
     */
    public function setQueryBuilder(QueryBuilder $queryBuilder): self;
}
