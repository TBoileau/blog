<?php


namespace App\Domain\Blog\Presenter;

use App\Domain\Blog\Responder\AbstractEditPostResponder;
use App\Domain\Blog\Responder\AbstractRedirectPostResponder;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Interface EditPostPresenterInterface
 * @package App\Domain\Blog\Presenter
 */
interface EditPostPresenterInterface
{
    /**
     * @param AbstractRedirectPostResponder $responder
     * @return RedirectResponse
     */
    public function redirect(AbstractRedirectPostResponder $responder): RedirectResponse;

    /**
     * @param AbstractEditPostResponder $responder
     * @return Response
     */
    public function present(AbstractEditPostResponder $responder): Response;
}