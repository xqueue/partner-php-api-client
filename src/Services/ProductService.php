<?php

namespace Xqueue\MaileonPartnerApiClient\Services;

use CuyZ\Valinor\Mapper\MappingError;
use Xqueue\MaileonPartnerApiClient\Entities\Product;
use Xqueue\MaileonPartnerApiClient\Entities\ProductLog;
use Xqueue\MaileonPartnerApiClient\Http\Request;
use Xqueue\MaileonPartnerApiClient\Http\Responses\GeneralResponse;
use Xqueue\MaileonPartnerApiClient\Http\Responses\ProductLogResponse;
use Xqueue\MaileonPartnerApiClient\Http\Responses\ProductResponse;

class ProductService extends PartnerApiService
{

    /**
     * @param int $newsletterAccountId
     * @return ProductResponse
     * @throws MappingError
     */
    public function getProductsForNewsletterAccount(int $newsletterAccountId): ProductResponse
    {
        $response = $this->getList(
            'settings/products',
            Product::class,
            Product::KEY,
            ['nl_account_id' => $newsletterAccountId]
        );

        return new ProductResponse($response['data'], $response['response']);
    }

    /**
     * @param int $newsletterAccountId
     * @param string $productName
     * @param bool $active
     * @param string|null $timeRestricted
     * @return GeneralResponse
     */
    public function setStatusOfProduct(
        int     $newsletterAccountId,
        string  $productName,
        bool    $active,
        ?string $timeRestricted = null
    ): GeneralResponse
    {
        $response = Request::send(
            'PUT',
            'settings/products/' . $productName,
            ['nl_account_id' => $newsletterAccountId],
            [
                'active' => $active,
                'timeRestricted' => $timeRestricted
            ],
            $this->key
        );

        return new GeneralResponse($response->body, $response);
    }

    /**
     * @param int $newsletterAccountId
     * @param string $productName
     * @return ProductLogResponse
     * @throws MappingError
     */
    public function getProductStatusLogs(
        int    $newsletterAccountId,
        string $productName,
    ): ProductLogResponse
    {
        $response = $this->getList(
            'settings/products/' . $productName . '/logs',
            ProductLog::class,
            ProductLog::KEY,
            ['nl_account_id' => $newsletterAccountId]
        );

        return new ProductLogResponse($response['data'], $response['response']);
    }

    /**
     * @param int $newsletterAccountId
     * @param string $base64encodedFile
     * @return GeneralResponse
     */
    public function uploadTemplate(
        int    $newsletterAccountId,
        string $base64encodedFile
    ): GeneralResponse
    {
        $response = Request::send(
            'POST',
            'media/templates/',
            ['nl_account_id' => $newsletterAccountId],
            ['content' => $base64encodedFile],
            $this->key
        );

        return new GeneralResponse($response->body, $response);
    }
}