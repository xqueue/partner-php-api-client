<?php

namespace Xqueue\MaileonPartnerApiClient\Entities;

class WebhookUrlParam
{

    public string $name;
    public string $customValue;

    /**
     * @param string $name
     * @param string $customValue
     */
    public function __construct(string $name, string $customValue)
    {
        $this->name = $name;
        $this->customValue = $customValue;
    }

}