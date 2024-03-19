<?php

namespace Xqueue\MaileonPartnerApiClient\Http\Responses;

use Xqueue\MaileonPartnerApiClient\Entities\SMSReport;
use Xqueue\MaileonPartnerApiClient\Http\ApiResponse;

class SMSReportResponse extends BaseResponse
{

    /**
     * @param SMSReport|SMSReport[] $data
     * @param ApiResponse $response
     */
    public function __construct(SMSReport|array $data, ApiResponse $response)
    {
        parent::__construct($data, $response);
    }

    /**
     * @return SMSReport|SMSReport[]
     */
    public  function getData(): SMSReport|array
    {
        return $this->data;
    }
}