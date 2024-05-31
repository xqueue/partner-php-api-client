<?php

namespace Xqueue\MaileonPartnerApiClient\Services;

use CuyZ\Valinor\Mapper\MappingError;
use Exception;
use Xqueue\MaileonPartnerApiClient\Entities\Job;
use Xqueue\MaileonPartnerApiClient\Entities\MailingDomain;
use Xqueue\MaileonPartnerApiClient\Entities\NewsletterAccount;
use Xqueue\MaileonPartnerApiClient\Entities\Product;
use Xqueue\MaileonPartnerApiClient\Http\Request;
use Xqueue\MaileonPartnerApiClient\Http\ApiResponse;
use Xqueue\MaileonPartnerApiClient\Http\Responses\GeneralResponse;
use Xqueue\MaileonPartnerApiClient\Http\Responses\JobResponse;
use Xqueue\MaileonPartnerApiClient\Http\Responses\MailingDomainResponse;
use Xqueue\MaileonPartnerApiClient\Http\Responses\NewsletterAccountResponse;
use Xqueue\MaileonPartnerApiClient\Http\Responses\ProductResponse;

class JobService extends PartnerApiService
{

    /**
     * @return JobResponse
     * @throws MappingError
     */
    public function getJobs(): JobResponse
    {
        $response = $this->getList('account-jobs', Job::class, Job::KEY);

        return new JobResponse($response['data'], $response['response']);
    }

    /**
     * @param int $id
     * @return JobResponse
     * @throws MappingError
     */
    public function getJobById(int $id): JobResponse
    {
        $response = $this->getOne('account-jobs', $id, Job::class);

        return new JobResponse($response['data'], $response['response']);
    }

    /**
     * @param string $locale
     * @param string $type
     * @param string $author
     * @param bool|null $customDns
     * @param int|null $accountTemplateId
     * @param array|null $users
     * @param int|null $customerAccountId
     * @param string|null $customerAccountName
     * @param string|null $newsletterAccountName
     * @param string|null $customDomain
     * @param string|null $providedDomain
     * @param string|null $subdomain
     * @param bool|null $domainAsLogin
     * @return GeneralResponse
     */
    public function createAccountJob(
        string  $locale,
        string  $type,
        string  $author,
        string $customerAccountName,
        string $newsletterAccountName,
        ?string $customDomain = null,
        ?string $providedDomain = null,
        ?string $subdomain = null,
        ?bool   $customDns = null,
        ?int    $accountTemplateId = null,
        ?array  $users = null,
        ?int    $customerAccountId = null,
        ?bool   $domainAsLogin = null
    ): GeneralResponse
    {
        $data = [
            'locale' => $locale,
            'type' => $type,
            'author' => $author,
            'customDns' => $customDns,
            'accountTemplateId' => $accountTemplateId,
            'users' => $users,
            'customerAccountId' => $customerAccountId,
            'customerAccountName' => $customerAccountName,
            'newsletterAccountName' => $newsletterAccountName,
            'customDomain' => $customDomain,
            'providedDomain' => $providedDomain,
            'subdomain' => $subdomain,
            'domainAsLogin' => $domainAsLogin,
        ];

        $response = $this->create('account-jobs', $data);

        return new GeneralResponse($response['data'], $response['response']);
    }
}