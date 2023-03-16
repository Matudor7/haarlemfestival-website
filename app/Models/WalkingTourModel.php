<?php
class WalkingTourModel
{
    public int $walkingTour_eventid, $walkingTour_capacity, $walkingTour_availability;
    public string $walkingTour_name, $walkingTour_pictureURL;
    public $walkingTour_kidsPrice, $walkingTour_adultsPrice;
    public $walkingTour_OpeningTime, 	$duration;
    public bool $walkingTour_isItAvailable;
    public  $walkingTour_rating;
    public  $walkingTour_foodType;
}

?>