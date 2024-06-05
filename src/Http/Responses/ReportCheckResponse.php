<?php

namespace Xqueue\MaileonPartnerApiClient\Http\Responses;

use Xqueue\MaileonPartnerApiClient\Entities\ReportCheck;
use Xqueue\MaileonPartnerApiClient\Http\ApiResponse;

class ReportCheckResponse extends BaseResponse
{

    /**
     * @param ReportCheck|ReportCheck[] $data
     * @param ApiResponse               $response
     */
    public function __construct(ReportCheck|array $data, ApiResponse $response)
    {
        parent::__construct($data, $response);
    }

    /**
     * @return ReportCheck|ReportCheck[]
     */
    public function getData(): ReportCheck|array
    {
        return $this->data;
    }
}