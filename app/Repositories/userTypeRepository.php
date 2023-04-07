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

    public function getUserTypeNameByUserId($userId){ // the getTypeById method doesnt work, but this one works, i didnt want to touch Ale's code but we must discuss which one to use.
        $sql = "SELECT ut.userType FROM userType ut JOIN user u ON ut.userTypeId = u.userTypeId WHERE u.user_id = :userId";
        try{
            $statement = $this->connection->prepare($sql);
            $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result['userType'];
        } catch (PDOException $e) {
            echo $e;
        }
    } 
}