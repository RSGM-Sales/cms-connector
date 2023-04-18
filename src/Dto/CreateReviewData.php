<?php

namespace RSGMSales\Connector\Dto;

class CreateReviewData
{
    public string $text;
    public int $rating;
    public string $nickname;

    public function __construct(string $text, int $rating, string $nickname)
    {
        $this->text = $text;
        $this->rating = $rating;
        $this->nickname = $nickname;
    }

    public static function create(string $text, int $rating, string $nickname): CreateReviewData {
        return new CreateReviewData($text, $rating, $nickname);
    }
}
