<?php

namespace Xqueue\MaileonPartnerApiClient\Http\Responses;

use Xqueue\MaileonPartnerApiClient\Entities\Webhook;
use Xqueue\MaileonPartnerApiClient\Http\ApiResponse;

class WebhookResponse extends BaseResponse
{

    /**
     * @param Webhook|Webhook[] $data
     * @param ApiResponse $response
     */
    public function __construct(Webhook|array $data, ApiResponse $response)
    {
        parent::__construct($data, $response);
    }

    /**
     * @return Webhook|Webhook[]
     */
    public  function getData(): Webhook|array
    {
        return $this->data;
    }
}