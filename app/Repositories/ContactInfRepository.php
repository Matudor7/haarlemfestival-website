<?php
require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../Models/ContactInf.php';

class ContactInfRepository extends Repository{


    public function getAll()
    {
        try {
            $statement = $this->connection->prepare("SELECT contactInf_id, telephoneNumber	, email FROM contactInf");
            $statement->execute();

            $statement->setFetchMode(PDO::FETCH_CLASS, 'ContactInf');
            $contacts = $statement->fetchAll();

            return $contacts;
        } catch (PDOException $e) {
            echo $e;
        }
    }


    public function getById($contactInf_id)
    {
        try {
            $statement = $this->connection->prepare("SELECT contactInf_id, telephoneNumber, email FROM contactInf WHERE contactInf_id = :contactInf_id");
            //TODO make sure that the name comes from a dropdown option no input from the user
            $statement->bindParam(':contactInf_id', $contactInf_id);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_CLASS, 'ContactInf');

            $contact = $statement->fetch();

            return $contact;
        } catch (PDOEXCEPTION $e) {
            echo $e;
        }

    }


}
