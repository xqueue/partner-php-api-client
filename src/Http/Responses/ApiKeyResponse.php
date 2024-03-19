<?php

namespace Xqueue\MaileonPartnerApiClient\Http\Responses;

use Xqueue\MaileonPartnerApiClient\Entities\ApiKey;
use Xqueue\MaileonPartnerApiClient\Http\ApiResponse;

class ApiKeyResponse extends BaseResponse
{

    /**
     * @param ApiKey|ApiKey[] $data
     * @param ApiResponse $response
     */
    public function __construct(ApiKey|array $data, ApiResponse $response)
    {
        parent::__construct($data, $response);
    }

    /**
     * @return ApiKey|ApiKey[]
     */
    public  function getData(): ApiKey|array
    {
        return $this->data;
    }
}