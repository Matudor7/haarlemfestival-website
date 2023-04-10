<?php
//Tudor Nosca (678549)
require_once __DIR__ . '/repository.php';
require __DIR__ . '/../Models/paymentModel.php';

class VatRepository extends Repository{
    public function getVat(){
        try{
            $statement = $this->connection->prepare("SELECT id, amount FROM vat");

            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_CLASS, 'Vat');

            $vat = $statement->fetch();

            return $vat;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}