<?php

namespace Xqueue\MaileonPartnerApiClient\Entities;

class Product
{

    public const KEY = 'products';

    public string $name;
    public bool $active;
    public bool $timeRestricted;
    public ?string $expirationTime;

    /**
     * @param string $name
     * @param bool $active
     * @param bool $timeRestricted
     * @param string|null $expirationTime
     */
    public function __construct(
        string  $name,
        bool    $active,
        bool    $timeRestricted,
        ?string $expirationTime
    )
    {
        $this->name = $name;
        $this->active = $active;
        $this->timeRestricted = $timeRestricted;
        $this->expirationTime = $expirationTime;
    }
}