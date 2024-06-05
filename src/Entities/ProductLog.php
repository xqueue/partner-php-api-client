<?php

namespace Xqueue\MaileonPartnerApiClient\Entities;

class ProductLog
{

    public const KEY = 'logs';
    public string  $event;
    public string  $createdUser;
    public string  $createdTime;
    public ?string $details;

    /**
     * @param string      $event
     * @param string      $createdUser
     * @param string      $createdTime
     * @param string|null $details
     */
    public function __construct(
        string  $event,
        string  $createdUser,
        string  $createdTime,
        ?string $details = null,
    ) {
        $this->event       = $event;
        $this->createdUser = $createdUser;
        $this->createdTime = $createdTime;
        $this->details     = $details;
    }
}