<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Review;

class ReviewService
{

    public function createReview(Product $product, array $data): Review
    {
        $review= new Review($data);
        $product->reviews()->save($review);
        return $review;

    }

    public function updateReview(Review $review, array $data): Review
    {
        $review->update($data);
        return $review;
    }

    public function deleteReview(Review $review): void
    {
        $review->delete();
    }

}