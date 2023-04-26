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

    public function getPassById(int $id){
        $query ="SELECT Id, type, price, location, starting_date, ending_date, availability FROM allAccess_passes WHERE Id = :id";

        try{
            $statement = $this->connection->prepare($query);
            $statement->bindParam(':id', $id);
            $statement->execute();

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {

                $allAccessPass = new AllAccessModel();
                $allAccessPass->setId($row['Id']);
                $allAccessPass->setType($row['type']);
                $allAccessPass->setPrice($row['price']);
                $allAccessPass->setLocation($row['location']);
                $startDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $row['starting_date']);
                $allAccessPass->setStartDate($startDateTime);
                $endDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $row['ending_date']);
                $allAccessPass->setEndDate($endDateTime);
                $allAccessPass->setAvailability($row['availability']);

            }

            return $allAccessPass;

        } catch (PDOException $e){echo $e;}
    }
    public function getAllPasses(){
        $query ="SELECT Id FROM allAccess_passes";


        try{
            $statement = $this->connection->prepare($query);
            $statement->execute();

            $allPasses = array();

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $id = (int)$row['Id'];
                $pass = $this->getPassById($id);
                $allPasses[] = $pass;
            }

            return $allPasses;

        } catch(PDOException $e){echo $e;}


}
}