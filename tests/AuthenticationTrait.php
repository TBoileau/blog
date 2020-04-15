<?php

namespace App\Tests;

use App\Application\Entity\User;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

/**
 * Trait AuthenticationTrait
 * @package App\Tests
 */
trait AuthenticationTrait
{
    /**
     * @return KernelBrowser
     */
    public static function createAuthenticatedClient(): KernelBrowser
    {
        $client = static::createClient();

        $client->getCookieJar()->clear();

        $firewallContext = 'main';

        /** @var SessionInterface $session */
        $session = $client->getContainer()->get('session');

        $entityManager = $client->getContainer()->get("doctrine.orm.entity_manager");

        $user = $entityManager->getRepository(User::class)->findOneByEmail("email+1@email.com");

        $token = new UsernamePasswordToken(
            $user,
            $user->getPassword(),
            $firewallContext,
            $user->getRoles()
        );

        $session->set('_security_' . $firewallContext, serialize($token));

        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());

        $client->getCookieJar()->set($cookie);

        return $client;
    }
}
