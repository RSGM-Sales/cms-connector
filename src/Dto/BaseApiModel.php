<?php

namespace RSGMSales\Connector\Dto;

use RSGMSales\Connector\Responses\BaseApiResponse;

abstract class BaseApiModel
{
    abstract static function Create(mixed $data): self;

    /**
     * @param mixed $data
     * @return self[]
     */
    abstract static function Deserialize(mixed $data): array;
}
