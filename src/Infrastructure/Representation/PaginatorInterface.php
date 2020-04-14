<?php

namespace App\Infrastructure\Representation;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Interface PaginatorInterface
 * @package App\Infrastructure\Representation
 */
interface PaginatorInterface
{
    /**
     * @param RepresentationBuilderInterface $builder
     * @param array $options
     */
    public function build(RepresentationBuilderInterface $builder, array $options): void;

    /**
     * @param OptionsResolver $resolver
     */
    public function configure(OptionsResolver $resolver): void;
}
