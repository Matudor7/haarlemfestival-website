<?php
require_once __DIR__ . '/repository.php';
require __DIR__ . '/../Models/eventModel.php';

class EventRepository extends Repository{
    public function getAll(){
        try{
            $statement = $this -> connection -> prepare("SELECT id, [url], [name], [text] FROM homepage_elements");
            $statement->execute();

            $statement->setFetchMode(PDO::FETCH_CLASS, 'Event');
            $events = $statement->fetchAll();

            return $events;
        }catch(PDOException $e){
            echo $e;
        }
    }

    public function getByName(string $name){

    }
}
?>