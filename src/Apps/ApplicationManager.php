<?php

namespace LUIS\Apps;

use LUIS\Apps\Entities\Application;
use LUIS\Client;
use LUIS\EnvironmentSettings;
use LUIS\Models\Exceptions\ResponseNotValidException;
use LUIS\Models\RequestHandler;

class ApplicationManager extends RequestHandler
{

    const API_URI = '/apps';

    /**
     * @var Client
     */
    private $client;

    /**
     * @var Application[]
     */
    private $apps = [];

    /**
     * Creates a new application resource
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;

        parent::__construct(EnvironmentSettings::API_BASE_URI . EnvironmentSettings::API_VERSION . self::API_URI);
    }

    /**
     * @param $appId
     * @return null
     */
    public function get($appId)
    {
        return array_key_exists($appId, $this->apps) ? $this->apps[$appId] : null;
    }

    /**
     * @param Application $application
     * @codeCoverageIgnore
     */
    private function set(Application $application)
    {
        $this->apps[$application->getId()] = $application;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getAll($skip = 0, $take = 100)
    {
        // TODO UserApplications\Request

        return $this->apps;
    }

    public function addApplication(Application $application, $endpoint)
    {
        $response = $this->execute(
            $this->client->getEnv()->getProgrammaticKey(),
            new AddApplication\Request($application, $endpoint)
        );
        $validator = $response->validate();

        if ($validator->passes()) {
            $application->fill($response);
            $this->set($application);
        } else {
            throw new ResponseNotValidException($validator->errors());
        }
    }

    /**
     * @codeCoverageIgnore
     */
    public function deleteApplication($appId)
    {
        // TODO DeleteApplication\Request
    }

    /**
     * @codeCoverageIgnore
     */
    public function importApplication()
    {
        // TODO ImportApplication\Request
    }

    /**
     * @codeCoverageIgnore
     */
    public function getApplicationCultures()
    {
        // TODO ApplicationCultures\Request
    }

    /**
     * @codeCoverageIgnore
     */
    public function getApplicationDomains()
    {
        // TODO ApplicationDomains\Request
    }

    /**
     * @codeCoverageIgnore
     */
    public function getCortanaPrebuilts()
    {
        // TODO PersonalAssistant\Request
    }

}