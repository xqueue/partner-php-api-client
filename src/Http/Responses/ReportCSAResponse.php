<?php

namespace Xqueue\MaileonPartnerApiClient\Http\Responses;

use Xqueue\MaileonPartnerApiClient\Entities\ReportCSA;
use Xqueue\MaileonPartnerApiClient\Http\ApiResponse;

class ReportCSAResponse extends BaseResponse
{

    /**
     * @param ReportCSA|ReportCSA[] $data
     * @param ApiResponse           $response
     */
    public function __construct(ReportCSA|array $data, ApiResponse $response)
    {
        parent::__construct($data, $response);
    }

    /**
     * @return ReportCSA|ReportCSA[]
     */
    public function getData(): ReportCSA|array
    {
        return $this->data;
    }
}