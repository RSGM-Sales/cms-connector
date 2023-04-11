<?php

namespace RSGMSales\Connector\Dto;

use RSGMSales\Connector\Responses\BaseApiResponse;

class Game extends BaseApiModel
{
    public int $id;
    public string $name;

    /**
     * @var Product[]
     */
    public array $products;

    /**
     * @param Product[] $products
     */
    public function __construct(int $id, string $name, array $products)
    {
        $this->id = $id;
        $this->name = $name;
        $this->products = $products;
    }

    static function Create(mixed $data): Game
    {
        return new Game($data->id, $data->attributes->name, Product::Deserialize($data->relationships));
    }

    /**
     * @param mixed $data
     * @return Game[]
     */
    static function Deserialize(mixed $data): array
    {
        $games = [];

        foreach ($data as $item) {
            $games[] = Game::create($item);
        }

        return $games;
    }
}
