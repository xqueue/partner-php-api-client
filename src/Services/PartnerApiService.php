<?php

namespace Xqueue\MaileonPartnerApiClient\Services;

use CuyZ\Valinor\Mapper\MappingError;
use Xqueue\MaileonPartnerApiClient\Http\Request;
use Xqueue\MaileonPartnerApiClient\Traits\MappingTrait;

abstract class PartnerApiService
{
    use MappingTrait;

    protected ?string $key;

    /**
     * @param string|null $key
     */
    public function __construct(?string $key = null)
    {
        $this->key = $key;
    }

    /**
     * @param string      $url
     * @param string      $objectName
     * @param string|null $responseKey
     * @param array       $queryParams
     *
     * @return array
     * @throws MappingError
     */
    protected function getList(
        string  $url,
        string  $objectName,
        ?string $responseKey = null,
        array   $queryParams = []
    ): array {
        $response     = Request::send('GET', $url, $queryParams, [], $this->key);
        $responseBody = $response->body;
        $responseData = $responseKey ? $responseBody[$responseKey] : $responseBody;

        $data = $this->mapList($objectName, $responseData);

        return [
            'data'     => $data,
            'response' => $response,
        ];
    }

    /**
     * @param string     $url
     * @param int|string $id
     * @param string     $objectName
     * @param array      $queryParams
     *
     * @return array
     * @throws MappingError
     */
    protected function getOne(string $url, int|string $id, string $objectName, array $queryParams = []): array
    {
        $response = Request::send('GET', $url . '/' . $id, $queryParams, [], $this->key);
        $data     = $this->mapObject($objectName, $response->body);

        return [
            'data'     => $data,
            'response' => $response,
        ];
    }

    /**
     * @param string $url
     * @param string $responseKey
     * @param array  $queryParams
     *
     * @return array
     */
    protected function getCount(string $url, string $responseKey, array $queryParams = []): array
    {
        $response = Request::send('GET', $url, $queryParams, [], $this->key);

        return [
            'data'     => $response->body[$responseKey],
            'response' => $response,
        ];
    }

    /**
     * @param string $url
     * @param array  $body
     * @param array  $queryParams
     *
     * @return array
     */
    protected function create(string $url, array $body, array $queryParams = []): array
    {
        $response = Request::send('POST', $url, $queryParams, $body, $this->key);

        return [
            'data'     => $response->body,
            'response' => $response,
        ];
    }
}