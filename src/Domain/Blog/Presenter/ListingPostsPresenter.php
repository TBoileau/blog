<?php

namespace App\Domain\Blog\Presenter;

use App\Domain\Blog\Responder\ListingPostsResponder;
use App\Domain\Blog\Responder\ResponderInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

/**
 * Class ListingPostsPresenter
 * @package App\Domain\Blog\Presenter
 */
class ListingPostsPresenter implements ListingPostsPresenterInterface
{
    /**
     * @var Environment
     */
    private Environment $twig;

    /**
     * ListingPostsPresenter constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @inheritDoc
     */
    public function present(ListingPostsResponder $responder): Response
    {
        return new Response($this->twig->render("blog/index.html.twig", [
            "representation" => $responder->getRepresentation()
        ]));
    }
}
