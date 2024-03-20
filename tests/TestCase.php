<?php

namespace Xqueue\MaileonPartnerApiClient\Tests;

use CuyZ\Valinor\Mapper\MappingError;
use Dotenv\Dotenv;
use Orchestra\Testbench\TestCase as BaseTestCase;
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
}
