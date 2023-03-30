<?php
require_once __DIR__ . '/repository.php';
require __DIR__ . '/../Models/User.php';

class UserRepository extends Repository
{

    function getAllUsers()
    {
        try {
            $statement = $this->connection->prepare("SELECT   user_id, username, userPicURL, user_firstName, user_lastName, 
         user_email, user_password, user_userType
FROM user");
            $statement->execute();

            $statement->setFetchMode(PDO::FETCH_CLASS, 'User');
            $users = $statement->fetchAll();

            return $users;
        } catch (PDOException $e) {
            echo $e;
        }

    }
    public function verifyLogin($username, $password)
    {
        try {

            $stmt = $this->connection->prepare("SELECT   user_id, username, userPicURL, user_firstName, user_lastName, 
         user_email, user_password, userTypeId
FROM user where username like :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
            $user = $stmt->fetch();

            if ($user == null) {
                return null;
            }
            $isPasswordCorrect = password_verify($password, $user->getUserPassword());
            if($isPasswordCorrect){
                return $user;
            } else {
                return null;

            }
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getUserByID($id)
    {
        try {

            $stmt = $this->connection->prepare("SELECT   user_id, username, userPicURL, user_firstName, user_lastName, 
         user_email, user_password, user_userType
FROM user WHERE id=$id ");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
            $result = $stmt->fetch();
            return $result;
        } catch (PDOException $e) {
            echo $e;
        }

    }

    public function getUserByEmail($email)
    {
        try {
            $stmt = $this->connection->prepare("SELECT   user_id, username, userPicURL, user_firstName, user_lastName, 
         user_email, user_password, userTypeId
FROM user WHERE user_email like :email");

            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
            $result = $stmt->fetch();
            return $result;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function updatePassword($id, $password)
    {
        try {
            $stmt = $this->connection->prepare("Update user SET user_password =:password WHERE user_id = :id");

            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $result = $stmt->fetch();

        }catch(Exception $e)
        { echo $e;
        }
    }

    public function createUser($user)
    {
        try {
            $stmt = $this->connection->prepare("
            INSERT INTO user (username, userPicURL, user_firstName, user_lastName, user_email, user_password, userTypeId, user_registrationDate)
            SELECT :username, :userPic, :firstname, :lastname, :email, :password, :userType, :registerDate
            WHERE NOT EXISTS (SELECT username FROM user WHERE username = :username or user_email = :email)
        ");

            $userPassword = htmlspecialchars($user->getUserPassword());
            $username = htmlspecialchars($user->getUsername());
            $userFirstName = htmlspecialchars($user->getUserFirstname());
            $userLastname = htmlspecialchars($user->getUserLastname());
            $userEmail = htmlspecialchars($user->getUserEmail());
            $userType = htmlspecialchars($user->getUserTypeId());
            $registerDate = new DateTime();
            $registerDateFormat = $registerDate->format('Y-m-d');

            $stmt->bindParam(':password', $userPassword);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':firstname', $userFirstName);
            $stmt->bindParam(':lastname', $userLastname);
            $stmt->bindParam(':email', $userEmail);
            $stmt->bindParam(':userType', $userType);
            $userDefaultPic = "/media/defaultPic.jpg";
            $stmt->bindParam(':userPic', $userDefaultPic);
            $stmt->bindParam(':registerDate', $registerDateFormat);

            return  $stmt->execute();
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function getUserType(){
        try{
            $stmt = $this->connection->prepare("SELECT userTypeId, userType from userType");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'userType');
            $result = $stmt->fetchAll();
            return $result;

        }catch(Exception $e){
            echo $e;
        }
    }
}