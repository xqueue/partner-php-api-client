<?php

namespace Xqueue\MaileonPartnerApiClient\Http\Responses;

use Xqueue\MaileonPartnerApiClient\Entities\UserAccount;
use Xqueue\MaileonPartnerApiClient\Http\ApiResponse;

class UserAccountResponse extends BaseResponse
{

    /**
     * @param UserAccount|UserAccount[] $data
     * @param ApiResponse               $response
     */
    public function __construct(UserAccount|array $data, ApiResponse $response)
    {
        parent::__construct($data, $response);
    }

    /**
     * @return UserAccount|UserAccount[]
     */
    public function getData(): UserAccount|array
    {
        return $this->data;
    }
}