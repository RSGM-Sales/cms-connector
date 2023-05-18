<?php

namespace RSGMSales\Connector\Dto;

use RSGMSales\Connector\Responses\BaseApiResponse;
use RSGMSales\Connector\Responses\ReviewApiResponse;

class Review extends BaseApiModel
{
    public int $id;
    public string $name;
    public string $content;
    public int $rating;

    public function __construct(int $id, string $name, string $content, int $rating = 5)
    {
        $this->id = $id;
        $this->name = $name;
        $this->content = $content;
        $this->rating = $rating;
    }

    static function Create(mixed $data): Review
    {
        return new Review($data->id, $data->attributes->nickname, $data->attributes->content);
    }

    static function Deserialize(mixed $data): array
    {
        $items = [];

        foreach ($data as $item) {
            $items[] = Review::create($item);
        }

        return $items;
    }
}
