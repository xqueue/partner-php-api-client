<?php

namespace Xqueue\MaileonPartnerApiClient\Entities;

class Contingent
{

    public int    $id;
    public string $author;
    public string $created;
    public string $name;
    public string $expiryDate;
    public int    $contingentValue;
    public int    $availableValue;
    public int    $newsletterAccountId;
    public int    $usedValue;
    public string $updated;
    public string $status;

    /**
     * @param int    $id
     * @param string $author
     * @param string $created
     * @param string $name
     * @param string $expiryDate
     * @param int    $contingentValue
     * @param int    $availableValue
     * @param int    $newsletterAccountId
     * @param int    $usedValue
     * @param string $updated
     * @param string $status
     */
    public function __construct(
        int    $id,
        string $author,
        string $created,
        string $name,
        string $expiryDate,
        int    $contingentValue,
        int    $availableValue,
        int    $newsletterAccountId,
        int    $usedValue,
        string $updated,
        string $status,
    ) {
        $this->id                  = $id;
        $this->author              = $author;
        $this->created             = $created;
        $this->name                = $name;
        $this->expiryDate          = $expiryDate;
        $this->contingentValue     = $contingentValue;
        $this->availableValue      = $availableValue;
        $this->newsletterAccountId = $newsletterAccountId;
        $this->usedValue           = $usedValue;
        $this->updated             = $updated;
        $this->status              = $status;
    }

}