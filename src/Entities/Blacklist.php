<?php

namespace Xqueue\MaileonPartnerApiClient\Entities;

class Blacklist
{
    public int $id;
    public string $name;
    public string $type;
    public string $status;
    public string $created;

    /**
     * @param int $id
     * @param string $name
     * @param string $type
     * @param string $status
     * @param string $created
     */
    public function __construct(
        int    $id,
        string $name,
        string $type,
        string $status,
        string $created
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->status = $status;
        $this->created = $created;
    }
}