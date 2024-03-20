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
        $mapper = (new MapperBuilder())->mapper();
        $result = [];
        foreach ($elements as $element) {
            if ($objectName === Webhook::class) {
                $bodySpecs = [];
                foreach ($element['bodySpec'] ?? [] as $spec) {
                    $bodySpecs[] = $mapper->map(WebhookBodySpec::class, $spec);
                }
                $urlParams = [];
                foreach ($element['urlParams'] ?? [] as $param) {
                    $urlParams[] = $mapper->map(WebhookUrlParam::class, $param);
                }

                $element->urlParams = $urlParams;
                $element->bodySpecs = $bodySpecs;
            }

            $result[] = $mapper->map($objectName, $element);
        }

        return $result;
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