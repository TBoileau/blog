<?php

namespace App\Domain\Blog\Presenter;

use App\Domain\Blog\Responder\ListingPostsResponder;
use Symfony\Component\HttpFoundation\Response;

/**
 * Interface PresenterInterface
 * @package App\Domain\Blog\Presenter
 */
interface ListingPostsPresenterInterface
{
    /**
     * @param ListingPostsResponder $responder
     * @return Response
     */
    public function present(ListingPostsResponder $responder): Response;
}
