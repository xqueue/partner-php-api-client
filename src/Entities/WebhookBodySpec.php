<?php

namespace Xqueue\MaileonPartnerApiClient\Entities;

class WebhookBodySpec
{

    public array $standardFields;
    public array $customFields;

    /**
     * @param string[] $standardFields
     * @param string[] $customFields
     */
    public function __construct(?array $standardFields = [], ?array $customFields = [])
    {
        $this->standardFields = $standardFields;
        $this->customFields = $customFields;
    }
}