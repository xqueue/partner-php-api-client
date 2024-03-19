<?php

namespace Xqueue\MaileonPartnerApiClient\Http\Responses;

use Xqueue\MaileonPartnerApiClient\Entities\NewsletterAccount;
use Xqueue\MaileonPartnerApiClient\Http\ApiResponse;

class NewsletterAccountResponse extends BaseResponse
{

    /**
     * @param NewsletterAccount|NewsletterAccount[] $data
     * @param ApiResponse $response
     */
    public function __construct(NewsletterAccount|array $data, ApiResponse $response)
    {
        parent::__construct($data, $response);
    }

    /**
     * @return NewsletterAccount|NewsletterAccount[]
     */
    public function getData(): NewsletterAccount|array
    {
        return $this->data;
    }
}