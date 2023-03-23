<?php
require_once __DIR__ . '/repository.php';
require __DIR__ . '/../Models/eventModel.php';

class EventRepository extends Repository{
    public function getAll(){
        try{
            $statement = $this -> connection -> prepare("SELECT event_id, event_name, event_description, event_startTime, event_endTime, event_urlRedirect, event_imageUrl FROM event");
            
            $statement->execute();
            $events = $statement->fetchAll(PDO::FETCH_CLASS, 'Event');

            return $events;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function getByName(string $name){
        try{
            $statement = $this->connection->prepare("SELECT event_id, event_name, event_startTime, event_endTime, event_urlRedirect, event_imageUrl, event_description FROM event WHERE event_name = :event_name");
            $sanitizedName = htmlspecialchars($name);
            $statement->bindParam(':event_name', $sanitizedName);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_CLASS, 'Event');

            $event = $statement->fetch();

            return $event;
        }catch(PDOEXCEPTION $e){
            echo $e->getMessage();
        }
    }

    public function getById(int $id){
        try{
            $statement = $this->connection->prepare("SELECT event_id, event_name, event_startTime, event_endTime, event_urlRedirect, event_imageUrl, event_description FROM event WHERE event_id = :id");
            $statement->bindParam(':id', $id);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_CLASS, 'Event');
    
            $event = $statement->fetch();
    
            return $event;
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function insert($event){
        try{
            $statement = $this ->connection->prepare("INSERT INTO event (event_name, event_startTime, event_endTime, event_urlRedirect, event_imageUrl, event_description) VALUES (?, ?, ?, ?, ?, ?)");
            $statement->execute(array(htmlspecialchars($event->getName()), $event->getStartTime(), $event->getEndTime(), htmlspecialchars($event->getUrlRedirect()), htmlspecialchars($event->getImageUrl()), htmlspecialchars($event->getDescription())));
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function updateEvent(Event $oldEvent, Event $newEvent){
        try{
            $statement = $this->connection->prepare("UPDATE event SET event_name = :eventName, event_startTime = :eventStartTime, event_endTime = :eventEndTime, event_urlRedirect = :eventUrlRedirect, event_imageUrl = :eventImageUrl, event_description = :eventDescription WHERE event_id = :oldEventId");

            $sanitizedName = htmlspecialchars($newEvent->getName());
            $sanitizedDescription = htmlspecialchars($newEvent->getDescription());
            $sanitizedStartDate = htmlspecialchars($newEvent->getStartTime());
            $sanitizedEndDate = htmlspecialchars($newEvent->getEndTime());
            $sanitizedUrlRedirect = htmlspecialchars($newEvent->getUrlRedirect());
            $sanitizedImageUrl = htmlspecialchars($newEvent->getImageUrl());
            $oldEventId = $oldEvent ->getId();
    
            $statement->bindParam(':eventName', $sanitizedName);
            $statement->bindParam(':eventStartTime', $sanitizedStartDate);
            $statement->bindParam(':eventEndTime', $sanitizedEndDate);
            $statement->bindParam(':eventUrlRedirect', $sanitizedUrlRedirect);
            $statement->bindParam(':eventImageUrl', $sanitizedImageUrl);
            $statement->bindParam(':eventDescription', $sanitizedDescription);
            $statement->bindParam(':oldEventId', $oldEventId);
    
            $statement->execute();
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function deleteEvent(Event $event){
        try{
            $statement = $this->connection->prepare("DELETE FROM event WHERE event_id = :id");

            $eventId = $event->getId();

            $statement->bindParam(':id', $eventId);

            $statement->execute();
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}
?>