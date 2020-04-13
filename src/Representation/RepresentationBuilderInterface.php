<?php

namespace App\Representation;

use Doctrine\ORM\QueryBuilder;

/**
 * Interface RepresentationBuilderInterface
 * @package App\Representation
 */
interface RepresentationBuilderInterface
{
    /**
     * @param QueryBuilder $queryBuilder
     * @return $this
     */
    public function setQueryBuilder(QueryBuilder $queryBuilder): self;
}
