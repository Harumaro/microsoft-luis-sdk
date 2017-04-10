<?php

namespace LUIS\Tests\Unit\Apps;

use LUIS\Client;
use LUIS\Models\Exceptions\ResponseNotValidException;
use Mockery as m;
use LUIS\Apps\ApplicationManager;
use LUIS\Tests\Unit\BaseTest;

class ApplicationManagerTest extends BaseTest {

    /**
     * @var ApplicationManager|m\MockInterface
     */
    private $appManager;

    protected function setUp()
    {
        parent::setUp();

        $client = m::mock(Client::class);
        $client->shouldReceive('getEnv->getProgrammaticKey')
            ->andReturn(md5('test'))
            ->getMock()
        ;

        $this->appManager = m::mock(ApplicationManager::class, [ $client ])
            ->makePartial()
        ;
    }

    public function testShouldAddANewApplication()
    {
        $response = m::mock(\LUIS\Apps\AddApplication\Response::class)
            ->shouldReceive('validate')
            ->andReturn($this->passingValidator)
            ->getMock()
        ;

        $this->appManager
            ->shouldReceive('execute')
            ->andReturn($response)
            ->getMock()
        ;

        $this->appManager->addApplication($this->application, $this->endpoint);

        $this->assertNotEmpty($this->appManager->get($this->application->getId()));
    }

    public function testShouldThrowAnExceptionWhileAddingANewApplicationWithInvalidResponse()
    {
        $this->expectException(ResponseNotValidException::class);
        $this->expectExceptionMessage("--- Response not valid. Report of errors: \n");
        $this->expectExceptionCode(500);

        $response = m::mock(\LUIS\Apps\AddApplication\Response::class)
            ->shouldReceive('validate')
            ->andReturn($this->failingValidator)
            ->getMock()
        ;

        $this->appManager
            ->shouldReceive('execute')
            ->andReturn($response)
            ->getMock()
        ;

        try {
            $this->appManager->addApplication($this->application, $this->endpoint);
        } catch(\Exception $e) {
            $this->assertEmpty($this->appManager->get($this->application->getId()));
            throw $e;
        }
    }

}
