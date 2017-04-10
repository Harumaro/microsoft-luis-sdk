<?php

namespace LUIS\Tests\Unit;

use League\JsonGuard\Validator;
use LUIS\Apps\Entities\Application;
use PHPUnit\Framework\TestCase;
use Mockery as m;

class BaseTest extends TestCase {

    /**
     * @var Application|m\MockInterface
     */
    protected $application;

    protected $passingValidator;

    protected $failingValidator;

    protected $httpResponse;

    protected $endpoint;

    protected function setUp()
    {
        $this->endpoint = 'STAGING';

        $this->httpResponse = m::mock(\GuzzleHttp\Psr7\Response::class)
            ->makePartial()
            ->shouldReceive('getBody')
            ->andReturn(json_encode("dummyText"))
            ->getMock()
        ;

        $this->passingValidator = m::mock(Validator::class)
            ->shouldReceive('passes')
            ->andReturn(true)
            ->getMock()
        ;

        $this->failingValidator = m::mock(Validator::class)
            ->shouldReceive('passes')
            ->andReturn(false)
            ->getMock()
            ->shouldReceive('errors')
            ->andReturn([])
            ->getMock()
        ;

        $this->application = m::mock(Application::class)
            ->shouldReceive('getId')
            ->andReturn('dummyText')
            ->getMock()
            ->shouldReceive('getCulture')
            ->andReturn('dummyText')
            ->getMock()
            ->shouldReceive('getDomain')
            ->andReturn('dummyText')
            ->getMock()
            ->shouldReceive('getInitialVersionId')
            ->andReturn('dummyText')
            ->getMock()
            ->shouldReceive('getUsageScenario')
            ->andReturn('dummyText')
            ->getMock()
            ->shouldReceive('getName')
            ->andReturn('dummyText')
            ->getMock()
            ->shouldReceive('fill')
            ->andReturnSelf()
            ->getMock()
        ;
    }

}
