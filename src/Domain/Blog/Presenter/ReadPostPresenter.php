<?php

namespace App\Domain\Blog\Presenter;

use App\Domain\Blog\Responder\ReadPostResponder;
use App\Domain\Blog\Responder\RedirectReadPostResponder;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

/**
 * Class ReadPostPresenter
 * @package App\Domain\Blog\Presenter
 */
class ReadPostPresenter implements ReadPostPresenterInterface
{
    /**
     * @var Environment
     */
    private Environment $twig;

    /**
     * @var UrlGeneratorInterface
     */
    private UrlGeneratorInterface $urlGenerator;

    /**
     * ReadPostPresenter constructor.
     * @param Environment $twig
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(Environment $twig, UrlGeneratorInterface $urlGenerator)
    {
        $this->twig = $twig;
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @inheritDoc
     */
    public function redirect(RedirectReadPostResponder $responder): RedirectResponse
    {
        return new RedirectResponse($this->urlGenerator->generate(
            "blog_read",
            ["id" => $responder->getPost()->getId()]
        ));
    }

    /**
     * @inheritDoc
     */
    public function present(ReadPostResponder $responder): Response
    {
        return new Response($this->twig->render("blog/read.html.twig", [
            "post" => $responder->getPost(),
            "form" => $responder->getForm(),
            "representation" => $responder->getRepresentation()
        ]));
    }
}