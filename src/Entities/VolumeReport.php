<?php

namespace Xqueue\MaileonPartnerApiClient\Entities;

class VolumeReport
{
    public int $distributorAccountId;
    public string $distributorAccountName;
    public int $customerAccountId;
    public string $customerAccountName;
    public int $newsletterAccountId;
    public string $newsletterAccountName;
    public string $status;
    public int $volume;
    public int $regular;
    public int $trigger;
    public int $doi;

    /**
     * @param int $distributorAccountId
     * @param string $distributorAccountName
     * @param int $customerAccountId
     * @param string $customerAccountName
     * @param int $newsletterAccountId
     * @param string $newsletterAccountName
     * @param string $status
     * @param int $volume
     * @param int $regular
     * @param int $trigger
     * @param int $doi
     */
    public function __construct(
    int $distributorAccountId,
    string $distributorAccountName,
    int $customerAccountId,
    string $customerAccountName,
    int $newsletterAccountId,
    string $newsletterAccountName,
    string $status,
    int $volume,
    int $regular,
    int $trigger,
    int $doi
)
{
    $this->distributorAccountId = $distributorAccountId;
    $this->distributorAccountName = $distributorAccountName;
    $this->customerAccountId = $customerAccountId;
    $this->customerAccountName = $customerAccountName;
    $this->newsletterAccountId = $newsletterAccountId;
    $this->newsletterAccountName = $newsletterAccountName;
    $this->status = $status;
    $this->volume = $volume;
    $this->regular = $regular;
    $this->trigger = $trigger;
    $this->doi = $doi;
}
}