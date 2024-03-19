<?php

namespace Xqueue\MaileonPartnerApiClient\Entities;

class Webhook
{

    public int $id;
    public string $event;
    public string $url;
    public array $urlParams;

    /**
     * @param int $id
     * @param string $event
     * @param string $url
     * @param array $urlParams
     */
    public function __construct(
        int    $id,
        string $event,
        string $url,
        array  $urlParams,

    )
    {
        $this->id = $id;
        $this->event = $event;
        $this->url = $url;
        $this->urlParams = $urlParams;
    }
}