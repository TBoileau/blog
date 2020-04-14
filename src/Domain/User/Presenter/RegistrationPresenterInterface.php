<?php

namespace App\Domain\User\Presenter;

use App\Domain\User\Responder\RegistrationResponder;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Interface RegistrationPresenterInterface
 * @package App\Domain\User\Presenter
 */
interface RegistrationPresenterInterface
{
    /**
     * @return RedirectResponse
     */
    public function redirect(): RedirectResponse;

    /**
     * @param RegistrationResponder $responder
     * @return Response
     */
    public function present(RegistrationResponder $responder): Response;
}
