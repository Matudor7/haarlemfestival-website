<?php
class TourTimetable
{
    private int $walkingTour_Timetable_id;
    private DateTime $walkingTour_Timetable_StartDateTime;

    //getter
    public function getTimetableId(): int{
        return $this->walkingTour_Timetable_id;
    }
    public function getTimetableStartDate(): DateTime{
        return DateTime::createFromFormat('d/m/y', $this->walkingTour_Timetable_StartDateTime->format('d/m/y'));
}
    public function getTimetableStartTime(): DateTime
    {
        return DateTime::createFromFormat('H:i', $this->walkingTour_Timetable_StartDateTime->format('H:i'));
    }

    public function getTimetableStartDateTime(): DateTime{
        return $this->walkingTour_Timetable_StartDateTime;
    }

    //setter

    public function setTimetableId(int $id): void{
        $this->walkingTour_Timetable_id = $id;
    }

    public function setTimetableStartDateTime(DateTime $dateTime): void{
        $dateTime->format('d/m/y H:i');
        $this->walkingTour_Timetable_StartDateTime = $dateTime;
    }
}?>