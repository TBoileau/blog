<?php

namespace App\DependencyInjection;

use App\Representation\PaginatorInterface;
use App\Representation\RepresentationFactory;
use App\Representation\RepresentationFactoryInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;

/**
 * Class RepresentationExtension
 * @package App\DependencyInjection
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
