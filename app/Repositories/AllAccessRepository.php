<?php
require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../Models/AllAccessModel.php';
class AllAccessRepository extends Repository
{
    public function getAllAccessContent(string $elementId){
        $query = "SELECT content FROM allAccess_content WHERE element_id = :elementId";

        try{
            $statement = $this->connection->prepare($query);
            $statement->bindParam(':elementId', $elementId);
            $statement->execute();

            $statement->execute();

            return $statement->fetch()[0];;
            }
        catch(PDOException $e){echo $e;}
    }
}