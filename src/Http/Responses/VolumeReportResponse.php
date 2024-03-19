<?php

namespace Xqueue\MaileonPartnerApiClient\Http\Responses;

use Xqueue\MaileonPartnerApiClient\Entities\VolumeReport;
use Xqueue\MaileonPartnerApiClient\Http\ApiResponse;

class VolumeReportResponse extends BaseResponse
{

    /**
     * @param VolumeReport|VolumeReport[] $data
     * @param ApiResponse $response
     */
    public function __construct(VolumeReport|array $data, ApiResponse $response)
    {
        parent::__construct($data, $response);
    }

    /**
     * @return VolumeReport|VolumeReport[]
     */
    public  function getData(): VolumeReport|array
    {
        return $this->data;
    }
}