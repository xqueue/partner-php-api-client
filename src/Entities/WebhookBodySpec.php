<?php

namespace Xqueue\MaileonPartnerApiClient\Entities;

class WebhookBodySpec
{

    public array $standardFields;
    public array $customFields;

    /**
     * @param array $standardFields
     * @param array $customFields
     */
    public function __construct(array $standardFields, array $customFields)
    {
        $this->standardFields = $standardFields;
        $this->customFields = $customFields;
    }
}