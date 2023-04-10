<?php
//Tudor Nosca (678549)
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
                $shoppingCart->addAmount($row['amount']);
            }
            return $shoppingCart;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function addAmount(int $user_id, int $product_id){
        $statement = $this->connection->prepare("UPDATE shopping_cart SET amount = amount + 1 WHERE user_id = :user_id AND product_id = :product_id");

        $statement->bindParam(':user_id', $user_id);
        $statement->bindParam(':product_id', $product_id);

        $statement->execute();
    }

    public function removeAmount(int $user_id, int $product_id){
        $statement = $this->connection->prepare("SET @amount = (SELECT amount FROM shopping_cart WHERE user_id = :user_id AND product_id = :product_id);
                                                 IF @amount > 1 THEN
                                                 UPDATE shopping_cart SET amount = amount - 1 WHERE user_id = :user_id AND product_id = :product_id;
                                                 ELSE
                                                 DELETE FROM shopping_cart WHERE user_id = :user_id AND product_id = :product_id;
                                                 END IF;");
                                                 
        $statement->bindParam(':user_id', $user_id);
        $statement->bindParam(':product_id', $product_id);

        $statement->execute();
    }

    public function removeCartFromUser($user_id){
        try{
            $statement = $this->connection->prepare("DELETE FROM shopping_cart WHERE user_id=:userId");

            $statement->bindParam(':userId', $user_id);
    
            $statement->execute();
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}