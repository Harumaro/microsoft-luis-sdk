<?php

namespace LUIS\Tests\Unit;

use LUIS\Apps\AddApplication\Response;

class ResponseTest extends BaseTest {

    /**
     * @var Response
     */
    protected $response;

    protected function setUp()
    {
        parent::setUp();

        $this->response = new Response(\GuzzleHttp\json_encode("dummyText"));
    }

    public function testShouldPassValidation()
    {
        $this->assertTrue($this->response->validate()->passes());
    }

    public function testResponseBodyShouldHaveAKeyNamedId()
    {
        $this->assertInternalType('array', $this->response->body());
        $this->assertArrayHasKey('id', $this->response->body());
    }

}
