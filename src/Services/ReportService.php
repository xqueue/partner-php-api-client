<?php

namespace Xqueue\MaileonPartnerApiClient\Services;

use CuyZ\Valinor\Mapper\MappingError;
use Xqueue\MaileonPartnerApiClient\Entities\ReportCheck;
use Xqueue\MaileonPartnerApiClient\Entities\ReportCSA;
use Xqueue\MaileonPartnerApiClient\Http\Responses\ReportCheckResponse;
use Xqueue\MaileonPartnerApiClient\Http\Responses\ReportCSAResponse;

class ReportService extends PartnerApiService
{

    /**
     * @return ReportCheckResponse
     * @throws MappingError
     */
    public function getReportChecks(): ReportCheckResponse
    {
        $response = $this->getList('distributor/reports/checks', ReportCheck::class);

        return new ReportCheckResponse($response['data'], $response['response']);
    }

    /**
     * @return ReportCSAResponse
     * @throws MappingError
     */
    public function getReportCSAs(): ReportCSAResponse
    {
        $response = $this->getList('distributor/reports/csa', ReportCSA::class);

        return new ReportCSAResponse($response['data'], $response['response']);
    }
}