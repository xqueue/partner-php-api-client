<?php

namespace Xqueue\MaileonPartnerApiClient\Tests\Integrations;

use Xqueue\MaileonPartnerApiClient\Http\Responses\GeneralResponse;
use Xqueue\MaileonPartnerApiClient\Http\Responses\UserAccountResponse;
use Xqueue\MaileonPartnerApiClient\Services\RoleService;
use Xqueue\MaileonPartnerApiClient\Services\UserService;
use Xqueue\MaileonPartnerApiClient\Tests\TestCase;

class UserServiceTest extends TestCase
{

    protected UserService $userService;
    protected RoleService $roleService;
    protected int $nlAccountId;

    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->userService = new UserService(getenv('MAILEON_PARTNER_API_KEY'));
        $this->roleService = new RoleService(getenv('MAILEON_PARTNER_API_KEY'));
        $this->nlAccountId = $this->getOneNewsLetterAccount()->id;
    }


    private function createUser(): string
    {
        $email = 'test+' . random_int(999, 10000) . '@xqueue.com';
        $userData = $this->userService->createUserAccount(
            $this->nlAccountId,
            $email,
            'firstname',
            'lastname'
        );

        $data = $userData->getData();

        return $data['id'];
    }

    private function createCustomRole(string $roleName): string
    {
        $response = $this->roleService->createCustomRole(
            $this->nlAccountId,
            $roleName,
            [
                'settings.permission.inbox',
                'settings.permission.mailingfilter'
            ]
        );

        $data = $response->getData();

        return $data['id'];
    }

    public function test_create_user_account_success(): void
    {
        $email = 'test+' . random_int(999, 10000) . '@xqueue.com';
        $response = $this->userService->createUserAccount(
            $this->nlAccountId,
            $email,
            'firstname',
            'lastname'
        );

        $this->assertTrue($response->getApiResponse()->isSuccess());
        $data = $response->getData();
        $this->assertIsArray($data);
        $this->assertEquals($email, $data['id']);
    }

    public function test_get_user_accounts_list_success(): void
    {
        $response = $this->userService->getUserAccounts($this->nlAccountId);

        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), UserAccountResponse::class);
        $this->assertIsArray($response->getData());
    }

    public function test_delete_user_account_success(): void
    {
        $email = $this->createUser();

        $response = $this->userService->deleteUserAccount($this->nlAccountId, $email);
        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), GeneralResponse::class);
        $this->assertIsArray($response->getData());
    }

    public function test_assign_role_to_user_success(): void
    {
        $email = $this->createUser();
        $roleName = random_int(100, 999) . 'basic_user';
        $this->createCustomRole($roleName);
        $response = $this->userService->assignRoleToUser($this->nlAccountId, $email, $roleName);

        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), GeneralResponse::class);
        $this->assertIsArray($response->getData());
    }

    public function test_remove_role_from_user_success(): void
    {
        $email = $this->createUser();
        $roleName = random_int(100, 999) . 'basic_user';
        $role = $this->createCustomRole($roleName);
        $this->userService->assignRoleToUser($this->nlAccountId, $email, $role);

        $response = $this->userService->deleteRoleFromUser($this->nlAccountId, $email, $roleName);

        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), GeneralResponse::class);
        $this->assertIsArray($response->getData());
    }
}