<?php

namespace Xqueue\MaileonPartnerApiClient\Tests\Integrations;


use Illuminate\Support\Str;
use Xqueue\MaileonPartnerApiClient\Entities\Blacklist;
use Xqueue\MaileonPartnerApiClient\Http\Responses\BlacklistResponse;
use Xqueue\MaileonPartnerApiClient\Http\Responses\GeneralResponse;
use Xqueue\MaileonPartnerApiClient\Services\BlacklistService;
use Xqueue\MaileonPartnerApiClient\Tests\TestCase;

class BlacklistServiceTest extends TestCase
{
    protected int $nlAccountId;
    private BlacklistService $blacklistService;

    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->blacklistService = new BlacklistService(getenv('MAILEON_PARTNER_API_KEY'));
        $this->nlAccountId = $this->getOneNewsLetterAccount()->id;
    }

    public function test_get_blacklists_success()
    {
        $response = $this->blacklistService->getBlacklists(1, 10);

        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), BlacklistResponse::class);
        $this->assertIsArray($response->getData());
    }

    public function test_create_blacklist_success()
    {
        $response = $this->blacklistService->createBlacklist(Str::uuid(), 'active');

        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), BlacklistResponse::class);
        $this->assertEquals(Blacklist::class, get_class($response->getData()));

        $this->blacklistService->deleteBlacklist($response->getData()->id);
    }

    public function test_delete_blacklist_success()
    {
        $created = $this->blacklistService->createBlacklist(Str::uuid(), 'active');

        $response = $this->blacklistService->deleteBlacklist($created->getData()->id);

        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), GeneralResponse::class);
    }

    public function test_get_blacklist_by_id_success()
    {
        $created = $this->blacklistService->createBlacklist(Str::uuid(), 'active');

        $response = $this->blacklistService->getBlacklist($created->getData()->id);

        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), BlacklistResponse::class);
        $this->assertEquals(Blacklist::class, get_class($response->getData()));

        $this->blacklistService->deleteBlacklist($created->getData()->id);
    }

    public function test_update_blacklist_success()
    {
        $created = $this->blacklistService->createBlacklist(Str::uuid(), 'active');

        $updatedName = Str::uuid();
        $response = $this->blacklistService->updateBlacklist($created->getData()->id, $updatedName, 'active');

        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), BlacklistResponse::class);
        $this->assertEquals(Blacklist::class, get_class($response->getData()));
        $this->assertEquals($updatedName, $response->getData()->name);

        $this->blacklistService->deleteBlacklist($created->getData()->id);
    }


    // Accounts of blacklist
    public function test_get_accounts_of_blacklist_success()
    {
        $created = $this->blacklistService->createBlacklist(Str::uuid(), 'active');

        $response = $this->blacklistService->getAccountsOfBlacklist($created->getData()->id);

        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), GeneralResponse::class);
        $this->assertIsArray($response->getData());

        $this->blacklistService->deleteBlacklist($created->getData()->id);
    }

    public function test_create_account_of_blacklist_success()
    {
        $created = $this->blacklistService->createBlacklist(Str::uuid(), 'active');

        $response = $this->blacklistService->addAccountsToBlacklist($created->getData()->id, [$this->nlAccountId]);

        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), GeneralResponse::class);
        $this->assertIsArray($response->getData());

        $this->blacklistService->deleteBlacklist($created->getData()->id);
    }

    public function test_get_patterns_of_blacklist_success()
    {
        $created = $this->blacklistService->createBlacklist(Str::uuid(), 'active');

        $response = $this->blacklistService->getPatternsOfBlacklist($created->getData()->id, 1, 10);

        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), GeneralResponse::class);
        $this->assertIsArray($response->getData());

        $this->blacklistService->deleteBlacklist($created->getData()->id);
    }

    public function test_update_patterns_of_blacklist_success()
    {
        $created = $this->blacklistService->createBlacklist(Str::uuid(), 'active');

        $response = $this->blacklistService->updatePatternsOfBlacklist(
            $created->getData()->id,
            Str::uuid(),
            ['pattern@examplemail.ab', '*ab*@maileon.de']
        );

        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), GeneralResponse::class);
        $this->assertIsArray($response->getData());

        $this->blacklistService->deleteBlacklist($created->getData()->id);
    }
}
