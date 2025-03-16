<?php

namespace App\Models;

class Hotel
{
    public function __construct(
        private int $id,
        private string $name,
        private string $description,
        private string $preview,
        private string $createdAt,
        private array $reviews = [],
    ) {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function preview(): string
    {
        return $this->preview;
    }


    public function createdAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @return array<Review>
     */
    public function reviews(): array
    {
        return $this->reviews;
    }

    public function avgRating(): float
    {
        $ratings = array_map(function (Review $review) {
            return $review->rating();
        }, $this->reviews);

        if (count($ratings) === 0) {
            return 0;
        }

        return round(array_sum($ratings) / count($ratings), 2);
    }
}