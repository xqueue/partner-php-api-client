<?php

namespace Xqueue\MaileonPartnerApiClient\Entities;

class ApiKey
{
    public string $apiKey;
    public string $expiration;

    /**
     * @param string $apiKey
     * @param string $expiration
     */
    public function __construct(string $apiKey, string $expiration)
    {
        $this->apiKey     = $apiKey;
        $this->expiration = $expiration;
    }
}