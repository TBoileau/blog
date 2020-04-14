<?php

namespace App\Domain\Security\Controller;

use App\Domain\Security\DataTransferObject\Credentials;
use App\Domain\Security\Form\LoginType;
use App\Domain\Security\Presenter\LoginPresenterInterface;
use App\Domain\Security\Responder\LoginResponder;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class Login
{
    /**
     * @param AuthenticationUtils $authenticationUtils
     * @param FormFactoryInterface $formFactory
     * @param LoginPresenterInterface $presenter
     * @return Response
     */
    public function __invoke(
        AuthenticationUtils $authenticationUtils,
        FormFactoryInterface $formFactory,
        LoginPresenterInterface $presenter
    ): Response {
        $form = $formFactory->create(LoginType::class, new Credentials($authenticationUtils->getLastUsername()));

        if (null !== $authenticationUtils->getLastAuthenticationError(false)) {
            $form->addError(new FormError($authenticationUtils->getLastAuthenticationError()->getMessage()));
        }

        return $presenter->present(new LoginResponder($form->createView()));
    }
}
