<?php

namespace Xqueue\MaileonPartnerApiClient\Tests\Integrations;


use Xqueue\MaileonPartnerApiClient\Http\Responses\GeneralResponse;
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
        $this->webhookService = new WebhookService(['API_KEY' => getenv('MAILEON_PARTNER_API_KEY')]);
        $this->nlAccountId = $this->getOneNewsLetterAccount()->id;
    }

    public function test_get_webhooks_success(): void
    {
        $response = $this->webhookService->getWebhooks($this->nlAccountId);

        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), WebhookResponse::class);
        $this->assertIsArray($response->getData());
    }

    public function test_create_webhook_success(): void
    {
        $response = $this->webhookService->createWebhook(
            $this->nlAccountId,
            'doi',
            2,
            'http://xqueue.com/someWebhookForDoi',
            [
                ['customContactField' => 3, 'name' => 'test']
            ]
        );

        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), GeneralResponse::class);
    }

    public function test_show_webhook_success(): void
    {
        $list = $this->webhookService->getWebhooks($this->nlAccountId);
        $firstWebhook = $list->getData()[0];

        $response = $this->webhookService->getWebhook($this->nlAccountId, $firstWebhook->id);

        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), WebhookResponse::class);
    }

    public function test_delete_webhook_success(): void
    {
        $list = $this->webhookService->getWebhooks($this->nlAccountId);
        $firstWebhook = $list->getData()[0];

        $response = $this->webhookService->deleteWebhook($this->nlAccountId, $firstWebhook->id);

        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), GeneralResponse::class);
    }
}