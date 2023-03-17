<?php
class WalkingTourModel
{
    public int $walkingTour_eventid, $walkingTour_capacity, $walkingTour_availability;
    public DateTime $walkingTour_duration;
    public TourLocation $walkingTour_startingLocation;
    public float $walkingTour_price;
    public TourTimetable $walkingTour_timetable;
    public TourLanguage $walkingTour_language;
}

?>