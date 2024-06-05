<?php

namespace Xqueue\MaileonPartnerApiClient\Http\Responses;

use Xqueue\MaileonPartnerApiClient\Entities\Blacklist;
use Xqueue\MaileonPartnerApiClient\Http\ApiResponse;

class BlacklistResponse extends BaseResponse
{

    /**
     * @param Blacklist|Blacklist[] $data
     * @param ApiResponse           $response
     */
    public function __construct(Blacklist|array $data, ApiResponse $response)
    {
        parent::__construct($data, $response);
    }

    /**
     * @return Blacklist|Blacklist[]
     */
    public function getData(): Blacklist|array
    {
        return $this->data;
    }
}