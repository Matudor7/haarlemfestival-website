<?php
require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../Models/userType.php';
class userTypeRepository extends Repository
{
    public function getTypeById()
    {
        try {
            $statement = $this->connection->prepare("SELECT userTypeId, userType FROM userType where userTypeId =:id");
            $statement->bindParam(':id', $id);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_CLASS, 'userType');
            $userType = $statement->fetch();

            return $userType;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getAllUserType()
    {
        try {
            $statement = $this->connection->prepare("SELECT userTypeId, userType FROM userType");
            $statement->execute();

            $statement->setFetchMode(PDO::FETCH_CLASS, 'userType');
            $userTypes = $statement->fetchAll();

            return $userTypes;
        } catch (PDOException $e) {
            echo $e;
        }
    }
}