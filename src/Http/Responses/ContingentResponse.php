<?php

namespace Xqueue\MaileonPartnerApiClient\Http\Responses;

use Xqueue\MaileonPartnerApiClient\Entities\Contingent;
use Xqueue\MaileonPartnerApiClient\Http\ApiResponse;

class ContingentResponse extends BaseResponse
{

    /**
     * @param Contingent|Contingent[] $data
     * @param ApiResponse $response
     */
    public function __construct(Contingent|array $data, ApiResponse $response)
    {
        parent::__construct($data, $response);
    }

    /**
     * @return Contingent|Contingent[]
     */
    public  function getData(): Contingent|array
    {
        return $this->data;
    }
}