<?php

namespace LUIS\Apps\AddApplication;

use League\JsonGuard\Validator;
use LUIS\Apps\Entities\Application;
use LUIS\Models\BaseRequest;
use LUIS\Models\Interfaces\ApiRequest;
use LUIS\Models\Interfaces\ApiResponse;

class Request extends BaseRequest implements ApiRequest
{

    const API_URI = '';

    const API_METHOD = 'GET';

    /**
     * @var object
     */
    private $requestBody;

    /**
     * Construct a new request
     *
     * @param Application $application
     */
    public function __construct(Application $application)
    {
        $this->requestBody = (object)[
            'Culture'          => $application->getCulture(),
            'Domain'           => $application->getDomain(),
            'InitialVersionId' => $application->getInitialVersionId(),
            'UsageScenario'    => $application->getUsageScenario(),
            'Name'             => $application->getName(),
        ];
    }

    /**
     * Returns a Validator to check whether the request is valid
     *
     * @return Validator
     */
    public function validate()
    {
        return new Validator($this->requestBody, $this->schema());
    }

    /**
     * Sends a request to the LUIS API
     *
     * @param string $basePath the base path of the request
     * @param string $programmaticKey the programmatic key
     * @return ApiResponse the response from the API
     * @throws \Exception
     */
    public function execute($basePath, $programmaticKey)
    {
        try {
            $response = $this->fetchResponse(self::API_METHOD, $basePath . self::API_URI, $programmaticKey);
        } catch (\Exception $e) {
            throw $e;
        }

        return new Response($response->getBody());
    }

    /**
     * The schema to use for this request
     *
     * @return object
     */
    protected function schema()
    {
        return (object)[
            'additionalProperties' => false,
            'type'                 => 'object',
            'properties'           => (object)[
                'Culture'          => (object)[
                    'type' => 'string'
                ],
                'Domain'           => (object)[
                    'type' => 'string'
                ],
                'Description'      => (object)[
                    'type' => 'string'
                ],
                'InitialVersionId' => (object)[
                    'type' => 'string'
                ],
                'UsageScenario'    => (object)[
                    'type' => 'string'
                ],
                'Name'             => (object)[
                    'type' => 'string'
                ]
            ]
        ];
    }

}