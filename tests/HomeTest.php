<?php

namespace App\Tests;

use Generator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class HomeTest
 * @package App\Tests
 */
class HomeTest extends WebTestCase
{
    /**
     * @dataProvider provide
     * @param string $uri
     */
    public function test(string $uri)
    {
        $client = static::createClient();

        $client->request(Request::METHOD_GET, $uri);

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    /**
     * @return Generator
     */
    public function provide(): Generator
    {
        yield ['/'];
        yield ['/?page=2'];
        yield ['/?page=3&field=p.title&order=desc&limit=20'];
    }
}
