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
     * Creates a new application requests handler
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
        $path = EnvironmentSettings::API_BASE_URI . EnvironmentSettings::API_VERSION . self::API_URI;
        $programmaticKey = $this->client->getEnv()->getProgrammaticKey();

        parent::__construct($path, $programmaticKey);
    }

    /**
     * Gets an application from the manager's applications bucket
     *
     * @param $appId
     * @return null
     */
    public function get($appId)
    {
        return array_key_exists($appId, $this->apps) ? $this->apps[$appId] : null;
    }

    /**
     * Puts an application in the manager's applications bucket
     *
     * @param Application $application
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

    /**
     * Adds a new application
     *
     * @param Application $application the application's parameters to send through the request
     * @throws ResponseNotValidException
     */
    public function addApplication(Application $application)
    {
        $response = $this->execute(new AddApplication\Request($application));
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