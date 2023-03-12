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

    public function getById(int $id){
        $eventRepo = new EventRepository();

        $event = $eventRepo->getById($id);

        return $event;
    }

    public function insert($event){
        $eventRepo = new EventRepository();

        $eventRepo->insert($event);
    }

    public function updateEvent(Event $oldEvent, Event $newEvent){
        $eventRepo = new EventRepository();

        $eventRepo->updateEvent($oldEvent, $newEvent);
    }

    public function deleteEvent($event){
        $eventRepo = new EventRepository();

        $eventRepo->deleteEvent($event);
    }
}
?>