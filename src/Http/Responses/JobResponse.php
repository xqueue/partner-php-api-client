<?php

namespace Xqueue\MaileonPartnerApiClient\Http\Responses;

use Xqueue\MaileonPartnerApiClient\Entities\Job;
use Xqueue\MaileonPartnerApiClient\Http\ApiResponse;

class JobResponse extends BaseResponse
{

    /**
     * @param Job|Job[]   $data
     * @param ApiResponse $response
     */
    public function __construct(Job|array $data, ApiResponse $response)
    {
        parent::__construct($data, $response);
    }

    /**
     * @return Job|Job[]
     */
    public function getData(): Job|array
    {
        return $this->data;
    }
}