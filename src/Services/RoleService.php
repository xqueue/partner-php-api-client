<?php

namespace Xqueue\MaileonPartnerApiClient\Services;

use Xqueue\MaileonPartnerApiClient\Http\Request;
use Xqueue\MaileonPartnerApiClient\Http\Responses\GeneralResponse;

class RoleService extends PartnerApiService
{

    /**
     * @param int    $newsletterAccountId
     * @param string $roleName
     * @param array  $permissions
     *
     * @return GeneralResponse
     */
    public function createCustomRole(int $newsletterAccountId, string $roleName, array $permissions): GeneralResponse
    {
        $response = Request::send(
            'POST',
            'settings/roles',
            ['nl_account_id' => $newsletterAccountId],
            [
                'name'        => $roleName,
                'permissions' => $permissions,
            ],
            $this->key
        );

        return new GeneralResponse($response->body, $response);
    }

    /**
     * @param int    $newsletterAccountId
     * @param string $roleName
     *
     * @return GeneralResponse
     */
    public function deleteCustomRole(int $newsletterAccountId, string $roleName): GeneralResponse
    {
        $response = Request::send(
            'DELETE',
            'settings/roles/' . $roleName,
            ['nl_account_id' => $newsletterAccountId],
            [],
            $this->key
        );

        return new GeneralResponse($response->body, $response);
    }
}