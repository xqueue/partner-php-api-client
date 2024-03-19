<?php

namespace Xqueue\MaileonPartnerApiClient\Http\Responses;

use Xqueue\MaileonPartnerApiClient\Entities\ProductLog;
use Xqueue\MaileonPartnerApiClient\Http\ApiResponse;

class ProductLogResponse extends BaseResponse
{

    /**
     * @param ProductLog|ProductLog[] $data
     * @param ApiResponse $response
     */
    public function __construct(ProductLog|array $data, ApiResponse $response)
    {
        parent::__construct($data, $response);
    }

    /**
     * @return ProductLog|ProductLog[]
     */
    public  function getData(): ProductLog|array
    {
        return $this->data;
    }
}