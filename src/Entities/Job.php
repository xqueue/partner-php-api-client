<?php

namespace Xqueue\MaileonPartnerApiClient\Entities;

class Job
{
    public const KEY = 'jobs';
    public string $job_type;
    public int $id;
    public string $status;
    public string $newsletterAccountName;
    public string $createdUser;
    public string $createdTime;
    public ?int $account_id;
    public ?int $customer_id;
    public ?string $domain;
    private string $locale;

    /**
     * @param string $job_type
     * @param int $id
     * @param string $status
     * @param string $newsletterAccountName
     * @param string $createdUser
     * @param string $createdTime
     * @param string|null $locale
     * @param int|null $account_id
     * @param int|null $customer_id
     * @param string|null $domain
     */
    public function __construct(
        string  $job_type,
        int     $id,
        string  $status,
        string  $newsletterAccountName,
        string  $createdUser,
        string  $createdTime,
        ?string $locale = '',
        ?int    $account_id = null,
        ?int    $customer_id = null,
        ?string $domain = ''
    )
    {
        $this->job_type = $job_type;
        $this->id = $id;
        $this->status = $status;
        $this->newsletterAccountName = $newsletterAccountName;
        $this->createdUser = $createdUser;
        $this->createdTime = $createdTime;
        $this->account_id = $account_id;
        $this->customer_id = $customer_id;
        $this->domain = $domain;
        $this->locale = $locale;
    }
}