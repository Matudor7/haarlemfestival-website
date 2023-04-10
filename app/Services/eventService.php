<?php
//Tudor Nosca (678549)
require __DIR__ . '/../Repositories/eventRepository.php';

class EventService{

    private $eventRepo;

    public function __construct(){
        $this->eventRepo = new EventRepository(); 
    }

    public function getAll(){
        $events = $this->eventRepo->getAll();

        return $events;
    }

    public function getByName(string $name){
        $event = $this->eventRepo->getByName($name);

        return $event;
    }

    public function getById(int $id){
        $event = $this->eventRepo->getById($id);

        return $event;
    }

    public function insert($event){
        $this->eventRepo->insert($event);
    }

    public function updateEvent(Event $oldEvent, Event $newEvent){
        $this->eventRepo->updateEvent($oldEvent, $newEvent);
    }

    public function deleteEvent($event){
        $this->eventRepo->deleteEvent($event);
    }
}
?>