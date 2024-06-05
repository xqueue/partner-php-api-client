<?php

namespace Xqueue\MaileonPartnerApiClient\Traits;

use CuyZ\Valinor\Mapper\MappingError;
use CuyZ\Valinor\MapperBuilder;
use Xqueue\MaileonPartnerApiClient\Entities\Webhook;

trait MappingTrait
{

    /**
     * @param string $objectName
     * @param array  $elements
     *
     * @return array
     * @throws MappingError
     */
    protected function mapList(string $objectName, array $elements): array
    {
        if ($objectName === Webhook::class) {
            return (new MapperBuilder())
                ->allowSuperfluousKeys()
                ->allowPermissiveTypes()
                ->mapper()
                ->map('array<' . $objectName . '>', $elements);
        }

        return (new MapperBuilder())->mapper()->map('array<' . $objectName . '>', $elements);
    }

    /**
     * @param string $objectName
     * @param array  $data
     *
     * @return object
     * @throws MappingError
     */
    protected function mapObject(string $objectName, array $data): mixed
    {
        if ($objectName === Webhook::class) {
            return (new MapperBuilder())
                ->allowSuperfluousKeys()
                ->allowPermissiveTypes()
                ->mapper()
                ->map($objectName, $data);
        }

        return (new MapperBuilder())->mapper()->map($objectName, $data);
    }
}