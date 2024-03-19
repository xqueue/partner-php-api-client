<?php

namespace Xqueue\MaileonPartnerApiClient\Entities;

class SMSReport
{

    public int $distributorAccountId;
    public string $distributorAccountName;
    public int $customerAccountId;
    public string $customerAccountName;
    public int $newsletterAccountId;
    public string $newsletterAccountName;
    public string $sentDate;
    public int $smsCount;

    /**
     * @param int $distributorAccountId
     * @param string $distributorAccountName
     * @param int $customerAccountId
     * @param string $customerAccountName
     * @param int $newsletterAccountId
     * @param string $newsletterAccountName
     * @param string $sentDate
     * @param int $smsCount
     */
    public function __construct(
        int    $distributorAccountId,
        string $distributorAccountName,
        int    $customerAccountId,
        string $customerAccountName,
        int    $newsletterAccountId,
        string $newsletterAccountName,
        string $sentDate,
        int    $smsCount
    )
    {
        $this->distributorAccountId = $distributorAccountId;
        $this->distributorAccountName = $distributorAccountName;
        $this->customerAccountId = $customerAccountId;
        $this->customerAccountName = $customerAccountName;
        $this->newsletterAccountId = $newsletterAccountId;
        $this->newsletterAccountName = $newsletterAccountName;
        $this->sentDate = $sentDate;
        $this->smsCount = $smsCount;
    }
}