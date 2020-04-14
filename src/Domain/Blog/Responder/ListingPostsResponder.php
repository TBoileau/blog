<?php

namespace App\Domain\Blog\Responder;

use App\Infrastructure\Representation\RepresentationInterface;

/**
 * Class ListingPostsResponder
 * @package App\Domain\Blog\Responder
 */
class ListingPostsResponder
{
    /**
     * @var RepresentationInterface
     */
    private RepresentationInterface $representation;

    /**
     * ListingPostsResponder constructor.
     * @param RepresentationInterface $representation
     */
    public function __construct(RepresentationInterface $representation)
    {
        $this->representation = $representation;
    }

    /**
     * @return RepresentationInterface
     */
    public function getRepresentation(): RepresentationInterface
    {
        return $this->representation;
    }
}
