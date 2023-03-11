<?php
require __DIR__ . '/../Repositories/eventRepository.php';

class EventService{
    //TODO: Make a constructor for the repos
    public function getAll(){
        $eventRepo = new EventRepository();
        $events = $eventRepo->getAll();

        return $events;
    }

    public function getByName(string $name){
        $eventRepo = new EventRepository();

        $event = $eventRepo->getByName($name);

        return $event;
    }

    public function insert($event){
        $eventRepo = new EventRepository();

        $eventRepo->insert($event);
    }
}
?>