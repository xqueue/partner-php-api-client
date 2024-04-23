<?php

namespace Xqueue\MaileonPartnerApiClient\Entities;

use Xqueue\MaileonPartnerApiClient\Traits\MappingTrait;

class Webhook
{

    use MappingTrait;

    public int $id;
    public string $event;
    public string $url;
    public int $nlAccountId;
    public array $bodySpec;
    public array $urlParams;

    /**
     * @param int $id
     * @param string $event
     * @param string $url
     * @param int $nlAccountId
     * @param WebhookBodySpec[] $bodySpec
     * @param WebhookUrlParam[] $urlParams
     */
    public function __construct(
        int    $id,
        string $event,
        string $url,
        int    $nlAccountId,
        /** @var WebhookBodySpec */
        array  $bodySpec = [new WebhookBodySpec()],
        /** @var WebhookUrlParam */
        array  $urlParams = [new WebhookUrlParam('', '')],
    )
    {
        $this->id = $id;
        $this->event = $event;
        $this->url = $url;
        $this->nlAccountId = $nlAccountId;
        $this->urlParams = $urlParams;
        $this->bodySpec = $bodySpec;
    }
}