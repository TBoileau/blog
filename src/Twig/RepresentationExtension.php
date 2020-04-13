<?php

namespace App\Twig;

use App\Representation\RepresentationInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * Class RepresentationExtension
 * @package App\Twig
 */
class RepresentationExtension extends AbstractExtension
{
    /**
     * @var UrlGeneratorInterface
     */
    private UrlGeneratorInterface $urlGenerator;

    /**
     * RepresentationExtension constructor.
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    public function getFilters()
    {
        return [
            new TwigFilter('path', [$this, 'path'])
        ];
    }

    /**
     * @param RepresentationInterface $representation
     * @param int|null $page
     * @param int|null $limit
     * @param string|null $field
     * @param string|null $order
     * @return string
     */
    public function path(
        RepresentationInterface $representation,
        ?int $page = null,
        ?int $limit = null,
        ?string $field = null,
        ?string $order = null
    ): string {
        return $this->urlGenerator->generate($representation->getRoute(), array_merge(
            $representation->getRouteParams(),
            [
            "page" => $page ?? $representation->getPage(),
            "limit" => $limit ?? $representation->getLimit(),
            "field" => $field ?? $representation->getField(),
            "order" => $order ?? $representation->getOrder()
            ]
        ));
    }

}
