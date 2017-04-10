<?php

namespace LUIS\Apps\AddApplication;

use League\JsonGuard\Validator;
use LUIS\Models\Interfaces\ApiResponse;
use LUIS\Models\BaseResponse;

class Response extends BaseResponse implements ApiResponse {

    private $responseBody;

    private $rawResponseBody;

    public function __construct($rawResponse)
    {
        $this->rawResponseBody = $rawResponse;
        $this->responseBody = $this->make($rawResponse);
    }

    /**
     * Returns a Validator to check whether the response is valid
     *
     * @return Validator
     */
    public function validate()
    {
        return new Validator(\GuzzleHttp\json_decode($this->rawResponseBody), $this->schema());
    }

    /**
     * Returns the response body as an associative array
     *
     * @return array
     */
    public function body()
    {
        return $this->responseBody;
    }

    /**
     * The schema to use for this response
     *
     * @return object
     */
    protected function schema()
    {
        return (object)[
            "additionalProperties" => false,
            "type"                 => "string",
        ];
    }


}