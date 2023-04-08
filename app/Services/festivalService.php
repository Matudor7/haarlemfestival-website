<?php
require __DIR__ . '/../Repositories/festivalRepository.php';

class FestivalService{

    private $festivalRepo;
    public function __construct(){
        $this->festivalRepo = new FestivalRepository();
    }
    public function getFestival(){
        $festival = $this->festivalRepo->getFestival();

        return $festival;
    }

    public function getById(int $id){
        $festival = $this->festivalRepo->getById($id);

        return $festival;
    }

    public function getByEventName(string $eventName){
        $festival = $this->festivalRepo->getByEventName($eventName);

        return $festival;
    }

    public function changeEvent(int $id, string $newEventName, int $newEventId){
        $this->festivalRepo->changeEvent($id, $newEventName, $newEventId);
    }
}
?>