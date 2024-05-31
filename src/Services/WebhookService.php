<?php

namespace Xqueue\MaileonPartnerApiClient\Services;

use CuyZ\Valinor\Mapper\MappingError;
use Xqueue\MaileonPartnerApiClient\Entities\Webhook;
use Xqueue\MaileonPartnerApiClient\Http\Request;
use Xqueue\MaileonPartnerApiClient\Http\Responses\GeneralResponse;
use Xqueue\MaileonPartnerApiClient\Http\Responses\WebhookResponse;

class WebhookService extends PartnerApiService
{

    /**
     * @param int $newsletterAccountId
     * @return WebhookResponse
     * @throws MappingError
     */
    public function getWebhooks(int $newsletterAccountId): WebhookResponse
    {
        $response = $this->getList(
            'settings/webhooks',
            Webhook::class,
            null,
            ['nl_account_id' => $newsletterAccountId]
        );

        return new WebhookResponse($response['data'], $response['response']);
    }

    /**
     * @param int $newsletterAccountId
     * @param string $event
     * @param int $id
     * @param string $url
     * @param array $urlParams
     * @return GeneralResponse
     */
    public function createWebhook(
        int    $newsletterAccountId,
        string $event,
        int    $id,
        string $url,
        array  $urlParams
    ): GeneralResponse
    {
        $response = $this->create(
            'settings/webhooks',
            [
                'id' => $id,
                'event' => $event,
                'url' => $url,
                'urlParams' => $urlParams
            ],
            ['nl_account_id' => $newsletterAccountId]
        );

        return new GeneralResponse($response['data'], $response['response']);
    }

    /**
     * @param int $newsletterAccountId
     * @param int $webhookId
     * @return WebhookResponse
     * @throws MappingError
     */
    public function getWebhook(int $newsletterAccountId, int $webhookId): WebhookResponse
    {
        $response = $this->getOne(
            'settings/webhooks',
            $webhookId,
            Webhook::class,
            ['nl_account_id' => $newsletterAccountId]
        );

        return new WebhookResponse($response['data'], $response['response']);
    }

    /**
     * @param int $newsletterAccountId
     * @param int $webhookId
     * @return GeneralResponse
     */
    public function deleteWebhook(int $newsletterAccountId, int $webhookId): GeneralResponse
    {
        $response = Request::send(
            'DELETE',
            'settings/webhooks/' . $webhookId,
            ['nl_account_id' => $newsletterAccountId],
            [],
            $this->key
        );

        return new GeneralResponse($response->body, $response);
    }
}