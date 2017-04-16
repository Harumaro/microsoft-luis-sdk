<?php

namespace LUIS\Apps\AddApplication;

use League\JsonGuard\Validator;
use LUIS\Models\Interfaces\ApiResponse;
use LUIS\Models\BaseResponse;

class Response extends BaseResponse implements ApiResponse {

    /**
     * @var mixed
     */
    private $responseBody;

    /**
     * @var string
     */
    private $rawResponseBody;

    /**
     * @var Validator
     */
    private $validator;

    public function __construct($rawResponse)
    {
        $this->rawResponseBody = $rawResponse;
        /**
         * When getting a valid response
         * Wraps this string response as we're receiving an id
         */
        $managedResponse = $rawResponse;
        if($this->validate()->passes()) {
            $managedResponse = \GuzzleHttp\json_encode(['id' => $rawResponse]);
        }

        $this->responseBody = $this->make($managedResponse);
    }

    /**
     * Returns a Validator to check whether the response is valid
     *
     * @return Validator
     */
    public function validate()
    {
        if(is_null($this->validator)) {
            $this->validator = new Validator(\GuzzleHttp\json_decode($this->rawResponseBody), $this->schema());
        }

        return $this->validator;
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