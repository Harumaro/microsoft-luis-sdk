<?php

namespace LUIS\Models;

use LUIS\Models\Interfaces\ApiResponse;

interface BaseEntity {

    /**
     * Fills the entity with the response data from the API
     *
     * @param ApiResponse $apiResponse
     * @return void
     */
    public function fill(ApiResponse $apiResponse);

}