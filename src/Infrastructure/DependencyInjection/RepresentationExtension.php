<?php

namespace App\Infrastructure\DependencyInjection;

use App\Infrastructure\Representation\PaginatorInterface;
use App\Infrastructure\Representation\RepresentationFactory;
use App\Infrastructure\Representation\RepresentationFactoryInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;

/**
 * Class RepresentationExtension
 * @package App\Infrastructure\DependencyInjection
 */
class RepresentationExtension extends Extension
{
    /**
     * @inheritDoc
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $container->addAliases([
            RepresentationFactory::class => RepresentationFactoryInterface::class
        ]);
        $container->registerForAutoconfiguration(PaginatorInterface::class)->addTag("app.paginator");
    }
}
