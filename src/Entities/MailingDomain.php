<?php

namespace Xqueue\MaileonPartnerApiClient\Entities;

class MailingDomain
{

    public string $name;
    public string $status;
    public string $createdTime;
    private string $certificate_expires;
    public ?bool $http_reachable;
    public ?bool $https_reachable;

    /**
     * @param string $name
     * @param string $status
     * @param string $createdTime
     * @param string $certificate_expires
     * @param bool|null $http_reachable
     * @param bool|null $https_reachable
     */
    public function __construct(
        string $name,
        string $status,
        string $createdTime,
        string $certificate_expires,
        ?bool  $http_reachable,
        ?bool  $https_reachable,
    )
    {
        $this->name = $name;
        $this->status = $status;
        $this->createdTime = $createdTime;
        $this->http_reachable = $http_reachable;
        $this->https_reachable = $https_reachable;
        $this->certificate_expires = $certificate_expires;
    }
}