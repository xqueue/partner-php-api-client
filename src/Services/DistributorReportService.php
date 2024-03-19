<?php

namespace Xqueue\MaileonPartnerApiClient\Services;

use CuyZ\Valinor\Mapper\MappingError;
use Xqueue\MaileonPartnerApiClient\Entities\SMSReport;
use Xqueue\MaileonPartnerApiClient\Entities\VolumeReport;
use Xqueue\MaileonPartnerApiClient\Http\Responses\SMSReportResponse;
use Xqueue\MaileonPartnerApiClient\Http\Responses\VolumeReportResponse;

class DistributorReportService extends PartnerApiService
{

    /**
     * @param string $from
     * @param string $to
     * @param int $pageIndex
     * @param int $pageSize
     * @param int $newsletterAccountId
     * @param int $customerAccountId
     * @param string|null $accountType
     * @return VolumeReportResponse
     * @throws MappingError
     */
    public function getVolumeReport(
        string  $from,
        string  $to,
        int     $pageIndex,
        int     $pageSize,
        int     $newsletterAccountId,
        int     $customerAccountId,
        ?string $accountType = null
    ): VolumeReportResponse
    {
        $response = $this->getList(
            'report/accounts_volume',
            VolumeReport::class,
            null,
            [
                'from' => $from,
                'to' => $to,
                'page_size' => $pageSize,
                'page_index' => $pageIndex,
                'customer_account_id' => $customerAccountId,
                'newsletter_account_id' => $newsletterAccountId,
                'account_type' => $accountType
            ]
        );

        return new VolumeReportResponse($response['data'], $response['response']);
    }

    /**
     * @param string $from
     * @param string $to
     * @param int $pageIndex
     * @param int $pageSize
     * @param int $newsletterAccountId
     * @param int $processId
     * @return SMSReportResponse
     * @throws MappingError
     */
    public function getSMSReport(
        string $from,
        string $to,
        int    $pageIndex,
        int    $pageSize,
        int    $newsletterAccountId,
        int    $processId
    ): SMSReportResponse
    {
        $response = $this->getList(
            'report/sms',
            SMSReport::class,
            null,
            [
                'from' => $from,
                'to' => $to,
                'page_size' => $pageSize,
                'page_index' => $pageIndex,
                'newsletter_account_id' => $newsletterAccountId,
                'process_id' => $processId,
            ]
        );

        return new SMSReportResponse($response['data'], $response['response']);
    }
}