<?php

namespace App\Services;

use App\Kernel\Auth\User;
use App\Kernel\Database\DatabaseInterface;
use App\Kernel\Upload\UploadedFileInterface;
use App\Models\Hotel;
use App\Models\Review;

class HotelService
{
    public function __construct(
        private DatabaseInterface $db
    ) {
    }

    public function store(string $name, string $description, UploadedFileInterface $image): false|int
    {

            $filePath = $image->move('hotels');



        return $this->db->insert('hotels', [
            'name' => $name,
            'description' => $description,
            'preview' => $filePath,
        ]);
    }

    public function all(): array
    {
        $hotels = $this->db->get('hotels');

        return array_map(function ($hotel) {
            return new Hotel(
                $hotel['id'],
                $hotel['name'],
                $hotel['description'],
                $hotel['preview'],
                $hotel['created_at'],
            );
        }, $hotels);
    }

    public function destroy(int $id): void
    {
        $this->db->delete('hotels', [
            'id' => $id,
        ]);
    }

    public function find(int $id): ?Hotel
    {
        $hotel = $this->db->first('hotels', [
            'id' => $id,
        ]);

        if (! $hotel) {
            return null;
        }

        return new Hotel(
            $hotel['id'],
            $hotel['name'],
            $hotel['description'],
            $hotel['preview'],
            $hotel['created_at'],
            $this->getReviews($id)
        );
    }

    public function update(int $id, string $name, string $description, ?UploadedFileInterface $image): void
    {
        $data = [
            'name' => $name,
            'description' => $description,
        ];

        if ($image && ! $image->hasError()) {
            $data['preview'] = $image->move('hotels');
        }

        $this->db->update('hotels', $data, [
            'id' => $id,
        ]);
    }

    public function new(): array
    {
        $hotels = $this->db->get('hotels', [], ['id' => 'DESC'], 10);

        return array_map(function ($hotel) {
            return new Hotel(
                $hotel['id'],
                $hotel['name'],
                $hotel['description'],
                $hotel['preview'],
                $hotel['created_at'],
                $this->getReviews($hotel['id']) // FIXME: в данном случае это лишнее
            );
        }, $hotels);
    }

    private function getReviews(int $id): array
    {
        $reviews = $this->db->get('reviews', [
            'hotel_id' => $id,
            'is_moderate' =>1,
        ], ['id'=>'DESC']);



        return array_map(function ($review) {
            $user = $this->db->first('users', [
                'id' => $review['user_id'],
            ]);

            return new Review(
                $review['id'],
                $review['rating'],
                $review['review'],
                $review['created_at'],
                new User(
                    $user['id'],
                    $user['name'],
                    $user['email'],
                    $user['password'],
                )
            );
        }, $reviews);
    }
}