<?php

namespace App\Domain\Blog\Presenter;

use App\Domain\Blog\Responder\ReadPostResponder;
use App\Domain\Blog\Responder\RedirectReadPostResponder;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Interface ReadPostPresenterInterface
 * @package App\Domain\Blog\Presenter
 */
interface ReadPostPresenterInterface
{
    /**
     * @param RedirectReadPostResponder $responder
     * @return RedirectResponse
     */
    public function redirect(RedirectReadPostResponder $responder): RedirectResponse;

    /**
     * @param ReadPostResponder $responder
     * @return Response
     */
    public function present(ReadPostResponder $responder): Response;
}
