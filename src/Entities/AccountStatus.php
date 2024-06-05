<?php

namespace Xqueue\MaileonPartnerApiClient\Entities;

class AccountStatus
{

    public int    $id;
    public string $name;
    public string $new_status;

    /**
     * @param int    $id
     * @param string $name
     * @param string $new_status
     */
    public function __construct(
        int    $id,
        string $name,
        string $new_status,
    ) {
        $this->id         = $id;
        $this->name       = $name;
        $this->new_status = $new_status;
    }
}