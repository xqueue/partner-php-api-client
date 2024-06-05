<?php

namespace Xqueue\MaileonPartnerApiClient\Tests\Integrations;

use Illuminate\Support\Str;
use Xqueue\MaileonPartnerApiClient\Entities\Contingent;
use Xqueue\MaileonPartnerApiClient\Http\Responses\ContingentResponse;
use Xqueue\MaileonPartnerApiClient\Http\Responses\GeneralResponse;
use Xqueue\MaileonPartnerApiClient\Http\Responses\JobResponse;
use Xqueue\MaileonPartnerApiClient\Services\ContingentService;
use Xqueue\MaileonPartnerApiClient\Services\JobService;
use Xqueue\MaileonPartnerApiClient\Tests\TestCase;

class JobServiceTest extends TestCase
{

    protected JobService $jobService;
    protected int $nlAccountId;

    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->jobService = new JobService(getenv('MAILEON_PARTNER_API_KEY'));
        $this->nlAccountId = $this->getOneNewsLetterAccount()->id;
    }

    public function test_get_jobs_success(): void
    {
        $response = $this->jobService->getJobs();

        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), JobResponse::class);
        $this->assertIsArray($response->getData());
    }

    public function test_create_account_job_success(): void
    {
        $response = $this->jobService->createAccountJob(
            'de_DE',
            'demo',
            'TEST',
            'TEST_CUSTOMER' . random_int(100, 999),
            'TEST_NL' . random_int(100, 999),
            null,
            'maileon.de',
            'mynewaccount' . random_int(100, 999),
        );

        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), GeneralResponse::class);
        $this->assertIsArray($response->getData());
    }

    public function test_get_account_job_success(): void
    {

        $accountJobData = $this->jobService->createAccountJob(
            'de_DE',
            'demo',
            'TEST',
            'TEST_CUSTOMER' . random_int(100, 999),
            'TEST_NL' . random_int(100, 999),
            null,
            'maileon.de',
            'mynewaccount' . random_int(100, 999),
        );

        $data = $accountJobData->getData();

        $response = $this->jobService->getJobById($data['jobId']);
        $this->assertTrue($response->getApiResponse()->isSuccess());
        $this->assertSame(get_class($response), JobResponse::class);
    }
}