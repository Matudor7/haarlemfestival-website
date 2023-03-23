<?php

class RestaurantRating
{
    private int $restaurantRating_id;
    private int $ratingNumber;


    public function getRestaurantRatingId(): int
    {
        return $this->restaurantRating_id;
    }

    public function setRestaurantRatingId(int $restaurantRating_id): void
    {
        $this->restaurantRating_id = $restaurantRating_id;
    }

    public function getRatingNumber(): int
    {
        return $this->ratingNumber;
    }

    public function setRatingNumber(int $ratingNumber): void
    {
        $this->ratingNumber = $ratingNumber;
    }



}