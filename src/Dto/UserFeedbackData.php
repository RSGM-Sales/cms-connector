<?php

namespace RSGMSales\Connector\Dto;

class UserFeedbackData
{
    public string $text;
    public int $rating;

    public function __construct(string $text, int $rating)
    {
        $this->text = $text;
        $this->rating = $rating;
    }

    public static function create(string $text, int $rating): UserFeedbackData {
        return new UserFeedbackData($text, $rating);
    }
}
