<?php

namespace LUIS\Models;

use LUIS\Models\Interfaces\ApiRequest;
use LUIS\Models\Interfaces\ApiResponse;

abstract class RequestHandler {

    /**
     * @var string the base path of this request's handler
     */
    private $basePath;

    /**
     * @var string the programmatic key to the LUIS API
     */
    private $programmaticKey;

    /**
     * Constructs a new request handler
     *
     * @param string $basePath
     * @param string $programmaticKey
     */
    public function __construct($basePath = '', $programmaticKey = '')
    {
        $this->basePath = $basePath;
        $this->programmaticKey = $programmaticKey;
    }

    /**
     * Executes a request
     *
     * @param ApiRequest $request the request to execute
     * @return ApiResponse the response returned
     */
    public function execute(ApiRequest $request)
    {
        return $request->execute($this->basePath, $this->programmaticKey);
    }

}