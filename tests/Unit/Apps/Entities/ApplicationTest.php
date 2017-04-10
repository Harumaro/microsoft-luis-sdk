<?php

namespace LUIS\Tests\Unit;

use LUIS\Apps\Entities\Application;
use Mockery as m;

class ApplicationTest extends BaseTest {

    protected function setUp()
    {
        parent::setUp();
    }

    public function testShouldFillWithValuesFromArrayContainingSomeParameters()
    {
        $application = new Application();

        $this->assertAttributeEmpty('id', $application);
        $this->assertAttributeEmpty('name', $application);
        $this->assertAttributeEmpty('description', $application);

        $response = m::mock(\LUIS\Models\Interfaces\ApiResponse::class)
            ->shouldReceive('body')
            ->andReturn([
                "id" => "dummyText",
                "name" => "dummyText",
                "description" => "dummyText",
            ])
            ->getMock()
        ;

        $application->fill($response);

        $this->assertEquals('dummyText', $application->getId());
        $this->assertEquals('dummyText', $application->getName());
        $this->assertEquals('dummyText', $application->getDescription());
    }

    public function testShouldFillWithValuesFromArrayContainingAllParameters()
    {
        $application = new Application();

        $this->assertAttributeEmpty('id', $application);
        $this->assertAttributeEmpty('name', $application);
        $this->assertAttributeEmpty('description', $application);
        $this->assertAttributeEmpty('culture', $application);
        $this->assertAttributeEmpty('domain', $application);
        $this->assertAttributeEmpty('endpointHitsCount', $application);
        $this->assertAttributeEmpty('usageScenario', $application);
        $this->assertAttributeEmpty('versionsCount', $application);
        $this->assertAttributeEmpty('versionId', $application);
        $this->assertAttributeEmpty('assignedEndpointKey', $application);
        $this->assertAttributeEmpty('createdAt', $application);
        $this->assertAttributeEmpty('endpointUrl', $application);
        $this->assertAttributeEmpty('isStaging', $application);
        $this->assertAttributeEmpty('publishedDateTime', $application);

        $response = m::mock(\LUIS\Models\Interfaces\ApiResponse::class)
            ->shouldReceive('body')
            ->andReturn([
                "id" => "dummyText",
                "name" => "dummyText",
                "description" => "dummyText",
                "culture" => "dummyText",
                "domain" => "dummyText",
                "endpointHitsCount" => "dummyText",
                "usageScenario" => "dummyText",
                "versionsCount" => "dummyText",
                "endpoints" => [
                    $this->endpoint => [
                        "versionId" => "dummyText",
                        "assignedEndpointKey" => "dummyText",
                        "createdAt" => "dummyText",
                        "endpointUrl" => "dummyText",
                        "isStaging" => "dummyText",
                        "publishedDateTime" => "dummyText",
                    ]
                ]
            ])
            ->getMock()
        ;

        $application->fill($response);

        $this->assertEquals('dummyText', $application->getId());
        $this->assertEquals('dummyText', $application->getName());
        $this->assertEquals('dummyText', $application->getDescription());
        $this->assertEquals('dummyText', $application->getCulture());
        $this->assertEquals('dummyText', $application->getDomain());
        $this->assertEquals('dummyText', $application->getEndpointHitsCount());
        $this->assertEquals('dummyText', $application->getUsageScenario());
        $this->assertEquals('dummyText', $application->getVersionsCount());

        $this->assertEquals('dummyText', $application->getVersionId($this->endpoint));
        $this->assertEquals('dummyText', $application->getAssignedEndpointKey($this->endpoint));
        $this->assertEquals('dummyText', $application->getCreatedAt($this->endpoint));
        $this->assertEquals('dummyText', $application->getEndpointUrl($this->endpoint));
        $this->assertEquals('dummyText', $application->getIsStaging($this->endpoint));
        $this->assertEquals('dummyText', $application->getPublishedDateTime($this->endpoint));
    }

    public function testShouldFillIdIfReceivesAString()
    {
        $application = new Application();

        $this->assertAttributeEmpty('id', $application);

        $response = m::mock(\LUIS\Models\Interfaces\ApiResponse::class)
            ->shouldReceive('body')
            ->andReturn("dummyText")
            ->getMock()
        ;

        $application->fill($response);

        $this->assertEquals('dummyText', $application->getId());
    }

    public function testShouldThrowAnExceptionIfAttributeDoesNotExistInEntity()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage("Attribute dummyText does not exist in this Entity.");

        $application = new Application();

        $this->assertAttributeEmpty('id', $application);

        $response = m::mock(\LUIS\Models\Interfaces\ApiResponse::class)
            ->shouldReceive('body')
            ->andReturn([
                "id" => "dummyText",
                "dummyText" => "dummyText",
            ])
            ->getMock()
        ;

        $application->fill($response);
    }

}
