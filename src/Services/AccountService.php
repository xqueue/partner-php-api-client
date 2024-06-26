<?php

namespace Xqueue\MaileonPartnerApiClient\Services;

use CuyZ\Valinor\Mapper\MappingError;
use Xqueue\MaileonPartnerApiClient\Entities\AccountStatus;
use Xqueue\MaileonPartnerApiClient\Entities\ApiKey;
use Xqueue\MaileonPartnerApiClient\Entities\CustomerAccount;
use Xqueue\MaileonPartnerApiClient\Entities\MailingDomain;
use Xqueue\MaileonPartnerApiClient\Entities\NewsletterAccount;
use Xqueue\MaileonPartnerApiClient\Http\Responses\AccountStatusResponse;
use Xqueue\MaileonPartnerApiClient\Http\Responses\ApiKeyResponse;
use Xqueue\MaileonPartnerApiClient\Http\Responses\CustomerAccountResponse;
use Xqueue\MaileonPartnerApiClient\Http\Responses\GeneralResponse;
use Xqueue\MaileonPartnerApiClient\Http\Responses\MailingDomainResponse;
use Xqueue\MaileonPartnerApiClient\Http\Responses\NewsletterAccountResponse;

class AccountService extends PartnerApiService
{
    /**
     * @param string|null $createdSince
     * @param string|null $createdUntil
     * @param int|null    $distributorAccountId
     * @param bool|null   $includeSubpartners
     *
     * @return NewsletterAccountResponse
     * @throws MappingError
     */
    public function getNewsletterAccounts(
        ?string $createdSince = null,
        ?string $createdUntil = null,
        ?int    $distributorAccountId = null,
        ?bool   $includeSubpartners = false
    ): NewsletterAccountResponse {
        $queryParams = $this->getQueryParams($createdSince, $createdUntil, $distributorAccountId, $includeSubpartners);

        $response = $this->getList(
            'newsletter-accounts',
            NewsletterAccount::class,
            NewsletterAccount::KEY,
            $queryParams
        );

        return new NewsletterAccountResponse($response['data'], $response['response']);
    }

    /**
     * @param string|null $createdSince
     * @param string|null $createdUntil
     * @param int|null    $distributorAccountId
     * @param bool|null   $includeSubpartners
     *
     * @return array
     */
    private function getQueryParams(
        ?string $createdSince = null,
        ?string $createdUntil = null,
        ?int    $distributorAccountId = null,
        ?bool   $includeSubpartners = false
    ): array {
        return [
            'createdSince'         => $createdSince,
            'createdUntil'         => $createdUntil,
            'distributorAccountId' => $distributorAccountId,
            'includeSubpartners'   => $includeSubpartners,
        ];
    }

    /**
     * @param string|null $createdSince
     * @param string|null $createdUntil
     * @param int|null    $distributorAccountId
     * @param bool|null   $includeSubpartners
     *
     * @return GeneralResponse
     */
    public function getNewsletterAccountsCount(
        ?string $createdSince = null,
        ?string $createdUntil = null,
        ?int    $distributorAccountId = null,
        ?bool   $includeSubpartners = false
    ): GeneralResponse {
        $queryParams = $this->getQueryParams($createdSince, $createdUntil, $distributorAccountId, $includeSubpartners);
        $response    = $this->getCount('newsletter-accounts/count', NewsletterAccount::KEY, $queryParams);

        return new GeneralResponse($response['data'], $response['response']);
    }

    /**
     * @param string|null $createdSince
     * @param string|null $createdUntil
     * @param int|null    $distributorAccountId
     * @param bool|null   $includeSubpartners
     *
     * @return CustomerAccountResponse
     * @throws MappingError
     */
    public function getCustomerAccounts(
        ?string $createdSince = null,
        ?string $createdUntil = null,
        ?int    $distributorAccountId = null,
        ?bool   $includeSubpartners = false
    ): CustomerAccountResponse {
        $queryParams = $this->getQueryParams($createdSince, $createdUntil, $distributorAccountId, $includeSubpartners);

        $response = $this->getList(
            'customer-accounts',
            CustomerAccount::class,
            CustomerAccount::KEY,
            $queryParams
        );

        return new CustomerAccountResponse($response['data'], $response['response']);
    }

    /**
     * @param string|null $createdSince
     * @param string|null $createdUntil
     * @param int|null    $distributorAccountId
     * @param bool|null   $includeSubpartners
     *
     * @return GeneralResponse
     */
    public function getCustomerAccountsCount(
        ?string $createdSince = null,
        ?string $createdUntil = null,
        ?int    $distributorAccountId = null,
        ?bool   $includeSubpartners = false
    ): GeneralResponse {
        $queryParams = $this->getQueryParams($createdSince, $createdUntil, $distributorAccountId, $includeSubpartners);
        $response    = $this->getCount('customer-accounts/count', CustomerAccount::KEY, $queryParams);

        return new GeneralResponse($response['data'], $response['response']);
    }

