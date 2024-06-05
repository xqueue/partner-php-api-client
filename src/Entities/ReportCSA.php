<?php

namespace Xqueue\MaileonPartnerApiClient\Entities;

class ReportCSA
{

    public const KEY = 'csa_report';
    public string $date;
    public int    $distributorAccountId;
    public int    $newsletterAccountId;
    public string $newsletterAccountName;
    public string $distributorAccountName;
    public int    $customerAccountId;
    public int    $fbls;
    public string $fblsRatio;
    public int    $opensUnique;
    public string $opensUniqueRatio;
    public int    $spamTraps;
    public int    $spamClicksRatio;
    public string $subdomain;

    /**
     * @param string $date
     * @param int    $distributorAccountId
     * @param int    $newsletterAccountId
     * @param string $newsletterAccountName
     * @param string $distributorAccountName
     * @param int    $customerAccountId
     * @param int    $fbls
     * @param string $fblsRatio
     * @param int    $opensUnique
     * @param string $opensUniqueRatio
     * @param int    $spamTraps
     * @param int    $spamClicksRatio
     * @param string $subdomain
     */
    public function __construct(
        string $date,
        int    $distributorAccountId,
        int    $newsletterAccountId,
        string $newsletterAccountName,
        string $distributorAccountName,
        int    $customerAccountId,
        int    $fbls,
        string $fblsRatio,
        int    $opensUnique,
        string $opensUniqueRatio,
        int    $spamTraps,
        int    $spamClicksRatio,
        string $subdomain
    ) {
        $this->date                   = $date;
        $this->distributorAccountId   = $distributorAccountId;
        $this->newsletterAccountId    = $newsletterAccountId;
        $this->newsletterAccountName  = $newsletterAccountName;
        $this->distributorAccountName = $distributorAccountName;
        $this->customerAccountId      = $customerAccountId;
        $this->fbls                   = $fbls;
        $this->fblsRatio              = $fblsRatio;
        $this->opensUnique            = $opensUnique;
        $this->opensUniqueRatio       = $opensUniqueRatio;
        $this->spamTraps              = $spamTraps;
        $this->spamClicksRatio        = $spamClicksRatio;
        $this->subdomain              = $subdomain;
    }

}