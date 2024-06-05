<?php

namespace Xqueue\MaileonPartnerApiClient\Tests\Integrations;

use Xqueue\MaileonPartnerApiClient\Http\Responses\ReportCheckResponse;
use Xqueue\MaileonPartnerApiClient\Http\Responses\ReportCSAResponse;
use Xqueue\MaileonPartnerApiClient\Services\ReportService;
use Xqueue\MaileonPartnerApiClient\Tests\TestCase;

class ReportServiceTest extends TestCase
{

    protected ReportService $reportService;

    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->reportService = new ReportService(['API_KEY' => getenv('MAILEON_PARTNER_API_KEY')]);
    }

    public function test_get_report_checks_success(): void
    {
        $response = $this->reportService->getReportChecks();

        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), ReportCheckResponse::class);
        $this->assertIsArray($response->getData());
    }

    public function test_get_report_csa_success(): void
    {
        $response = $this->reportService->getReportCSAs();

        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), ReportCSAResponse::class);
        $this->assertIsArray($response->getData());
    }
}