    /**
     * @param int    $newsletterAccountId
     * @param string $description
     * @param string $expirationDate
     * @param string $notificationDate
     * @param string $notificationLocale
     * @param array  $notificationEmails
     * @param array  $ipWhitelist
     *
     * @return ApiKeyResponse
     * @throws MappingError
     */
    public function createNewsletterAccountApiKey(
        int    $newsletterAccountId,
        string $description,
        string $expirationDate,
        string $notificationDate,
        string $notificationLocale,
        array  $notificationEmails,
        array  $ipWhitelist
    ): ApiKeyResponse {
        $data = [
            'description'        => $description,
            'expirationDate'     => $expirationDate,
            'notificationEmails' => $notificationEmails,
            'notificationDate'   => $notificationDate,
            'notificationLocale' => $notificationLocale,
            'ipWhitelist'        => $ipWhitelist,
        ];

        $response = $this->create('newsletter-accounts/' . $newsletterAccountId . '/apikey', $data);
        $data     = $this->mapObject(ApiKey::class, $response['data']);

        return new ApiKeyResponse($data, $response['response']);
    }

    /**
     * @param int $id
     *
     * @return NewsletterAccountResponse
     * @throws MappingError
     */
    public function getNewsletterAccount(int $id): NewsletterAccountResponse
    {
        $response = $this->getOne('newsletter-accounts', $id, NewsletterAccount::class);

        return new NewsletterAccountResponse($response['data'], $response['response']);
    }

    /**
     * @param int    $id
     * @param string $status
     *
     * @return AccountStatusResponse
     * @throws MappingError
     */
    public function setNewsletterAccountStatus(int $id, string $status): AccountStatusResponse
    {
        $response = $this->sendRequest(
            'POST',
            'newsletter-accounts/' . $id . '/status',
            ['status' => $status]
        );

        $data = $this->mapObject(AccountStatus::class, $response->body);

        return new AccountStatusResponse($data, $response);
    }

    /**
     * @param int $newsletterAccountId
     *
     * @return MailingDomainResponse
     * @throws MappingError
     */
    public function getMailingDomains(int $newsletterAccountId): MailingDomainResponse
    {
        $response = $this->getList(
            'newsletter-accounts/' . $newsletterAccountId . '/mailing-domains',
            MailingDomain::class
        );

        return new MailingDomainResponse($response['data'], $response['response']);
    }

    /**
     * @param int    $newsletterAccountId
     * @param string $mailingDomainName
     *
     * @return MailingDomainResponse
     * @throws MappingError
     */
    public function getMailingDomain(int $newsletterAccountId, string $mailingDomainName): MailingDomainResponse
    {
        $response = $this->getOne(
            'newsletter-accounts/' . $newsletterAccountId . '/mailing-domains',
            $mailingDomainName,
            MailingDomain::class
        );

        return new MailingDomainResponse($response['data'], $response['response']);
    }

    public function addMailingDomainToNewsletterAccount(
        int    $newsletterAccountId,
        string $mailingDomainName
    ): GeneralResponse {
        $response = $this->sendRequest(
            'POST',
            'newsletter-accounts/' . $newsletterAccountId . '/mailing-domains/' . urlencode($mailingDomainName),
        );

        return new GeneralResponse($response->body, $response);
    }

    /**
     * @param int    $newsletterAccountId
     * @param string $mailingDomain
     *
     * @return GeneralResponse
     */
    public function getStatusOfMailingDomain(int $newsletterAccountId, string $mailingDomain): GeneralResponse
    {
        $response = $this->sendRequest(
            'GET',
            'newsletter-accounts/' . $newsletterAccountId . '/mailing-domains/' . urlencode($mailingDomain) . '/status',
        );

        return new GeneralResponse($response->body, $response);
    }

    /**
     * @param int    $newsletterAccountId
     * @param string $mailingDomain
     * @param string $status
     *
     * @return GeneralResponse
     */
    public function setStatusOfMailingDomain(
        int    $newsletterAccountId,
        string $mailingDomain,
        string $status
    ): GeneralResponse {
        $response = $this->sendRequest(
            'PUT',
            'newsletter-accounts/' . $newsletterAccountId . '/mailing-domains/' . urlencode($mailingDomain) . '/status',
            ['newStatus' => $status]
        );

        return new GeneralResponse($response->body, $response);
    }
}