<?php

namespace RSGMSales\Connector\Dto;

class CreateReviewData
{
    public string $content;
    public int $rating;
    public string $nickname;

    public function __construct(string $content, int $rating, string $nickname)
    {
        $this->content = $content;
        $this->rating = $rating;
        $this->nickname = $nickname;
    }

    public static function create(string $content, int $rating, string $nickname): CreateReviewData {
        return new CreateReviewData($content, $rating, $nickname);
    }
}
