<?php

namespace Xqueue\MaileonPartnerApiClient\Tests\Integrations;

use Xqueue\MaileonPartnerApiClient\Http\Responses\GeneralResponse;
use Xqueue\MaileonPartnerApiClient\Services\GeneralService;
use Xqueue\MaileonPartnerApiClient\Tests\TestCase;

class GeneralServiceTest extends TestCase
{

    private GeneralService $generalService;

    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->generalService = new GeneralService(getenv('MAILEON_PARTNER_API_KEY'));
    }

    public function test_get_locales_success(): void
    {
        $response = $this->generalService->getLocales();

        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), GeneralResponse::class);
        $this->assertIsArray($response->getData());
    }

    public function test_get_domains_success(): void
    {
        $response = $this->generalService->getDomains();

        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), GeneralResponse::class);
        $this->assertIsArray($response->getData());
    }

    public function test_validate_domain_success(): void
    {
        $response = $this->generalService->validateDomain('test.customer.com');
        $responseData = $response->getData();

        $this->assertSame(get_class($response), GeneralResponse::class);
        $this->assertIsArray($responseData);
        $this->assertIsBool($responseData['isSuccess']);
    }
}