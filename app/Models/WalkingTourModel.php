<?php
class WalkingTourModel
{
    private int $walkingTour_eventid, $walkingTour_capacity, $walkingTour_availability;
    private string $walkingTour_duration;
    private TourLocation $walkingTour_startingLocation;
    private TourPrice $walkingTour_price;
    private TourTimetable $walkingTour_timetable;
    private TourLanguage $walkingTour_language;

    //getters

    public function getEventId(): int {
        return $this->walkingTour_eventid;
    }
    public function getTourCapacity(): int{
        return $this->walkingTour_capacity;
    }
    public function getTourAvailability(): int{
        return $this->walkingTour_availability;
    }
    public function getTourDuration(): string{
        return $this->walkingTour_duration;
    }
    public function getTourStartLocation(): TourLocation{
        return $this->walkingTour_startingLocation;
    }
    public function getTourPrice(): TourPrice{
        return $this->walkingTour_price;
    }
    public function getTourTimetable(): TourTimetable{
        return $this->walkingTour_timetable;
    }
    public function getTourLanguage(): TourLanguage{
        return $this->walkingTour_language;
    }
    //setters
    public function setEventId(int $id){
        $this->walkingTour_eventid = $id;
    }
    public function setTourCapacity(int $capacity){
        $this->walkingTour_capacity = $capacity;
    }
    public function setTourAvailability(int $availability){
        $this->walkingTour_availability = $availability;
    }
    public function setTourDuration(string $duration){
        $this->walkingTour_duration = $duration;
    }
    public function setStartLocation(TourLocation $location){
        $this->walkingTour_startingLocation = $location;
    }
    public function setTourPrice(TourPrice $price){
        $this->walkingTour_price = $price;
    }
    public function setTourTimetable(TourTimetable $timetable){
        $this->walkingTour_timetable = $timetable;
    }
    public function setTourLanguage(TourLanguage $language){
        $this->walkingTour_language = $language;
    }
}
?>