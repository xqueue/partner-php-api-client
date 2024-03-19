<?php

namespace Xqueue\MaileonPartnerApiClient\Entities;

class AccountStatus
{

    private string $name;
    private string $new_status;
    private int $id;

    /**
     * @param string $name
     * @param string $new_status
     * @param int $id
     */
    public function __construct(
        string $name,
        string $new_status,
        int    $id
    )
    {
        $this->name = $name;
        $this->new_status = $new_status;
        $this->id = $id;
    }
}