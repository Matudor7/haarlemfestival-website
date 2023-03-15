<?php
require_once __DIR__ . '/repository.php';
require __DIR__ . '/../Models/festivalModel.php';

class FestivalRepository extends Repository{
    public function getFestival()
    {
        try{
            $statement = $this ->connection->prepare("SELECT festival.festival_id, festival.festival_startingDate, festival.festival_endingDate, festival.event_id, event.event_name FROM festival INNER JOIN event ON festival.event_id = event.event_id");
            $statement ->execute();

            $statement -> setFetchMode(PDO::FETCH_CLASS, 'Festival');
            $festival = $statement->fetchAll();

            return $festival;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    //This does not work as intended: changes all festival events at once
    public function changeEvent(string $newEventName, string $oldEventName, int $eventId){
        try{
            $statement = $this->connection->prepare("UPDATE festival SET event_id = :eventId, event_name = :newEventName WHERE festival_id IN (SELECT festival_id FROM festival WHERE event_name = :oldEventName)");
            $statement->bindParam(':eventId', $eventId);
            $statement->bindParam(':newEventName', $newEventName);
            $statement->bindParam(':oldEventName', $oldEventName);
            $statement->execute();

        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}
?>