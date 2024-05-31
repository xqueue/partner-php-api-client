<?php

namespace Xqueue\MaileonPartnerApiClient\Tests\Integrations;

use Xqueue\MaileonPartnerApiClient\Http\Responses\GeneralResponse;
use Xqueue\MaileonPartnerApiClient\Http\Responses\ProductLogResponse;
use Xqueue\MaileonPartnerApiClient\Services\ProductService;
use Xqueue\MaileonPartnerApiClient\Tests\TestCase;

class ProductServiceTest extends TestCase
{

    protected ProductService $productService;
    protected int $nlAccountId;

    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->productService = new ProductService(getenv('MAILEON_PARTNER_API_KEY'));
        $this->nlAccountId = $this->getOneNewsLetterAccount()->id;
    }

    public function test_update_product_status_success(): void
    {
        $response = $this->productService->setStatusOfProduct(
            $this->nlAccountId,
            'product.account.maileonanalytics',
            false
        );

        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), GeneralResponse::class);
        $this->assertIsArray($response->getData());
    }

    public function test_get_product_status_changes_success(): void
    {
        $response = $this->productService->getProductStatusLogs($this->nlAccountId, 'product.account.maileonanalytics');

        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), ProductLogResponse::class);
        $this->assertIsArray($response->getData());
    }


    //TODO
//    public function test_get_products_list_success(): void
//    {
//        $response = $this->productService->getProductsForNewsletterAccount($this->nlAccountId);
//
//        $this->assertTrue($response->getApiResponse()->isSuccess());
//        $this->assertSame(get_class($response), ProductResponse::class);
//        $this->assertIsArray($response->getData());
//    }
//
//    public function test_upload_template_success(): void
//    {
//        $fileContent = file_get_contents(__DIR__ . '/assets/test.zip');
//        $response = $this->productService->uploadTemplate($this->nlAccountId, base64_encode($fileContent));
//
//        dd($response);
//        $this->assertTrue($response->getApiResponse()->isSuccess());
//        $this->assertSame(get_class($response), GeneralResponse::class);
//        $this->assertIsArray($response->getData());
//    }
}