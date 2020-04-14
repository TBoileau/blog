<?php

namespace App\Domain\User\Presenter;

use App\Domain\User\Responder\RegistrationResponder;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

/**
 * Class RegistrationPresenter
 * @package App\Domain\User\Presenter
 */
class RegistrationPresenter implements RegistrationPresenterInterface
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
     * RegistrationPresenter constructor.
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
    public function redirect(): RedirectResponse
    {
        return new RedirectResponse($this->urlGenerator->generate("security_login"));
    }

    /**
     * @inheritDoc
     */
    public function present(RegistrationResponder $responder): Response
    {
        return new Response($this->twig->render("registration.html.twig", [
            'form' => $responder->getForm()
        ]));
    }
}