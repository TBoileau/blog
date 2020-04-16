<?php

namespace App\Domain\Security\Guard;

use App\Domain\Security\DataTransferObject\Credentials;
use App\Domain\Security\Form\LoginType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;

/**
 * Class WebAuthenticator
 * @package App\Domain\Security\Guard
 */
class WebAuthenticator extends AbstractFormLoginAuthenticator
{
    /**
     * @var UrlGeneratorInterface
     */
    private UrlGeneratorInterface $urlGenerator;

    /**
     * @var FormFactoryInterface
     */
    private FormFactoryInterface $formFactory;

    /**
     * @var UserPasswordEncoderInterface
     */
    private UserPasswordEncoderInterface $userPasswordEncoder;

    /**
     * WebAuthenticator constructor.
     * @param UrlGeneratorInterface $urlGenerator
     * @param FormFactoryInterface $formFactory
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     */
    public function __construct(
        UrlGeneratorInterface $urlGenerator,
        FormFactoryInterface $formFactory,
        UserPasswordEncoderInterface $userPasswordEncoder
    ) {
        $this->urlGenerator = $urlGenerator;
        $this->formFactory = $formFactory;
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    /**
     * @inheritDoc
     */
    protected function getLoginUrl()
    {
        return $this->urlGenerator->generate("security_login");
    }

    /**
     * @inheritDoc
     */
    public function supports(Request $request)
    {
        return $request->isMethod(Request::METHOD_POST)
            && $request->attributes->get("_route") === "security_login";
    }

    /**
     * @inheritDoc
     */
    public function getCredentials(Request $request)
    {
        $credentials = new Credentials();
        $form = $this->formFactory->create(LoginType::class, $credentials)->handleRequest($request);

        if (!$form->isValid()) {
            throw new AuthenticationException('Email and password is not valid.');
        }

        return $credentials;
    }

    /**
     * @param Credentials $credentials
     * @param UserProviderInterface $userProvider
     * @return UserInterface|void|null
     */
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        return $userProvider->loadUserByUsername($credentials->getUsername());
    }

    /**
     * @param Credentials $credentials
     * @param UserInterface $user
     * @return bool
     */
    public function checkCredentials($credentials, UserInterface $user)
    {
        if ($valid = $this->userPasswordEncoder->isPasswordValid($user, $credentials->getPassword())) {
            return true;
        }

        throw new AuthenticationException('Password not valid.');
    }

    /**
     * @inheritDoc
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $providerKey)
    {
        return new RedirectResponse($this->urlGenerator->generate("index"));
    }
}
