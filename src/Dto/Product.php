<?php

namespace RSGMSales\Connector\Dto;

use RSGMSales\Connector\Responses\BaseApiResponse;

class Product extends BaseApiModel
{

    public int $id;
    public string $name;
    public float $price;

    public function __construct(int $id, string $name, float $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }

    static function Create(mixed $data): Product
    {
        return new Product($data->id, $data->attributes->name, $data->attributes->pricePerUnit);
    }

    static function Deserialize(mixed $data): array
    {
        $products = [];

        foreach ($data as $item) {
            $products[] = Product::create($item);
        }

        return $products;
    }
}
