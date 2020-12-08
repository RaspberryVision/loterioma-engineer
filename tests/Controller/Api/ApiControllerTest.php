<?php

namespace App\Tests\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiControllerTest extends WebTestCase
{
    /**
     * @dataProvider dataProviderTestIndex
     * @param array $testCase
     */
    public function testIndex(array $testCase)
    {
        $client = static::createClient(
            [],
            [
                'HTTP_HOST' => 'loterioma_engineer',
            ]
        );

        $client->request(
            'GET',
            '/api/',
            [],
            [],
            []
        );

        /* Check that status 200 */
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        /* Check that json response */
        $this->assertEquals(
            $client->getResponse()->headers->get('Content-type'),
            $testCase['content_type']
        );

        $response = json_decode($client->getResponse()->getContent(), true);

        /* Check that response has valid format */
        $this->assertArrayHasKey('name', $response);
        $this->assertArrayHasKey('slug', $response);
        $this->assertArrayHasKey('port', $response);

        /* Check that returned values are valid */
        $this->assertEquals($response['name'], $testCase['name']);
        $this->assertEquals($response['slug'], $testCase['slug']);
        $this->assertEquals($response['port'], $testCase['port']);
    }

    /**
     * @return \Generator
     */
    public function dataProviderTestIndex()
    {
        yield [
            [
                'content_type' => 'application/json',
                'name' => 'Loterioma Engineer',
                'slug' => 'loterioma_engineer',
                'port' => 9902,
            ],
        ];
    }
}
