<?php

namespace Xqueue\MaileonPartnerApiClient\Http\Responses;

use Xqueue\MaileonPartnerApiClient\Entities\Product;
use Xqueue\MaileonPartnerApiClient\Http\ApiResponse;

class ProductResponse extends BaseResponse
{

    /**
     * @param Product|Product[] $data
     * @param ApiResponse $response
     */
    public function __construct(Product|array $data, ApiResponse $response)
    {
        parent::__construct($data, $response);
    }

    /**
     * @return Product|Product[]
     */
    public  function getData(): Product|array
    {
        return $this->data;
    }
}