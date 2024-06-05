<?php

namespace Xqueue\MaileonPartnerApiClient\Http;

class Request
{
    public const BASE_URL = 'https://api-test.maileon.com/partner/';

    /**
     * @param string      $method
     * @param string      $url
     * @param array       $params
     * @param array       $body
     * @param string|null $apiKey
     *
     * @return ApiResponse
     */
    public static function send(
        string  $method,
        string  $url,
        array   $params = [],
        array   $body = [],
        ?string $apiKey = '',
    ): ApiResponse {
        $params['key'] = $apiKey;
        $queryString   = http_build_query($params);
        $fullUrl       = self::BASE_URL . $url . ($queryString ? '?' . $queryString : '');

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        if ($method === 'POST' || $method === 'PUT') {
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($body));
            curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        }

        curl_setopt($curl, CURLOPT_URL, $fullUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);

        $response   = curl_exec($curl);
        $error      = curl_error($curl);
        $info       = curl_getinfo($curl);
        $headerSize = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $httpCode   = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $time       = curl_getinfo($curl, CURLINFO_TOTAL_TIME);
        curl_close($curl);

        $responseHeaders = self::parseHttpHeaders(substr($response, 0, $headerSize) ?? '');
        $responseBody    = json_decode(substr($response, $headerSize) ?? '', true);

        if ($httpCode > 299 || $httpCode < 200) {
            $error        = is_string($responseBody) ? $responseBody : 'Unknown error';
            $responseBody = ['error' => $error];
        }

        return new ApiResponse(is_array($responseBody) ? $responseBody : [], $responseHeaders, $httpCode, $error, $info, $time);
    }

    /**
     * @param string $headerString
     *
     * @return array
     */
    public static function parseHttpHeaders(string $headerString): array
    {
        $headers = explode("\r\n", $headerString);
        $result  = [];

        // Remove the status line
        array_shift($headers);

        foreach ($headers as $header) {
            if (! empty($header)) {
                [$key, $value] = explode(':', $header, 2);
                $result[trim($key)] = trim($value);
            }
        }

        return $result;
    }

}