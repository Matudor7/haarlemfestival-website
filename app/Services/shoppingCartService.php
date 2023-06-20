<?php
//Tudor Nosca (678549)
require __DIR__ . '/../Repositories/shoppingCartRepository.php';

class ShoppingCartService{
    private $shoppingCartRepo;

    function __construct(){
        $this->shoppingCartRepo = new ShoppingCartRepository();
    }

    function getAll(){
        $carts = $this->shoppingCartRepo->getAll();
        return $carts;
    }

    public function getCartOfUser(int $user_id){
        $shoppingCart = $this->shoppingCartRepo->getCartOfUser($user_id);
        return $shoppingCart;
    }

    public function addAmount(int $user_id, int $product_id){
        $this->shoppingCartRepo->addAmount($user_id, $product_id);
    }

    public function removeAmount(int $user_id, int $product_id){
        $this->shoppingCartRepo->removeAmount($user_id, $product_id);
    }

    public function removeCartFromUser(int $user_id){
        $this->shoppingCartRepo->removeCartFromUser($user_id);
    }

    public function addProducts(int $userId, int $productId, int $amount, int $eventType, string $note){
        $this->shoppingCartRepo->addProducts($userId, $productId, $amount, $eventType, $note);
    }

    public function updateProductAmount(int $id, int $amount){
        $this->shoppingCartRepo->updateProductAmount($id, $amount);
    }

    public function existingCart(int $userId, int $productId){
        return $this->shoppingCartRepo->existingCart($userId, $productId);
    }
    public function getAdditionalInfoByProduct($productId, $userId){
        return $this->shoppingCartRepo->getAdditionalInfoByProduct($productId,$userId );
    }
    public function getAmountOfProduct($item, $user_id)
    {
        return $this->shoppingCartRepo->getAmountOfProduct($item, $user_id);
    }
}
?>