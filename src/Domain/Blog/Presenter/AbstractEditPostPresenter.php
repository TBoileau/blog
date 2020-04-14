<?php

namespace App\Domain\Blog\Presenter;

use App\Domain\Blog\Responder\AbstractEditPostResponder;
use App\Domain\Blog\Responder\AbstractRedirectPostResponder;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

/**
 * Class AbstractEditPostPresenter
 * @package App\Domain\Blog\Presenter
 */
abstract class AbstractEditPostPresenter implements EditPostPresenterInterface
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
     * @return string
     */
    abstract protected function getView(): string;

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
    public function redirect(AbstractRedirectPostResponder $responder): RedirectResponse
    {
        return new RedirectResponse($this->urlGenerator->generate(
            "blog_read",
            ["id" => $responder->getPost()->getId()]
        ));
    }

    /**
     * @inheritDoc
     */
    public function present(AbstractEditPostResponder $responder): Response
    {
        return new Response($this->twig->render($this->getView(), [
            "form" => $responder->getForm()
        ]));
    }
}
