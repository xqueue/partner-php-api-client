<?php

namespace Xqueue\MaileonPartnerApiClient\Http\Responses;

use Xqueue\MaileonPartnerApiClient\Entities\AccountStatus;
use Xqueue\MaileonPartnerApiClient\Http\ApiResponse;

class AccountStatusResponse extends BaseResponse
{
    /**
     * @param AccountStatus|AccountStatus[] $data
     * @param ApiResponse $response
     */
    public function __construct(AccountStatus|array $data, ApiResponse $response)
    {
        parent::__construct($data, $response);
    }

    /**
     * @return AccountStatus|AccountStatus[]
     */
    public  function getData(): AccountStatus|array
    {
        return $this->data;
    }
}