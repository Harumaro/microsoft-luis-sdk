<?php

namespace LUIS;


class EnvironmentSettings {

    const API_BASE_URI = 'https://westus.api.cognitive.microsoft.com/luis/api/';
    const API_VERSION = 'v2.0';

    /**
     * @var string
     */
    private $programmaticKey;

    /**
     * @param null|string $programmaticKey the key to use if we don't have the env variable set
     */
    public function __construct($programmaticKey = null)
    {
        $this->programmaticKey = $this->getEnv('LUIS_PROGRAMMATIC_KEY', $programmaticKey);
    }

    /**
     * Gets an environment variable
     *
     * @param string $envName the name of the environment var
     * @param string $default option in case the environment var is not set
     * @return string
     */
    protected function getEnv($envName, $default)
    {
        return is_null(getenv($envName)) ? $default : getenv($envName);
    }

    /**
     * Gets the api programmatic key
     *
     * @return string
     */
    public function getProgrammaticKey()
    {
        return $this->programmaticKey;
    }

    /**
     * Sets the api programmatic key
     *
     * @param string $key
     * @return string
     */
    public function setProgrammaticKey($key)
    {
        $this->programmaticKey = $key;
    }
}