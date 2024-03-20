<?php

namespace Xqueue\MaileonPartnerApiClient\Tests\Integrations;

use Xqueue\MaileonPartnerApiClient\Http\Responses\GeneralResponse;
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

    public function test_get_newsletter_accounts()
    {
        $response = $this->accountService->getNewsletterAccounts();

        $this->assertSame(get_class($response), NewsletterAccountResponse::class);
        $this->assertTrue($response->getApiResponse()->isSuccess());
    }

    public function test_get_newsletter_account_counts()
    {
        $response = $this->accountService->getNewsletterAccountsCount();

        $this->assertSame(get_class($response), GeneralResponse::class);
        $this->assertIsNumeric($response->getData());
    }
}