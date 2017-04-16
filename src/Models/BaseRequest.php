<?php

namespace LUIS\Models;

use GuzzleHttp\Client;

abstract class BaseRequest
{

    /**
     * Fetches a response from an API endpoint
     *
     * @param string $httpMethod the method of the request
     * @param string $requestPath the URI of the request
     * @param string $programmaticKey
     * @return mixed
     */
    protected function fetchResponse($httpMethod, $requestPath, $programmaticKey)
    {
        $client = new Client();

        $response = $client->request($httpMethod, $requestPath, [
            'headers' => [
                'Content-Type'              => 'application/json',
                'Ocp-Apim-Subscription-Key' => $programmaticKey
            ],
        ]);

        return $response;
    }

    /**
     * Converts this request array data to a json string
     *
     * @param array $rawRequest
     * @return string
     */
    protected function make($rawRequest)
    {
        return \GuzzleHttp\json_encode($rawRequest);
    }

    /**
     * The schema to use for this request
     *
     * @return string
     */
    abstract protected function schema();

}