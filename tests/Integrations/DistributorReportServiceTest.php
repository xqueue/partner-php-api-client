<?php

namespace Xqueue\MaileonPartnerApiClient\Tests\Integrations;

use Xqueue\MaileonPartnerApiClient\Http\Responses\SMSReportResponse;
use Xqueue\MaileonPartnerApiClient\Http\Responses\VolumeReportResponse;
use Xqueue\MaileonPartnerApiClient\Services\DistributorReportService;
use Xqueue\MaileonPartnerApiClient\Tests\TestCase;

class DistributorReportServiceTest extends TestCase
{

    protected DistributorReportService $reportService;
    protected int $nlAccountId;
    protected int $customerAccountId;

    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->reportService = new DistributorReportService(getenv('MAILEON_PARTNER_API_KEY'));
        $this->nlAccountId = $this->getOneNewsLetterAccount()->id;
        $this->customerAccountId = $this->getOneCustomerAccount()->id;
    }

    public function test_get_sms_report_success(): void
    {
        $now = now();
        $response = $this->reportService->getSMSReport(
            $now->subMonths(6)->format('Y-m-d\TH:i:sO'),
            $now->addMonths(3)->format('Y-m-d\TH:i:sO'),
            1,
            10,
            $this->nlAccountId,
            1
        );

        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), SMSReportResponse::class);
        $this->assertIsArray($response->getData());
    }

    public function test_get_volume_report_success(): void
    {
        $now = now();
        $response = $this->reportService->getVolumeReport(
            $now->subMonths(6)->format('Y-m-d\TH:i:sO'),
            $now->addMonths(3)->format('Y-m-d\TH:i:sO'),
            1,
            10,
            $this->nlAccountId,
            $this->customerAccountId,
        );

        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), VolumeReportResponse::class);
        $this->assertIsArray($response->getData());
    }
}