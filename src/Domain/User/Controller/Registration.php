<?php

namespace App\Domain\User\Controller;

use App\Application\Entity\User;
use App\Domain\User\Handler\RegistrationHandler;
use App\Domain\User\Presenter\RegistrationPresenterInterface;
use App\Domain\User\Responder\RegistrationResponder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Registration
{
    /**
     * @param Request $request
     * @param RegistrationHandler $registrationHandler
     * @param RegistrationPresenterInterface $presenter
     * @return Response
     * @throws \Exception
     */
    public function __invoke(
        Request $request,
        RegistrationHandler $registrationHandler,
        RegistrationPresenterInterface $presenter
    ): Response {
        if ($registrationHandler->handle($request, new User())) {
            return $presenter->redirect() ;
        }

        return $presenter->present(new RegistrationResponder($registrationHandler->createView()));
    }
}