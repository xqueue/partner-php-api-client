<?php

namespace Xqueue\MaileonPartnerApiClient\Services;

use CuyZ\Valinor\Mapper\MappingError;
use Exception;
use Xqueue\MaileonPartnerApiClient\Http\ApiResponse;
use Xqueue\MaileonPartnerApiClient\Http\Request;
use Xqueue\MaileonPartnerApiClient\Traits\MappingTrait;

abstract class PartnerApiService
{
    use MappingTrait;

    protected array $config;

    /**
     * @param array $config
     *
     * @throws Exception
     */
    public function __construct(array $config)
    {
        $this->config = [
            'BASE_URI' => array_key_exists('BASE_URI', $config) ? $config['BASE_URI'] : 'https://api.maileon.com/partner/',
            'API_KEY'  => array_key_exists('API_KEY', $config) ? $config['API_KEY'] : throw  new Exception('No API key set.'),
            'TIMEOUT'  => array_key_exists('TIMEOUT', $config) ? $config['TIMEOUT'] : 60,
        ];
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
        $response     = $this->sendRequest('GET', $url, $queryParams);
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
        $response = $this->sendRequest('GET', $url . '/' . $id, $queryParams);
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
        $response = $this->sendRequest('GET', $url, $queryParams);

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
        $response = $this->sendRequest('POST', $url, $queryParams, $body);

        return [
            'data'     => $response->body,
            'response' => $response,
        ];
    }

    /**
     * @param string $method
     * @param string $url
     * @param array  $queryParams
     * @param array  $body
     *
     * @return ApiResponse
     */
    protected function sendRequest(string $method, string $url, array $queryParams = [], array $body = []): ApiResponse
    {
        return Request::send($method, $url, $queryParams, $body, $this->config);
    }
}