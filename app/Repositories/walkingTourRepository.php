<?php
require_once __DIR__ . '/repository.php';
require __DIR__ . '/../Models/WalkingTourModel.php';

class walkingTourRepository extends Repository{

    public function getAllWalkingTours(){
        try{
            $statement = $this->connection->prepare("SELECT * FROM walkingTour");
            $statement->execute();

            $statement->setFetchMode(PDO::FETCH_CLASS, 'WalkingTourModel');
            $walkingTours = $statement->fetchAll();

            return $walkingTours;
        }catch(PDOException $e){
            echo $e;
        }
    }
}
?>