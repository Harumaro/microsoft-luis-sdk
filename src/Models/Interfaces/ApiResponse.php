<?php

namespace LUIS\Models\Interfaces;

use League\JsonGuard\Validator;

interface ApiResponse
{

    /**
     * Returns a Validator to check whether the response is valid
     *
     * @return Validator
     */
    public function validate();

    /**
     * Returns the response body as an associative array
     *
     * @return array
     */
    public function body();

}