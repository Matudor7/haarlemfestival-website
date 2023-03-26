<?php
require_once __DIR__ . '/repository.php';
require __DIR__ . '/../Models/shoppingCartModel.php';

class ShoppingCartRepository extends Repository{

    public function getCartOfUser(int $user_id){
        try{
            $statement = $this->connection->prepare("SELECT user_id, product_id, amount FROM shopping_cart WHERE user_id = :user_id");

            $statement->bindParam(':user_id', $user_id);
            $statement->execute();

            $shoppingCart = new ShoppingCart();
            while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                $shoppingCart->setUserId($row['user_id']);
                $shoppingCart->addProduct($row['product_id']);
                $shoppingCart->setAmount($row['amount']);
            }
            return $shoppingCart;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}