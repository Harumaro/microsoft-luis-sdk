<?php

namespace LUIS\Models;

abstract class BaseResponse
{

    /**
     * Converts a json string into an associative array
     *
     * @param string $rawResponse
     * @return array
     */
    protected function make($rawResponse)
    {
        return \GuzzleHttp\json_decode($rawResponse, true);
    }

    /**
     * The schema to use for this response
     *
     * @return string
     */
    abstract protected function schema();

}