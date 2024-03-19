<?php

namespace Xqueue\MaileonPartnerApiClient\Services;

use CuyZ\Valinor\Mapper\MappingError;
use Xqueue\MaileonPartnerApiClient\Entities\Blacklist;
use Xqueue\MaileonPartnerApiClient\Http\Request;
use Xqueue\MaileonPartnerApiClient\Http\Responses\BlacklistResponse;
use Xqueue\MaileonPartnerApiClient\Http\Responses\GeneralResponse;

class BlacklistService extends PartnerApiService
{

    /**
     * @param int $pageIndex
     * @param int $pageSize
     * @return BlacklistResponse
     * @throws MappingError
     */
    public function getBlacklists(int $pageIndex, int $pageSize): BlacklistResponse
    {
        $response = $this->getList(
            'blacklists',
            Blacklist::class,
            null,
            ['page_size' => $pageSize, 'page_index' => $pageIndex]
        );

        return new BlacklistResponse($response['data'], $response['response']);
    }

    /**
     * @param string $name
     * @param string $status
     * @param string|null $type
     * @return BlacklistResponse
     * @throws MappingError
     */
    public function createBlacklist(string $name, string $status, ?string $type = null): BlacklistResponse
    {
        $response = $this->create(
            'blacklists',
            [],
            [
                'name' => $name,
                'status' => $status,
                'type' => $type
            ],
        );

        $data = $this->mapObject(Blacklist::class, $response['data']);

        return new BlacklistResponse($data, $response['response']);
    }

    /**
     * @param int $id
     * @return BlacklistResponse
     * @throws MappingError
     */
    public function getBlacklist(int $id): BlacklistResponse
    {
        $response = $this->getOne(
            'blacklists',
            $id,
            Blacklist::class,
        );

        return new BlacklistResponse($response['data'], $response['response']);
    }

    /**
     * @param int $id
     * @param string $name
     * @param string $status
     * @param string|null $type
     * @return BlacklistResponse
     * @throws MappingError
     */
    public function updateBlacklist(int $id, string $name, string $status, ?string $type = null): BlacklistResponse
    {
        $response = Request::send(
            'PUT',
            'blacklists/' . $id,
            [
                'name' => $name,
                'status' => $status,
                'type' => $type
            ],
        );

        $data = $this->mapObject(Blacklist::class, $response['data']);

        return new BlacklistResponse($data, $response['response']);
    }

    /**
     * @param int $id
     * @return GeneralResponse
     */
    public function deleteBlacklist(int $id): GeneralResponse
    {
        $response = Request::send('DELETE', 'blacklists/' . $id);

        return new GeneralResponse($response->body, $response);
    }

    /**
     * @param int $id
     * @return GeneralResponse
     */
    public function getAccountsOfBlacklist(int $id): GeneralResponse
    {
        $response = Request::send(
            'GET',
            'blacklists/' . $id . '/accounts',
        );

        return new GeneralResponse($response->body, $response);
    }

    /**
     * @param int $id
     * @param array $newsletterAccountIds
     * @return GeneralResponse
     */
    public function addAccountsToBlacklist(int $id, array $newsletterAccountIds): GeneralResponse
    {
        $response = Request::send(
            'POST',
            'blacklists/' . $id . '/accounts',
            ['newsletterAccountIds' => $newsletterAccountIds]
        );

        return new GeneralResponse($response->body, $response);
    }

    /**
     * @param int $id
     * @param int $pageIndex
     * @param int $pageSize
     * @return GeneralResponse
     */
    public function getPatternsOfBlacklist(int $id, int $pageIndex, int $pageSize): GeneralResponse
    {
        $response = Request::send(
            'GET',
            'blacklists/' . $id . '/patterns',
            ['page_size' => $pageSize, 'page_index' => $pageIndex]
        );

        return new GeneralResponse($response->body, $response);
    }

    /**
     * @param int $id
     * @param string $uploadName
     * @param array $patterns
     * @return GeneralResponse
     */
    public function updatePatternsOfBlacklist(int $id, string $uploadName, array $patterns): GeneralResponse
    {
        $response = Request::send(
            'POST',
            'blacklists/' . $id . '/patterns',
            [],
            ['uploadName' => $uploadName, 'patterns' => $patterns]
        );

        return new GeneralResponse($response->body, $response);
    }
}