<?php
require __DIR__ . '/../Repositories/shoppingCartRepository.php';

class ShoppingCartService{
    public function getCartOfUser(int $user_id){
        $shoppingCartRepo = new ShoppingCartRepository();
        $shoppingCart = $shoppingCartRepo->getCartOfUser($user_id);

        return $shoppingCart;
    }
}
?>