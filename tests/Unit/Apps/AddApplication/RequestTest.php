<?php

namespace LUIS\Tests\Unit;

use LUIS\Apps\AddApplication\Request;
use LUIS\Apps\AddApplication\Response;
use Mockery as m;

class RequestTest extends BaseTest {

    /**
     * @var Request|m\MockInterface
     */
    protected $request;

    protected function setUp()
    {
        parent::setUp();

        $this->request = m::mock(Request::class)
            ->shouldAllowMockingProtectedMethods()
            ->makePartial()
        ;
    }

    public function testShouldReceiveAResponseWhenExecutingARequest()
    {
        $this->request
            ->shouldReceive('fetchResponse')
            ->andReturn($this->httpResponse)
            ->getMock()
        ;

        $response = $this->request->execute('dummyUri', 'dummyKey');

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testShouldThrowAnExceptionWhenExecutingARequestWithFakeArgs()
    {
        $this->expectException(\GuzzleHttp\Exception\GuzzleException::class);

        $this->request->execute('http://127.0.0.1', 'dummyKey');
    }

    public function testShouldPassValidation()
    {
        $request = new Request($this->application, $this->endpoint);

        $this->assertTrue($request->validate()->passes());
    }

}
