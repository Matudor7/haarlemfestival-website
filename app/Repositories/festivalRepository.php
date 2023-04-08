<?php
require_once __DIR__ . '/repository.php';
require __DIR__ . '/../Models/festivalModel.php';

class FestivalRepository extends Repository{
    public function getFestival()
    {
        try{
            $statement = $this ->connection->prepare("SELECT id, festival_startingDate, festival_endingDate, event_id, event_name FROM festival");
            $statement ->execute();

            $statement -> setFetchMode(PDO::FETCH_CLASS, 'Festival');
            $festival = $statement->fetchAll();

            return $festival;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function getById(int $id){
        try{
            $statement = $this ->connection->prepare("SELECT id, festival_startingDate, festival_endingDate, event_id, event_name FROM festival WHERE id=:id");
            $statement->bindParam(':id', $id);
            
            $statement ->execute();

            $statement -> setFetchMode(PDO::FETCH_CLASS, 'Festival');
            $festival = $statement->fetch();

            return $festival;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function getByEventName(string $eventName){
        try{
            $statement = $this ->connection->prepare("SELECT id, festival_startingDate, festival_endingDate, event_id, event_name FROM festival WHERE event_name=:eventName");
            $sanitizedName = htmlspecialchars($eventName);
            $statement->bindParam(':eventName', $sanitizedName);
            
            $statement ->execute();

            $statement -> setFetchMode(PDO::FETCH_CLASS, 'Festival');
            $festival = $statement->fetch();

            return $festival;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    
    public function changeEvent(int $id, string $newEventName, int $newEventId){
        try{
            $statement = $this->connection->prepare("UPDATE festival SET event_id = :eventId, event_name = :newEventName WHERE id=:id");
            $statement->bindParam(':eventId', $newEventId);
            $statement->bindParam(':newEventName', $newEventName);
            $statement->bindParam(':id', $id);
            $statement->execute();

        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}
?>