<?php

namespace Xqueue\MaileonPartnerApiClient\Services;

use Xqueue\MaileonPartnerApiClient\Http\Request;
use Xqueue\MaileonPartnerApiClient\Http\ApiResponse;
use Xqueue\MaileonPartnerApiClient\Http\Responses\GeneralResponse;

class GeneralService extends PartnerApiService
{

    /**
     * @return GeneralResponse
     */
    public function getDomains(): GeneralResponse
    {
        $response = Request::send('GET', 'domains');

        return new GeneralResponse($response->body['domains'], $response);
    }

    /**
     * @param string $domain
     * @return GeneralResponse
     */
    public function validateDomain(string $domain): GeneralResponse
    {
        $response = Request::send('GET', 'domains/validate', ['domain' => $domain]);

        if (!$response->isSuccess()) {
            $data = [
                'isSuccess' => false,
                'error' => $response->body['error']
            ];
        } else {
            $data = ['isSuccess' => true];
        }

        return new GeneralResponse($data, $response);
    }

    /**
     * @return GeneralResponse
     */
    public function getLocales(): GeneralResponse
    {
        $response = Request::send('GET', 'locales');

        return new GeneralResponse($response->body['locales'], $response);
    }
}