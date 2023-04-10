<?php
//Tudor Nosca (678549)
require __DIR__ . '/../Repositories/shoppingCartRepository.php';

class ShoppingCartService{
    private $shoppingCartRepo;

    function __construct(){
        $this->shoppingCartRepo = new ShoppingCartRepository();
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

    public function addProducts(int $userId, int $productId, int $amount){
        $this->shoppingCartRepo->addProducts($userId, $productId, $amount);
    }
}
?>