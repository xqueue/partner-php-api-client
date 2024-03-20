<?php

namespace Xqueue\MaileonPartnerApiClient\Tests\Integrations;


use Xqueue\MaileonPartnerApiClient\Http\Responses\WebhookResponse;
use Xqueue\MaileonPartnerApiClient\Services\WebhookService;
use Xqueue\MaileonPartnerApiClient\Tests\TestCase;

class WebhookServiceTest extends TestCase
{

    protected WebhookService $webhookService;
    protected int $nlAccountId;

    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->webhookService = new WebhookService(getenv('MAILEON_PARTNER_API_KEY'));
        $this->nlAccountId = $this->getOneNewsLetterAccount()->id;
    }

    public function test_get_webhooks_success()
    {
        $response = $this->webhookService->getWebhooks($this->nlAccountId);

        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), WebhookResponse::class);
        $this->assertIsArray($response->getData());
    }

}