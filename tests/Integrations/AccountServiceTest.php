<?php

namespace Xqueue\MaileonPartnerApiClient\Tests\Integrations;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Xqueue\MaileonPartnerApiClient\Entities\MailingDomain;
use Xqueue\MaileonPartnerApiClient\Entities\NewsletterAccount;
use Xqueue\MaileonPartnerApiClient\Http\Responses\CustomerAccountResponse;
use Xqueue\MaileonPartnerApiClient\Http\Responses\GeneralResponse;
use Xqueue\MaileonPartnerApiClient\Http\Responses\MailingDomainResponse;
use Xqueue\MaileonPartnerApiClient\Http\Responses\NewsletterAccountResponse;
use Xqueue\MaileonPartnerApiClient\Services\AccountService;
use Xqueue\MaileonPartnerApiClient\Tests\TestCase;

class AccountServiceTest extends TestCase
{

    protected AccountService $accountService;

    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->accountService = new AccountService(getenv('MAILEON_PARTNER_API_KEY'));
    }


    // NewsletterAccount
    public function test_get_newsletter_accounts_success(): void
    {
        $response = $this->accountService->getNewsletterAccounts();

        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), NewsletterAccountResponse::class);
        $this->assertIsArray($response->getData());
    }

    public function test_get_newsletter_account_counts_success(): void
    {
        $response = $this->accountService->getNewsletterAccountsCount();

        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), GeneralResponse::class);
        $this->assertIsNumeric($response->getData());
    }

    public function test_get_newsletter_account_by_id_success(): void
    {
        $nlAccount = $this->getOneNewsLetterAccount();
        $response = $this->accountService->getNewsletterAccount($nlAccount->id);
        $data = $response->getData();

        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), NewsletterAccountResponse::class);
        $this->assertSame(get_class($data), NewsletterAccount::class);
        $this->assertEquals($nlAccount->id, $data->id);
    }

    public function test_create_newsletter_account_api_key_success(): void
    {
        $nlAccount = $this->getOneNewsLetterAccount();

        $now = Carbon::now();
        $response = $this->accountService->createNewsletterAccountApiKey(
            $nlAccount->id,
            'test',
            $now->addYears(2)->format('Y-m-d'),
            $now->subDays(10)->format('Y-m-d'),
            'de',
            ['tibor.cser@xqueue.com'],
            ['192.168.0.1']
        );

        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), GeneralResponse::class);
        $this->assertIsString($response->getData()['apiKey']);
    }

    public function test_set_newsletter_account_status_success(): void
    {
        $status = 'active';
        $nlAccount = $this->getOneNewsLetterAccount();
        $response = $this->accountService->setNewsletterAccountStatus($nlAccount->id, $status);

        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), GeneralResponse::class);
        $this->assertEquals($status, $response->getData()['new_status']);
    }

    // CustomerAccount
    public function test_get_customer_accounts_success(): void
    {
        $response = $this->accountService->getCustomerAccounts();

        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), CustomerAccountResponse::class);
        $this->assertIsArray($response->getData());
    }

    public function test_get_customer_account_counts_success(): void
    {
        $response = $this->accountService->getCustomerAccountsCount();

        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), GeneralResponse::class);
        $this->assertIsNumeric($response->getData());
    }

    //MailingDomains
    public function test_get_mailing_domains_success(): void
    {
        $nlAccount = $this->getOneNewsLetterAccount();

        $response = $this->accountService->getMailingDomains($nlAccount->id);

        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), MailingDomainResponse::class);
        $this->assertIsArray($response->getData());
    }

    public function test_get_mailing_domain_by_id_success(): void
    {
        $nlAccount = $this->getOneNewsLetterAccount();
        $domain = $this->getOneMailingDomain($nlAccount->id);
        $response = $this->accountService->getMailingDomain($nlAccount->id, $domain->name);

        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), MailingDomainResponse::class);
        $this->assertSame(get_class($response->getData()), MailingDomain::class);
    }

    public function test_add_mailing_domain_to_newsletter_account_success(): void
    {
        $nlAccount = $this->getOneNewsLetterAccount();
        $domain = $this->getOneMailingDomain($nlAccount->id);

        $response = $this->accountService->addMailingDomainToNewsletterAccount(
            $nlAccount->id,
            Str::random(1) . $domain->name
        );

        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), GeneralResponse::class);
    }

    public function test_get_status_of_mailing_domain_success()
    {
        $nlAccount = $this->getOneNewsLetterAccount();
        $domain = $this->getOneMailingDomain($nlAccount->id);
        $response = $this->accountService->getStatusOfMailingDomain($nlAccount->id, $domain->name);

        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), GeneralResponse::class);
    }

    public function test_set_status_of_mailing_domain_success()
    {
        $status = 'active';
        $nlAccount = $this->getOneNewsLetterAccount();
        $domain = $this->getOneMailingDomain($nlAccount->id);
        $response = $this->accountService->setStatusOfMailingDomain($nlAccount->id, $domain->name, $status);

        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), GeneralResponse::class);
    }
}