<?php
require __DIR__ . '/../Repositories/festivalRepository.php';

class FestivalService{
    public function getFestival(){
        $festivalRepo = new FestivalRepository();
        $festival = $festivalRepo->getFestival();

        return $festival;
    }

    public function changeEvent(string $newEventName, string $oldEventName, int $eventId){
        $festivalRepo = new FestivalRepository();

        $festivalRepo->changeEvent($newEventName, $oldEventName, $eventId);
    }
}
?>