<?php

namespace RSGMSales\Connector\Dto;

class CreateReviewData
{
    public string $text;
    public int $rating;

    public function __construct(string $text, int $rating)
    {
        $this->text = $text;
        $this->rating = $rating;
    }

    public static function create(string $text, int $rating): CreateReviewData {
        return new CreateReviewData($text, $rating);
    }
}
