<?php

namespace Xqueue\MaileonPartnerApiClient\Traits;

use CuyZ\Valinor\Mapper\MappingError;
use CuyZ\Valinor\MapperBuilder;

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