<?php

namespace Xqueue\MaileonPartnerApiClient\Services;

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
        $response = $this->sendRequest(
            'POST',
            'settings/roles',
            ['nl_account_id' => $newsletterAccountId],
            [
                'name'        => $roleName,
                'permissions' => $permissions,
            ]
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
        $response = $this->sendRequest(
            'DELETE',
            'settings/roles/' . $roleName,
            ['nl_account_id' => $newsletterAccountId]
        );

        return new GeneralResponse($response->body, $response);
    }
}