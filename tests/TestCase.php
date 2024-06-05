<?php

namespace Xqueue\MaileonPartnerApiClient\Tests;

use CuyZ\Valinor\Mapper\MappingError;
use Dotenv\Dotenv;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Xqueue\MaileonPartnerApiClient\Entities\CustomerAccount;
use Xqueue\MaileonPartnerApiClient\Entities\MailingDomain;
use Xqueue\MaileonPartnerApiClient\Entities\NewsletterAccount;
use Xqueue\MaileonPartnerApiClient\Services\AccountService;

abstract class TestCase extends BaseTestCase
{

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        parent::__construct($name);

        $dotenv = Dotenv::createUnsafeImmutable('/app/');
        $dotenv->load();
    }

    /**
     * @return NewsletterAccount
     * @throws MappingError
     */
    public function getOneNewsLetterAccount(): NewsletterAccount
    {
        $accountService = new AccountService(getenv('MAILEON_PARTNER_API_KEY'));
        $accounts = $accountService->getNewsletterAccounts();
        $data = $accounts->getData();

        return $data[0];
    }

    /**
     * @param int $nlAccountId
     * @return MailingDomain
     * @throws MappingError
     */
    public function getOneMailingDomain(int $nlAccountId): MailingDomain
    {
        $accountService = new AccountService(getenv('MAILEON_PARTNER_API_KEY'));
        $domains = $accountService->getMailingDomains($nlAccountId);
        $data = $domains->getData();

        return $data[0];
    }

    /**
     * @return CustomerAccount
     * @throws MappingError
     */
    public function getOneCustomerAccount(): CustomerAccount
    {
        $customerService = new AccountService(getenv('MAILEON_PARTNER_API_KEY'));
        $accounts = $customerService->getCustomerAccounts();
        $data = $accounts->getData();

        return $data[0];
    }
}
