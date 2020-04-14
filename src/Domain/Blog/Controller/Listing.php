<?php

namespace App\Domain\Blog\Controller;

use App\Infrastructure\Representation\RepresentationFactoryInterface;
use App\Domain\Blog\Paginator\PostPaginator;
use App\Domain\Blog\Presenter\ListingPostsPresenterInterface;
use App\Domain\Blog\Responder\ListingPostsResponder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Listing
{
    /**
     * @param Request $request
     * @param RepresentationFactoryInterface $representationFactory
     * @param ListingPostsPresenterInterface $presenter
     * @return Response
     */
    public function __invoke(
        Request $request,
        RepresentationFactoryInterface $representationFactory,
        ListingPostsPresenterInterface $presenter
    ): Response {
        $representation = $representationFactory->create(PostPaginator::class)->handleRequest($request);

        return $presenter->present(new ListingPostsResponder($representation->paginate()));
    }
}