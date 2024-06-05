<?php

namespace Xqueue\MaileonPartnerApiClient\Http\Responses;

use Xqueue\MaileonPartnerApiClient\Http\ApiResponse;

class BaseResponse
{

    public mixed       $data;
    public ApiResponse $response;

    /**
     * @param mixed       $data
     * @param ApiResponse $response
     */
    public function __construct(mixed $data, ApiResponse $response)
    {
        $this->data     = $data;
        $this->response = $response;
    }

    /**
     * @return ApiResponse
     */
    public function getApiResponse(): ApiResponse
    {
        return $this->response;
    }
}