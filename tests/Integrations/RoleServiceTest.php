<?php

namespace Xqueue\MaileonPartnerApiClient\Tests\Integrations;

use Xqueue\MaileonPartnerApiClient\Http\Responses\GeneralResponse;
use Xqueue\MaileonPartnerApiClient\Services\RoleService;
use Xqueue\MaileonPartnerApiClient\Tests\TestCase;

class RoleServiceTest extends TestCase
{

    protected RoleService $roleService;
    protected int $nlAccountId;

    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->roleService = new RoleService(['API_KEY' => getenv('MAILEON_PARTNER_API_KEY')]);
        $this->nlAccountId = $this->getOneNewsLetterAccount()->id;
    }


    public function test_create_custom_role_success(): void
    {
        $response = $this->roleService->createCustomRole(
            $this->nlAccountId,
            random_int(100, 999) . '_basic_user',
            [
                'settings.permission.inbox',
                'settings.permission.mailingfilter'
            ]
        );

        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), GeneralResponse::class);
        $this->assertIsArray($response->getData());
    }

    public function test_delete_custom_role_success(): void
    {
        $roleName = random_int(100, 999) . '_basic_user';
        $this->roleService->createCustomRole(
            $this->nlAccountId,
            $roleName,
            [
                'settings.permission.inbox',
                'settings.permission.mailingfilter'
            ]);


        $response = $this->roleService->deleteCustomRole($this->nlAccountId, $roleName);
        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), GeneralResponse::class);
        $this->assertIsArray($response->getData());
    }
}