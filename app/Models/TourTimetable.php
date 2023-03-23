<?php
class TourTimetable
{
    private int $walkingTour_Timetable_id;
    private DateTime $walkingTour_Timetable_startingTime;
    private DateTime $walkingTour_Timetable_startingDate;
    private DateTime $walkingTour_Timetable_StartDateTime;

    //getter
    public function getTimetableId(): int{
        return $this->walkingTour_Timetable_id;
    }
    //public function getTimetableStartDate(): DateTime{
        //return $this->walkingTour_Timetable_startingDate;
//}
  //  public function getWalkingTourTimetableStartTime(): DateTime
    //{
      //  return $this->walkingTour_Timetable_startingTime;
    //}

    public function getTimetableStartDateTime(): DateTime{
        return $this->walkingTour_Timetable_StartDateTime;
    }

    //setter

    public function setTimetableId(int $id): void{
        $this->walkingTour_Timetable_id = $id;
    }
    //public function setTimetableStartTime(DateTime $time): void{
      //  $this->walkingTour_Timetable_startingTime = $time->format('H:i:s');
    //}
    //public function setTimetableStartDate(DateTime $date): void{
      //  $this->walkingTour_Timetable_startingDate = $date->format('Y-m-d');
    //}

    public function setTimetableStartDateTime(DateTime $dateTime): void{
        $dateTime->format('d/m/y H:i');
        $this->walkingTour_Timetable_StartDateTime = $dateTime;
    }
}?>