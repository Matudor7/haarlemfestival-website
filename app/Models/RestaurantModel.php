<?php

class RestaurantModel
{
    public int $restaurant_id, $restaurant_numberOfAvailableSeats, $numberOfTimeSlots, $restaurant_addressId;
    public string $restaurant_name, $restaurant_pictureURL;
    public decimal $restaurant_kidsPrice, $restaurant_adultsPrice;
    public time $restaurant_OpeningTime, 	$duration;
    public bool $restaurant_isItAvailable;
    public Rating $restaurant_rating;
    public FoodType $restaurant_foodType;








}