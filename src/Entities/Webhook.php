<?php

namespace Xqueue\MaileonPartnerApiClient\Entities;

use CuyZ\Valinor\Mapper\MappingError;
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
        array  $bodySpec,
        array  $urlParams,
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