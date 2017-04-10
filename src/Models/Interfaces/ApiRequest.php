<?php

namespace LUIS\Models\Interfaces;

use League\JsonGuard\Validator;

interface ApiRequest
{

    /**
     * Returns a Validator to check whether the request is valid
     *
     * @return Validator
     */
    public function validate();

    /**
     * Sends a request to the LUIS API
     *
     * @param string $basePath the base path of the request
     * @param string $programmaticKey the programmatic key
     * @return ApiResponse the response from the API
     */
    public function execute($basePath, $programmaticKey);

}