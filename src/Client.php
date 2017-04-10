<?php

namespace LUIS;

use LUIS\Apps\ApplicationManager;

class Client {

    /**
     * @var EnvironmentSettings
     */
    private $env;

    private $managers = [];

    /**
     * Creates a new client, with either given or default environment settings
     *
     * @param null|EnvironmentSettings $env
     */
    public function __construct(EnvironmentSettings $env = null)
    {
        $this->env = is_null($env) ? new EnvironmentSettings() : $env;
    }

    /**
     * Gets the environment settings
     *
     * @return EnvironmentSettings
     */
    public function getEnv()
    {
        return $this->env;
    }

    public function getApplicationManager()
    {
        if(!array_key_exists(__FUNCTION__, $this->managers)) {
            $this->managers[__FUNCTION__] = new ApplicationManager($this);
        }

        return $this->managers[__FUNCTION__];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getQueryManager()
    {
        // TODO: Implement getQueryManager() method.
    }

}