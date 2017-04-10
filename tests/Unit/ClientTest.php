<?php

namespace LUIS\Tests\Unit;

use LUIS\Apps\ApplicationManager;
use LUIS\Client;
use LUIS\EnvironmentSettings;

class ClientTest extends BaseTest {

    /**
     * @var Client
     */
    protected $client;

    protected function setUp()
    {
        parent::setUp();

        $this->client = new Client(new EnvironmentSettings('dummyText'));
    }

    /**
     * @covers \LUIS\Client::__construct
     * @covers \LUIS\Client::getEnv
     */
    public function testShouldRetrieveDefaultEnvironmentValues()
    {
        putenv('LUIS_PROGRAMMATIC_KEY=dummyText');

        $client = new Client();

        $this->assertInstanceOf(EnvironmentSettings::class, $client->getEnv());
        $this->assertEquals('dummyText', $client->getEnv()->getProgrammaticKey());
    }

    /**
     * @covers \LUIS\Client::getApplicationManager
     */
    public function testShouldReturnAnApplicationManager()
    {
        $this->assertInstanceOf(ApplicationManager::class, $this->client->getApplicationManager());
    }

}
