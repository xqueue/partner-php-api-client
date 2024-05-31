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
use Xqueue\MaileonPartnerApiClient\Http\Responses\UserAccountResponse;
use Xqueue\MaileonPartnerApiClient\Services\UserService;
use Xqueue\MaileonPartnerApiClient\Tests\TestCase;

class UserServiceTest extends TestCase
{

    protected UserService $userService;
    protected int $nlAccountId;

    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->userService = new UserService(getenv('MAILEON_PARTNER_API_KEY'));
        $this->nlAccountId = $this->getOneNewsLetterAccount()->id;
    }


    public function test_get_user_accounts_list_success(): void
    {
        $response = $this->userService->getUserAccounts($this->nlAccountId);

        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), UserAccountResponse::class);
        $this->assertIsArray($response->getData());
    }
//
//    public function test_create_user_account_success(): void
//    {
//        $response = $this->userService->createUserAccount(
//            $this->nlAccountId,
//            'test' . random_int(999, 10000) . '@xqueue.com',
//        );
//
//        $this->assertTrue($response->getApiResponse()->isSuccess());
//        $this->assertSame(get_class($response), UserAccountResponse::class);
//    }
}