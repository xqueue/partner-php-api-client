<?php

namespace Xqueue\MaileonPartnerApiClient\Http;

use Xqueue\MaileonPartnerApiClient\Entities\CustomerAccount;
use Xqueue\MaileonPartnerApiClient\Entities\NewsletterAccount;

class ApiResponse
{

    public array $body;
    public array $headers;
    public int $statusCode;
    public string $error;
    public array $info;
    public float $time;

    /**
     * @param array $body
     * @param array $headers
     * @param int $statusCode
     * @param string $error
     * @param array $info
     * @param float $time
     */
    public function __construct(
        array  $body,
        array  $headers,
        int    $statusCode,
        string $error,
        array  $info,
        float  $time,
    )
    {
        $this->body = $body;
        $this->headers = $headers;
        $this->statusCode = $statusCode;
        $this->error = $error;
        $this->info = $info;
        $this->time = $time;
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return 300 > $this->statusCode && $this->statusCode >= 200;
    }

}