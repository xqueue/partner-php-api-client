<?php

namespace Xqueue\MaileonPartnerApiClient\Traits;

use CuyZ\Valinor\Mapper\MappingError;
use CuyZ\Valinor\MapperBuilder;
use Xqueue\MaileonPartnerApiClient\Entities\Webhook;
use Xqueue\MaileonPartnerApiClient\Entities\WebhookBodySpec;
use Xqueue\MaileonPartnerApiClient\Entities\WebhookUrlParam;

trait MappingTrait
{

    /**
     * @param string $objectName
     * @param array $elements
     * @return array
     * @throws MappingError
     */
    protected function mapList(string $objectName, array $elements): array
    {
        return (new MapperBuilder())->mapper()->map('array<' . $objectName . '>', $elements);
    }

    /**
     * @param string $objectName
     * @param array $data
     * @return object
     * @throws MappingError
     */
    protected function mapObject(string $objectName, array $data): mixed
    {
        return (new MapperBuilder())->mapper()->map($objectName, $data);
    }
}