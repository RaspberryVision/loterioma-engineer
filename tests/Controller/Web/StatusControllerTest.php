<?php

namespace App\Tests\Controller\Web;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class StatusControllerTest extends WebTestCase
{
    /**
     * Web test for generate method.
     *
     * @dataProvider dataProviderTestGenerate
     * @param array $testCase
     */
    public function testIndex(array $testCase)
    {
        $client = static::createClient(
            [],
            [
                'HTTP_HOST' => 'loterioma_rng',
            ]
        );

        $client->request(
            'GET',
            '/generate',
            [],
            [],
            [],
            json_encode($testCase['request'])
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        /** @var array $resultedMatrix */
        $resultedMatrix = json_decode($client->getResponse()->getContent());
        foreach ($resultedMatrix as $indexY => $row) {

            $this->assertSameSize($testCase['request']['format'][$indexY], $row);

            foreach ($row as $indexX => $field) {
                $this->assertNotEquals(-1, $field);

                $this->assertThat(
                    $field,
                    $this->logicalAnd(
                        $this->greaterThan($testCase['request']['min'] - 1),
                        $this->lessThan($testCase['request']['max'] + 1)
                    )
                );
            }
        }
    }

    /**
     * Data provider for testGenerate.
     *
     * @return \Generator
     */
    public function dataProviderTestGenerate()
    {
        yield [
            [
                'request' => [
                    'seed' => 0,
                    'type' => 0,
                    'min' => 1,
                    'max' => 10,
                    'format' => [
                        [-1, 2],
                        [-1, -1],
                    ],
                ],
            ],
        ];
    }
}
