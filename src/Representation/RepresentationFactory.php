<?php

namespace App\Representation;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ServiceLocator;

/**
 * Class RepresentationFactory
 * @package App\Representation
 */
class RepresentationFactory implements RepresentationFactoryInterface
{
    /**
     * @var ServiceLocator
     */
    private ServiceLocator $serviceLocator;

    /**
     * RepresentationFactory constructor.
     * @param ServiceLocator $serviceLocator
     */
    public function __construct(ServiceLocator $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * @inheritDoc
     */
    public function create(string $paginator): RepresentationInterface
    {
        $representation = $this->serviceLocator->get(RepresentationInterface::class);
        return $representation->setPaginator($this->serviceLocator->get($paginator));
    }
}
