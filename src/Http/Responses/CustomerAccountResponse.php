<?php

namespace Xqueue\MaileonPartnerApiClient\Http\Responses;

use Xqueue\MaileonPartnerApiClient\Entities\CustomerAccount;
use Xqueue\MaileonPartnerApiClient\Http\ApiResponse;

class CustomerAccountResponse extends BaseResponse
{
    /**
     * @param CustomerAccount|CustomerAccount[] $data
     * @param ApiResponse                       $response
     */
    public function __construct(CustomerAccount|array $data, ApiResponse $response)
    {
        parent::__construct($data, $response);
    }

    /**
     * @return CustomerAccount|CustomerAccount[]
     */
    public function getData(): CustomerAccount|array
    {
        return $this->data;
    }
}