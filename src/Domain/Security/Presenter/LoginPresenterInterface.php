<?php

namespace App\Domain\Security\Presenter;

use App\Domain\Security\Responder\LoginResponder;
use Symfony\Component\HttpFoundation\Response;

/**
 * Interface LoginPresenterInterface
 * @package App\Domain\Security\Presenter
 */
interface LoginPresenterInterface
{
    /**
     * @param LoginResponder $responder
     * @return Response
     */
    public function present(LoginResponder $responder): Response;
}
