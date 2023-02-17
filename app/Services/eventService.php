<?php
require __DIR__ . '/../Repositories/eventRepository.php';

class EventService{
    public function getAll(){
        $eventRepo = new EventRepository();
        $events = $eventRepo->getAll();

        return $events;
    }

    public function getByName(string $name){
        $eventRepo = new EventRepository();

        $eventRepo->getByName($name);
    }
}
?>