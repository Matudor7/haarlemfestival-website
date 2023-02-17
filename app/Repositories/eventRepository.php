<?php
require_once __DIR__ . '/repository.php';
require __DIR__ . '/../Models/eventModel.php';

class EventRepository extends Repository{
    public function getAll(){
        try{
            $statement = $this -> connection -> prepare("SELECT event_id, event_name, event_startTime, event_endTime, event_urlRedirect, event_imageUrl FROM [event]");
            $statement->execute();

            $statement->setFetchMode(PDO::FETCH_CLASS, 'Event');
            $events = $statement->fetchAll();

            return $events;
        }catch(PDOException $e){
            echo $e;
        }
    }

    public function getByName(string $name){
        try{
            $statement = $this->connection->prepare("SELECT event_id, event_name, event_startTime, event_endTime, event_urlRedirect, event_imageUrl FROM [event] WHERE event_name = :event_name");
            $statement->bindParam(':event_name', htmlspecialchars($name));
            $statement->execute();
        }catch(PDOEXCEPTION $e){
            echo $e;
        }
    }
}
?>