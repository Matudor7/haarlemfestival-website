<?php
require_once __DIR__ . '/../Repositories/RatingRepository.php';
class RatingService
{
    public function getAllRating()
    {
        $ratingRepo = new RatingRepository();
        $rating = $ratingRepo->getAllRating();
        return $rating;
    }

    public function getAllRatingById($rating_id)
    {
        $ratingRepo = new RatingRepository();
        $rating = $ratingRepo->getRatingByID($rating_id);

        return $rating;
    }
}