<?php

namespace App\Tests;

use Generator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CreateTest
 * @package App\Tests
 */
class CreateTest extends WebTestCase
{
    use AuthenticationTrait, UploadTrait;

    public function testWithoutAuthentication()
    {
        $client = static::createClient();

        $client->request(Request::METHOD_GET, "/publier-article");

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();

        $this->assertRouteSame('security_login');
    }

    public function testSuccessful()
    {
        $client = static::createAuthenticatedClient();

        $crawler = $client->request(Request::METHOD_GET, "/publier-article");

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $form = $crawler->filter("form[name=post]")->form([
            "post[title]" => "Title",
            "post[content]" => 'Content article',
            "post[image]" => static::createImage()
        ]);

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();

        $this->assertRouteSame('blog_read');
    }

    /**
     * @dataProvider provideFailed
     * @param array $formData
     * @param string $errorMessage
     */
    public function testFailed(array $formData, string $errorMessage)
    {
        $client = static::createAuthenticatedClient();

        $crawler = $client->request(Request::METHOD_GET, "/publier-article");

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $form = $crawler->filter("form[name=post]")->form($formData);

        $client->submit($form);

        $this->assertSelectorTextContains('html', $errorMessage);
    }

    /**
     * @return Generator
     * @throws \Exception
     */
    public function provideFailed(): Generator
    {
        yield [
            [
                "post[title]" => "",
                "post[content]" => 'Content article',
                "post[image]" => static::createImage()
            ],
            'This value should not be blank.'
        ];

        yield [
            [
                "post[title]" => "Title",
                "post[content]" => '',
                "post[image]" => static::createImage()
            ],
            'This value should not be blank.'
        ];

        yield [
            [
                "post[title]" => "Title",
                "post[content]" => 'Fail',
                "post[image]" => static::createImage()
            ],
            'This value is too short. It should have 10 characters or more.'
        ];

        yield [
            [
                "post[title]" => "Title",
                "post[content]" => 'Content article'
            ],
            'This value should not be null.'
        ];

//        yield [
//            [
//                "post[title]" => "Title",
//                "post[content]" => 'Content article',
//                "post[image]" => static::createTextFile()
//            ],
//            'This file is not a valid image.'
//        ];
    }
}
