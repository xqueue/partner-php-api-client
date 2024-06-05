<?php

use Illuminate\Support\Str;
use Xqueue\MaileonPartnerApiClient\Entities\Contingent;
use Xqueue\MaileonPartnerApiClient\Http\Responses\ContingentResponse;
use Xqueue\MaileonPartnerApiClient\Http\Responses\GeneralResponse;
use Xqueue\MaileonPartnerApiClient\Services\ContingentService;
use Xqueue\MaileonPartnerApiClient\Tests\TestCase;

class ContingentServiceTest extends TestCase
{

    protected ContingentService $contingentService;
    protected int $nlAccountId;

    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->contingentService = new ContingentService(['API_KEY' => getenv('MAILEON_PARTNER_API_KEY')]);
        $this->nlAccountId = $this->getOneNewsLetterAccount()->id;
    }

    public function test_get_prepaid_status_success(): void
    {
        $response = $this->contingentService->getPrepaidStatus($this->nlAccountId);

        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), GeneralResponse::class);
        $this->assertIsArray($response->getData());
    }

    public function test_set_prepaid_status_success(): void
    {
        $response = $this->contingentService->setPrepaidStatus($this->nlAccountId, true);

        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), GeneralResponse::class);
        $this->assertIsArray($response->getData());
    }

    public function test_get_contingents_list_success(): void
    {
        $response = $this->contingentService->getContingents($this->nlAccountId, 'active');

        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), ContingentResponse::class);
        $this->assertIsArray($response->getData());
    }

    public function test_create_contingent_success(): void
    {
        $response = $this->contingentService->createContingent(
            $this->nlAccountId,
            now()->addMonths(3)->toIso8601String(),
            1000,
            Str::uuid()
        );

        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), ContingentResponse::class);
        $this->assertSame(get_class($response->getData()), Contingent::class);

        $this->contingentService->deleteContingent($this->nlAccountId, $response->getData()->id);
    }

    public function test_get_contingent_by_id_success(): void
    {
        $created =  $this->contingentService->createContingent(
            $this->nlAccountId,
            now()->addMonths(3)->toIso8601String(),
            1000,
            Str::uuid()
        );

        $response = $this->contingentService->getContingent($this->nlAccountId, $created->getData()->id);

        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), ContingentResponse::class);
        $this->assertSame(get_class($response->getData()), Contingent::class);

        $this->contingentService->deleteContingent($this->nlAccountId, $created->getData()->id);
    }

    public function test_update_contingent_success(): void
    {
        $created = $this->contingentService->createContingent(
            $this->nlAccountId,
            now()->addMonths(3)->toIso8601String(),
            1000,
            Str::uuid()
        );

        $newName = Str::uuid();
        $response = $this->contingentService->updateContingent(
            $this->nlAccountId,
            $created->getData()->id,
            now()->addMonths(3)->toIso8601String(),
            $newName,
            1000,
        );

        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), ContingentResponse::class);
        $this->assertSame(get_class($response->getData()), Contingent::class);
        $this->assertEquals($newName, $response->getData()->name);

        $this->contingentService->deleteContingent($this->nlAccountId, $created->getData()->id);
    }

    public function test_delete_contingent_success(): void
    {
        $created = $this->contingentService->createContingent(
            $this->nlAccountId,
            now()->addMonths(3)->toIso8601String(),
            1000,
            Str::uuid()
        );

        $response = $this->contingentService->deleteContingent($this->nlAccountId, $created->getData()->id);
        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), GeneralResponse::class);
        $this->assertIsArray($response->getData());
    }
}