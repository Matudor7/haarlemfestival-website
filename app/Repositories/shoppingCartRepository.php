<?php
require_once __DIR__ . '/repository.php';
require __DIR__ . '/../Models/shoppingCartModel.php';

class ShoppingCartRepository extends Repository{

    public function getCartOfUser(int $user_id){
        try{
            $statement = $this->connection->prepare();
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}