<?php

namespace App\Tests;

use Generator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class RegistrationTest
 * @package App\Tests
 */
class RegistrationTest extends WebTestCase
{
    public function testSuccessful()
    {
        $client = static::createClient();

        $crawler = $client->request(Request::METHOD_GET, '/s-inscrire');

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $form = $crawler->filter("form[name=user]")->form([
            "user[email]" => "email@email.com",
            "user[pseudo]" => "pseudo",
            "user[password][first]" => 'password',
            "user[password][second]" => 'password'
        ]);

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();

        $this->assertRouteSame('security_login');
    }
    /**
     * @dataProvider provideFailed
     * @param array $formData
     * @param string $errorMessage
     */
    public function testFailed(array $formData, string $errorMessage)
    {
        $client = static::createClient();

        $crawler = $client->request(Request::METHOD_GET, '/s-inscrire');

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $form = $crawler->filter("form[name=user]")->form($formData);

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $this->assertSelectorTextContains('html', $errorMessage);
    }

    /**
     * @return Generator
     */
    public function provideFailed(): Generator
    {
        yield [
            [
                "user[email]" => "",
                "user[pseudo]" => "pseudo",
                "user[password][first]" => 'password',
                "user[password][second]" => 'password'
            ],
            'This value should not be blank.'
        ];

        yield [
            [
                "user[email]" => "fail",
                "user[pseudo]" => "pseudo",
                "user[password][first]" => 'password',
                "user[password][second]" => 'password'
            ],
            'This value is not a valid email address.'
        ];

        yield [
            [
                "user[email]" => "email+1@email.com",
                "user[pseudo]" => "pseudo",
                "user[password][first]" => 'password',
                "user[password][second]" => 'password'
            ],
            'This email already exists.'
        ];

        yield [
            [
                "user[email]" => "email@email.com",
                "user[pseudo]" => "pseudo+1",
                "user[password][first]" => 'password',
                "user[password][second]" => 'password'
            ],
            'This pseudo already exists.'
        ];

        yield [
            [
                "user[email]" => "email@email.com",
                "user[pseudo]" => "",
                "user[password][first]" => 'password',
                "user[password][second]" => 'password'
            ],
            'This value should not be blank.'
        ];

        yield [
            [
                "user[email]" => "email@email.com",
                "user[pseudo]" => "pseudo",
                "user[password][first]" => '',
                "user[password][second]" => ''
            ],
            'This value should not be blank.'
        ];

        yield [
            [
                "user[email]" => "email@email.com",
                "user[pseudo]" => "pseudo",
                "user[password][first]" => 'password',
                "user[password][second]" => 'fail'
            ],
            'La confirmation n\'est pas similaire au mot de passe.'
        ];

        yield [
            [
                "user[email]" => "email@email.com",
                "user[pseudo]" => "pseudo",
                "user[password][first]" => 'fail',
                "user[password][second]" => 'fail'
            ],
            'This value is too short. It should have 8 characters or more.'
        ];
    }
}
