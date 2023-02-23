<?php

class RestaurantModel
{
    public int $restaurant_id, $restaurant_numberOfAvailableSeats, $numberOfTimeSlots, $restaurant_addressId;
    public string $restaurant_name, $restaurant_pictureURL;
    public $restaurant_kidsPrice, $restaurant_adultsPrice;
    public $restaurant_OpeningTime, 	$duration;
    public bool $restaurant_isItAvailable;
    public  $restaurant_rating;
    public  $restaurant_foodType;

    //TODO change the variables of type time into string in the database. the ones of type decimal as well








}