<?php

namespace App\Tests\Controller\Web;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AppControllerTest extends WebTestCase
{
    /**
     * Web test for default app path.
     *
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
            '/',
            [],
            [],
            []
        );

        /* Check that status 200 */
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        /* Check that title is ok */
        if ($testCase['expected']) {
            $this->assertSelectorTextContains('h1', $testCase['title']);
        } else {
            $this->assertSelectorTextNotContains('h1', $testCase['title']);
        }
    }

    /**
     * Data provider for testGenerate.
     *
     * @return \Generator
     */
    public function dataProviderTestIndex()
    {
        yield [['title' => 'X', 'expected' => false]];
        yield [['title' => 'Wrong title', 'expected' => false]];
        yield [['title' => '123', 'expected' => false]];
        yield [['title' => 'Loterioma Engineer', 'expected' => true]];
    }
}
