<?php

namespace LUIS\Apps\Entities;

use LUIS\Models\Interfaces\ApiResponse;
use LUIS\Models\BaseEntity;

class Application implements BaseEntity {

    private $id;

    private $name;

    private $description;

    private $culture;

    private $usageScenario;

    private $domain;

    private $versionsCount;

    private $createdAt;

    private $endpointHitsCount;

    private $initialVersionId;

    private $versionId = [];

    private $isStaging = [];

    private $endpointUrl = [];

    private $assignedEndpointKey = [];

    private $publishedDateTime = [];

    function __call($method, $arguments)
    {
        $attrName = lcfirst(substr($method, 3));

        throw new \BadMethodCallException("Attribute $attrName does not exist in this Entity.");
    }

    /**
     * @param string $endpoint
     * @return mixed
     */
    public function getAssignedEndpointKey($endpoint = 'STAGING')
    {
        return $this->assignedEndpointKey[$endpoint];
    }

    /**
     * @param $assignedEndpointKey
     * @param string $endpoint
     */
    public function setAssignedEndpointKey($assignedEndpointKey, $endpoint = 'STAGING')
    {
        $this->assignedEndpointKey[$endpoint] = $assignedEndpointKey;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getCulture()
    {
        return $this->culture;
    }

    /**
     * @param $culture
     */
    public function setCulture($culture)
    {
        $this->culture = $culture;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param $domain
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
    }

    /**
     * @return mixed
     */
    public function getEndpointHitsCount()
    {
        return $this->endpointHitsCount;
    }

    /**
     * @param $endpointHitsCount
     */
    public function setEndpointHitsCount($endpointHitsCount)
    {
        $this->endpointHitsCount = $endpointHitsCount;
    }

    /**
     * @param string $endpoint
     * @return mixed
     */
    public function getEndpointUrl($endpoint = 'STAGING')
    {
        return $this->endpointUrl[$endpoint];
    }

    /**
     * @param $endpointUrl
     * @param string $endpoint
     */
    public function setEndpointUrl($endpointUrl, $endpoint = 'STAGING')
    {
        $this->endpointUrl[$endpoint] = $endpointUrl;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $endpoint
     * @return mixed
     */
    public function getIsStaging($endpoint = 'STAGING')
    {
        return $this->isStaging[$endpoint];
    }

    /**
     * @param $isStaging
     * @param string $endpoint
     */
    public function setIsStaging($isStaging, $endpoint = 'STAGING')
    {
        $this->isStaging[$endpoint] = $isStaging;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param string $endpoint
     * @return mixed
     */
    public function getPublishedDateTime($endpoint = 'STAGING')
    {
        return $this->publishedDateTime[$endpoint];
    }

    /**
     * @param $publishedDateTime
     * @param string $endpoint
     */
    public function setPublishedDateTime($publishedDateTime, $endpoint = 'STAGING')
    {
        $this->publishedDateTime[$endpoint] = $publishedDateTime;
    }

    /**
     * @return mixed
     */
    public function getUsageScenario()
    {
        return $this->usageScenario;
    }

    /**
     * @param $usageScenario
     */
    public function setUsageScenario($usageScenario)
    {
        $this->usageScenario = $usageScenario;
    }

    /**
     * @return string
     */
    public function getInitialVersionId()
    {
        return $this->initialVersionId;
    }

    /**
     * @param $initialVersionId
     */
    public function setInitialVersionId($initialVersionId)
    {
        $this->initialVersionId = $initialVersionId;
    }

    /**
     * @param string $endpoint
     * @return mixed
     */
    public function getVersionId($endpoint = 'STAGING')
    {
        return $this->versionId[$endpoint];
    }

    /**
     * @param $versionId
     * @param string $endpoint
     */
    public function setVersionId($versionId, $endpoint = 'STAGING')
    {
        $this->versionId[$endpoint] = $versionId;
    }

    /**
     * @return mixed
     */
    public function getVersionsCount()
    {
        return $this->versionsCount;
    }

    /**
     * @param $versionsCount
     */
    public function setVersionsCount($versionsCount)
    {
        $this->versionsCount = $versionsCount;
    }

    /**
     * Fills the entity with the response data from the API
     *
     * @param ApiResponse $apiResponse
     * @return void
     */
    public function fill(ApiResponse $apiResponse)
    {
        $responseBody = $apiResponse->body();
        if(is_array($responseBody)) {
            foreach($responseBody as $key => $item) {
                if($key === "endpoints" and is_array($item)) {
                    foreach($item as $name => $endpoint) {
                        foreach($endpoint as $key => $endpointItem) {
                            $this->{'set'.ucfirst($key)}($endpointItem, $name);
                        }
                    }
                } else {
                    $this->{'set'.ucfirst($key)}($item);
                }
            }
        }
    }

}