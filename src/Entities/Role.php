<?php

namespace Xqueue\MaileonPartnerApiClient\Entities;

class Role
{

    public int    $id;
    public string $name;
    public bool   $selected;
    public bool   $custom;
    public int    $userCount;

    /**
     * @param int    $id
     * @param string $name
     * @param bool   $selected
     * @param bool   $custom
     * @param int    $userCount
     */
    public function __construct(
        int    $id,
        string $name,
        bool   $selected,
        bool   $custom,
        int    $userCount
    ) {
        $this->id        = $id;
        $this->name      = $name;
        $this->selected  = $selected;
        $this->custom    = $custom;
        $this->userCount = $userCount;
    }
}