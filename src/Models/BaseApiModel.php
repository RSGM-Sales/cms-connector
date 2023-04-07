<?php

namespace RSGMSales\Connector\Models;

use RSGMSales\Connector\Responses\BaseApiResponse;

abstract class BaseApiModel
{

    abstract static function Create(mixed $data): self;

    /**
     * @param BaseApiResponse $data
     * @return self[]
     */
    abstract static function Deserialize(BaseApiResponse $response): array;
}
