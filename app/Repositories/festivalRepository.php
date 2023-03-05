<?php
require_once __DIR__ . '/repository.php';
require __DIR__ . '/../Models/festivalModel.php';

class FestivalRepository extends Repository{
    public function getFestival()
    {
        try{
            $statement = $this ->connection->prepare("SELECT festival_id, festival_startingDate, festival_endingDate FROM festival");
            $statement ->execute();

            $statement -> setFetchMode(PDO::FETCH_CLASS, 'Festival');
            $festival = $statement->fetchAll();

            return $festival;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}
?>