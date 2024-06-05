<?php

namespace Xqueue\MaileonPartnerApiClient\Entities;

class ReportCheck
{
    public const KEY = 'checks';
    public int    $distributorAccountId;
    public string $distributorAccountName;
    public int    $customerAccountId;
    public string $customerAccountName;
    public int    $newsletterAccountId;
    public string $newsletterAccountName;
    public int    $mailingId;
    public string $nameOfCheck;
    public string $created;

    /**
     * @param int    $distributorAccountId
     * @param string $distributorAccountName
     * @param int    $customerAccountId
     * @param string $customerAccountName
     * @param int    $newsletterAccountId
     * @param string $newsletterAccountName
     * @param int    $mailingId
     * @param string $nameOfCheck
     * @param string $created
     */
    public function __construct(
        int    $distributorAccountId,
        string $distributorAccountName,
        int    $customerAccountId,
        string $customerAccountName,
        int    $newsletterAccountId,
        string $newsletterAccountName,
        int    $mailingId,
        string $nameOfCheck,
        string $created
    ) {
        $this->distributorAccountId   = $distributorAccountId;
        $this->distributorAccountName = $distributorAccountName;
        $this->customerAccountId      = $customerAccountId;
        $this->customerAccountName    = $customerAccountName;
        $this->newsletterAccountId    = $newsletterAccountId;
        $this->newsletterAccountName  = $newsletterAccountName;
        $this->mailingId              = $mailingId;
        $this->nameOfCheck            = $nameOfCheck;
        $this->created                = $created;
    }

}