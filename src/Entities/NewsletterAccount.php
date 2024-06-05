<?php

namespace Xqueue\MaileonPartnerApiClient\Entities;

/**
 * @property string $locale
 */
class NewsletterAccount
{

    public const KEY = 'newsletterAccounts';

    public int    $id;
    public string $name;
    public string $type;
    public string $status;
    public int    $distributorAccountId;
    public string $distributorAccountName;
    public string $createdTime;
    public string $createdUser;
    public int    $customerAccountId;
    public string $mailingDomain;
    public string $locale;
    public string $subdomain;
    public string $customerAccountName;

    /**
     * @param int    $id
     * @param string $name
     * @param string $type
     * @param string $status
     * @param int    $distributorAccountId
     * @param string $distributorAccountName
     * @param string $createdTime
     * @param string $createdUser
     * @param int    $customerAccountId
     * @param string $customerAccountName
     * @param string $mailingDomain
     * @param string $locale
     * @param string $subdomain
     */
    public function __construct(
        int    $id,
        string $name,
        string $type,
        string $status,
        int    $distributorAccountId,
        string $distributorAccountName,
        string $createdTime,
        string $createdUser,
        int    $customerAccountId,
        string $customerAccountName,
        string $mailingDomain,
        string $locale,
        string $subdomain
    ) {
        $this->id                     = $id;
        $this->name                   = $name;
        $this->type                   = $type;
        $this->status                 = $status;
        $this->distributorAccountId   = $distributorAccountId;
        $this->distributorAccountName = $distributorAccountName;
        $this->createdTime            = $createdTime;
        $this->createdUser            = $createdUser;
        $this->customerAccountId      = $customerAccountId;
        $this->mailingDomain          = $mailingDomain;
        $this->locale                 = $locale;
        $this->subdomain              = $subdomain;
        $this->customerAccountName    = $customerAccountName;
    }
}