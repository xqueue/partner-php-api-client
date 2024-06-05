<?php

namespace Xqueue\MaileonPartnerApiClient\Services;

use CuyZ\Valinor\Mapper\MappingError;
use Xqueue\MaileonPartnerApiClient\Entities\UserAccount;
use Xqueue\MaileonPartnerApiClient\Http\Request;
use Xqueue\MaileonPartnerApiClient\Http\Responses\GeneralResponse;
use Xqueue\MaileonPartnerApiClient\Http\Responses\UserAccountResponse;

class UserService extends PartnerApiService
{

    /**
     * @param int $newsletterAccountId
     *
     * @return UserAccountResponse
     * @throws MappingError
     */
    public function getUserAccounts(int $newsletterAccountId): UserAccountResponse
    {
        $response = $this->getList(
            'settings/users',
            UserAccount::class,
            null,
            ['nl_account_id' => $newsletterAccountId]
        );

        return new UserAccountResponse($response['data'], $response['response']);
    }

    /**
     * @param int         $newsletterAccountId
     * @param string      $email
     * @param string      $firstName
     * @param string      $lastName
     * @param string|null $locale
     * @param string|null $theme
     *
     * @return GeneralResponse
     */
    public function createUserAccount(
        int     $newsletterAccountId,
        string  $email,
        string  $firstName,
        string  $lastName,
        ?string $locale = null,
        ?string $theme = null,
    ): GeneralResponse {
        $response = $this->create(
            'settings/users',
            [
                'email'      => $email,
                'first_name' => $firstName,
                'last_name'  => $lastName,
                'locale'     => $locale,
                'theme'      => $theme,
            ],
            ['nl_account_id' => $newsletterAccountId]
        );

        return new GeneralResponse($response['data'], $response['response']);
    }

    /**
     * @param int    $newsletterAccountId
     * @param string $email
     *
     * @return GeneralResponse
     */
    public function deleteUserAccount(int $newsletterAccountId, string $email): GeneralResponse
    {
        $response = Request::send(
            'DELETE',
            'settings/users/' . $email,
            ['nl_account_id' => $newsletterAccountId],
            [],
            $this->key
        );

        return new GeneralResponse($response->body, $response);
    }

    /**
     * @param int    $newsletterAccountId
     * @param string $email
     * @param string $roleName
     *
     * @return GeneralResponse
     */
    public function assignRoleToUser(int $newsletterAccountId, string $email, string $roleName): GeneralResponse
    {
        $response = Request::send(
            'PUT',
            'settings/users/' . $email . '/roles',
            [
                'nl_account_id' => $newsletterAccountId,
                'roleName'      => $roleName,
            ],
            [],
            $this->key
        );

        return new GeneralResponse($response->body, $response);
    }

    /**
     * @param int    $newsletterAccountId
     * @param string $email
     * @param string $roleName
     *
     * @return GeneralResponse
     */
    public function deleteRoleFromUser(int $newsletterAccountId, string $email, string $roleName): GeneralResponse
    {
        $response = Request::send(
            'DELETE',
            'settings/users/' . $email . '/roles',
            [
                'nl_account_id' => $newsletterAccountId,
                'roleName'      => $roleName,
            ],
            [],
            $this->key
        );

        return new GeneralResponse($response->body, $response);
    }
}