<?php

namespace Xqueue\MaileonPartnerApiClient\Http\Responses;

use Xqueue\MaileonPartnerApiClient\Http\ApiResponse;

class GeneralResponse extends BaseResponse
{

    /**
     * @param array|integer|BaseResponse $data
     * @param ApiResponse                $response
     */
    public function __construct(int|array|BaseResponse $data, ApiResponse $response)
    {
        parent::__construct($data, $response);
    }

    /**
     * @return int|array
     */
    public function getData(): int|array
    {
        return $this->data;
    }
}