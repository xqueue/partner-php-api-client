<?php

namespace Xqueue\MaileonPartnerApiClient\Services;

use CuyZ\Valinor\Mapper\MappingError;
use Xqueue\MaileonPartnerApiClient\Entities\Contingent;
use Xqueue\MaileonPartnerApiClient\Http\Request;
use Xqueue\MaileonPartnerApiClient\Http\Responses\ContingentResponse;
use Xqueue\MaileonPartnerApiClient\Http\Responses\GeneralResponse;

class ContingentService extends PartnerApiService
{
    /**
     * @param int $newsletterAccountId
     * @return GeneralResponse
     */
    public function getPrepaidStatus(int $newsletterAccountId): GeneralResponse
    {
        $response = Request::send(
            'GET',
            'settings/prepaids/status',
            ['nl_account_id' => $newsletterAccountId]
        );

        return new GeneralResponse($response->body, $response);
    }

    /**
     * @param int $newsletterAccountId
     * @param bool $active
     * @return GeneralResponse
     */
    public function setPrepaidStatus(int $newsletterAccountId, bool $active): GeneralResponse
    {
        $response = Request::send(
            'POST',
            'settings/prepaids/status',
            ['nl_account_id' => $newsletterAccountId],
            ['active' => $active]
        );

        return new GeneralResponse($response->body, $response);
    }

    /**
     * @param int $newsletterAccountId
     * @param null|string $status
     * @return ContingentResponse
     * @throws MappingError
     */
    public function getContingents(int $newsletterAccountId, ?string $status = null): ContingentResponse
    {
        $response = $this->getList(
            'settings/prepaids/contingents',
            Contingent::class,
            null,
            [
                'nl_account_id' => $newsletterAccountId,
                'status' => $status
            ]
        );

        return new ContingentResponse($response['data'], $response['response']);
    }

    /**
     * @param int $newsletterAccountId
     * @param string $expiryDate
     * @param int $contingentValue
     * @param string $name
     * @return ContingentResponse
     * @throws MappingError
     */
    public function createContingent(
        int    $newsletterAccountId,
        string $expiryDate,
        int    $contingentValue,
        string $name
    ): ContingentResponse
    {
        $response = $this->create(
            'settings/prepaids/contingents',
            [
                'expiryDate' => $expiryDate,
                'contingentValue' => $contingentValue,
                'name' => $name
            ],
            ['nl_account_id' => $newsletterAccountId],
        );

        $data = $this->mapObject(Contingent::class, $response['data']);

        return new ContingentResponse($data, $response['response']);
    }

    /**
     * @param int $newsletterAccountId
     * @param string $contingentId
     * @return ContingentResponse
     * @throws MappingError
     */
    public function getContingent(int $newsletterAccountId, string $contingentId): ContingentResponse
    {
        $response = $this->getOne(
            'settings/prepaids/contingents/contingent',
            $contingentId,
            Contingent::class,
            ['nl_account_id' => $newsletterAccountId]
        );

        return new ContingentResponse($response['data'], $response['response']);
    }

    /**
     * @param int $newsletterAccountId
     * @param string $contingentId
     * @param string $expiryDate
     * @param int $contingentValue
     * @param string $name
     * @return ContingentResponse
     * @throws MappingError
     */
    public function updateContingent(
        int    $newsletterAccountId,
        string $contingentId,
        string $expiryDate,
        int    $contingentValue,
        string $name
    ): ContingentResponse
    {
        $response = Request::send(
            'POST',
            'settings/prepaids/contingents/contingent/' . $contingentId,
            ['nl_account_id' => $newsletterAccountId],
            [
                'expiryDate' => $expiryDate,
                'contingentValue' => $contingentValue,
                'name' => $name
            ],
        );

        $data = $this->mapObject(Contingent::class, $response['data']);

        return new ContingentResponse($data, $response['response']);
    }

    /**
     * @param int $newsletterAccountId
     * @param string $contingentId
     * @return GeneralResponse
     */
    public function deleteContingent(
        int    $newsletterAccountId,
        string $contingentId,
    ): GeneralResponse
    {
        $response = Request::send(
            'DELETE',
            'settings/prepaids/contingents/contingent/' . $contingentId,
            ['nl_account_id' => $newsletterAccountId]
        );

        return new GeneralResponse($response->body, $response);
    }
}