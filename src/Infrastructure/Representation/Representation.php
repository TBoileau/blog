<?php

namespace App\Infrastructure\Representation;

use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class Representation
 * @package App\Infrastructure\Representation
 */
class Representation implements RepresentationInterface
{
    /**
     * @var array
     */
    private array $data = [];

    /**
     * @var int
     */
    private int $position = 0;

    /**
     * @var int|null
     */
    private ?int $count = null;

    /**
     * @var null|QueryBuilder
     */
    private ?QueryBuilder $queryBuilder = null;

    /**
     * @var QueryBuilder
     */
    private QueryBuilder $countQueryBuilder;

    /**
     * @var Request
     */
    private Request $request;

    /**
     * @var int
     */
    private int $page = 1;

    /**
     * @var int
     */
    private int $limit = 10;

    /**
     * @var null|string
     */
    private string $field;

    /**
     * @var string
     */
    private string $order = "asc";

    /**
     * @var string
     */
    private string $route;

    /**
     * @var array
     */
    private array $routeParams = [];

    /**
     * @var PaginatorInterface
     */
    private PaginatorInterface $paginator;

    /**
     * @inheritDoc
     */
    public function paginate(array $options = []): RepresentationInterface
    {
        $resolver = new OptionsResolver();

        $resolver->setRequired(["field", "route"]);
        $resolver->setDefaults(["order" => "asc", "route_params" => []]);

        $this->paginator->configure($resolver);

        $options = $resolver->resolve($options);

        [
            "route_params" => $this->routeParams,
            "route" => $this->route,
            "field" => $this->field,
            "order" => $this->order
        ] = $options;

        $this->paginator->build($this, $options);

        $this->page = $this->request->get("page", 1);
        $this->limit = $this->request->get("limit", 10);
        $this->field = $this->request->get("field", $this->field);
        $this->order = $this->request->get("order", "asc");

        $this->countQueryBuilder = clone $this->queryBuilder;

        $this->data = $this->queryBuilder
            ->setFirstResult(($this->page - 1) * $this->limit)
            ->setMaxResults($this->limit)
            ->orderBy($this->field, $this->order)
            ->getQuery()
            ->getResult()
        ;

        return $this;
    }

    /**
     * @param PaginatorInterface $paginator
     * @return RepresentationInterface
     */
    public function setPaginator(PaginatorInterface $paginator): RepresentationInterface
    {
        $this->paginator = $paginator;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function handleRequest(Request $request): RepresentationInterface
    {
        $this->request = $request;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setQueryBuilder(QueryBuilder $queryBuilder): RepresentationInterface
    {
        $this->queryBuilder = $queryBuilder;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function count()
    {
        if ($this->count === null) {
            $this->count = $this->countQueryBuilder
                ->select(sprintf("COUNT(DISTINCT %s.id)", $this->countQueryBuilder->getRootAliases()[0]))
                ->getQuery()
                ->getSingleScalarResult()
            ;
        }
        return $this->count;
    }

    /**
     * @inheritDoc
     */
    public function getIterator()
    {
        return $this->data;
    }

    /**
     * @return string
     */
    public function getRoute(): string
    {
        return $this->route;
    }

    /**
     * @return array
     */
    public function getRouteParams(): array
    {
        return $this->routeParams;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @return string
     */
    public function getField(): string
    {
        return $this->field;
    }

    /**
     * @return string
     */
    public function getOrder(): string
    {
        return $this->order;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @return int
     */
    public function getPages(): int
    {
        return ceil($this->count() / $this->limit);
    }

    /**
     * @inheritDoc
     */
    public function getRange(): array
    {
        return range(
            max($this->page - 3, 1),
            min($this->page + 3, $this->getPages())
        );
    }

    /**
     * @inheritDoc
     */
    public function getFirstResult(): int
    {
        return ($this->page - 1) * $this->limit + 1;
    }

    /**
     * @inheritDoc
     */
    public function getLastResult(): int
    {
        return $this->getFirstResult() + count($this->data) - 1;
    }

    /**
     * @inheritDoc
     */
    public function current()
    {
        return $this->data[$this->position];
    }

    /**
     * @inheritDoc
     */
    public function next()
    {
        $this->position++;
    }

    /**
     * @inheritDoc
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * @inheritDoc
     */
    public function valid()
    {
        return isset($this->data[$this->position]);
    }

    /**
     * @inheritDoc
     */
    public function rewind()
    {
        $this->position = 0;
    }
}
