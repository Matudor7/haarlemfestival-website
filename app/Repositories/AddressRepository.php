<?php
require_once __DIR__ . '/../Models/Address.php';
require_once __DIR__ . '/repository.php';
class AddressRepository extends Repository
{
    public function getAll(){
        try{ //
            $statement = $this -> connection -> prepare("SELECT address_id, address_street, address_city, address_postcode FROM address");
            $statement->execute();

            $statement->setFetchMode(PDO::FETCH_CLASS, 'Address');
            $addresses = $statement->fetchAll();

            return $addresses;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }


    public function getById(int $id){
        try{
            $statement = $this->connection->prepare("SELECT address_id, address_street, address_city, address_postcode FROM address WHERE address_id = :address_id");
            $statement->bindParam(':address_id', $id);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_CLASS, 'Address');

            $address = $statement->fetch();

            return $address;
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
}