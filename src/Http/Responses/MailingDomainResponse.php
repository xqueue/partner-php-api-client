<?php

namespace Xqueue\MaileonPartnerApiClient\Http\Responses;

use Xqueue\MaileonPartnerApiClient\Entities\MailingDomain;
use Xqueue\MaileonPartnerApiClient\Http\ApiResponse;

class MailingDomainResponse extends BaseResponse
{

    /**
     * @param MailingDomain|MailingDomain[] $data
     * @param ApiResponse                   $response
     */
    public function __construct(MailingDomain|array $data, ApiResponse $response)
    {
        parent::__construct($data, $response);
    }

    /**
     * @return MailingDomain|MailingDomain[]
     */
    public function getData(): MailingDomain|array
    {
        return $this->data;
    }
}