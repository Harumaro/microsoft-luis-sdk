<?php

namespace LUIS\Models;

use LUIS\Models\Interfaces\ApiRequest;
use LUIS\Models\Interfaces\ApiResponse;

abstract class RequestHandler {

    /**
     * @var string
     */
    private $basePath;

    /**
     * @param string $basePath
     */
    public function __construct($basePath = '')
    {
        $this->basePath = $basePath;
    }

    /**
     * @param string $programmaticKey
     * @param ApiRequest $request
     * @return ApiResponse
     */
    public function execute($programmaticKey, ApiRequest $request)
    {
        return $request->execute($this->basePath, $programmaticKey);
    }

}