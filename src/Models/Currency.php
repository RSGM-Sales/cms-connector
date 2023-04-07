<?php

namespace RSGMSales\Connector\Models;

use RSGMSales\Connector\Responses\BaseApiResponse;

class Currency extends BaseApiModel
{
    public int $id;
    public string $name;
    public string $symbol;
    public string $ticker;
    public float $rate;

    public function __construct(int $id, string $name, string $symbol, string $ticker, float $rate)
    {
        $this->id = $id;
        $this->name = $name;
        $this->symbol = $symbol;
        $this->ticker = $ticker;
        $this->rate = $rate;
    }

    public static function Create(mixed $data): Currency {
        return new Currency($data->id, $data->attributes->name, $data->attributes->symbol, $data->attributes->code, $data->attributes->rate);
    }

    /**
     * @param BaseApiResponse $response
     * @return Currency[]
     */
    public static function Deserialize(BaseApiResponse $response): array {
        $currencies = [];

        foreach ($response->body->data as $data) {
            $currencies[] = Currency::create($data);
        }

        return $currencies;
    }
}
