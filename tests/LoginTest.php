<?php

namespace App\Tests;

use Generator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class LoginTest
 * @package App\Tests
 */
class LoginTest extends WebTestCase
{
    public function testSuccessful()
    {
        $client = static::createClient();

        $crawler = $client->request(Request::METHOD_GET, '/se-connecter');

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $form = $crawler->filter("form[name=login]")->form([
            "login[username]" => "email+1@email.com",
            "login[password]" => 'password'
        ]);

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();

        $this->assertRouteSame('index');
    }

    /**
     * @dataProvider provideFailed
     * @param array $formData
     * @param string $errorMessage
     */
    public function testFailed(array $formData, string $errorMessage)
    {
        $client = static::createClient();

        $crawler = $client->request(Request::METHOD_GET, '/se-connecter');

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $form = $crawler->filter("form[name=login]")->form($formData);

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();

        $this->assertSelectorTextContains('html', $errorMessage);
    }

    /**
     * @return Generator
     */
    public function provideFailed(): Generator
    {
        yield [
            [
                "login[username]" => "email+1@email.com",
                "login[password]" => 'fail'
            ],
            'Password not valid'
        ];

        yield [
            [
                "login[username]" => "fail",
                "login[password]" => 'fail'
            ],
            'User "fail" not found'
        ];

        yield [
            [
                "login[username]" => "",
                "login[password]" => ''
            ],
            'Email and password is not valid.'
        ];
    }
}
