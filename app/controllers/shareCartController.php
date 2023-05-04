<?php
//Tudor Nosca (678549)
session_start();
require __DIR__ . '/controller.php';
require_once __DIR__ . '/../Services/productService.php';
require_once __DIR__ . '/../Services/shoppingCartService.php';
require_once __DIR__ . '/../Services/UserService.php';
require_once __DIR__ . '/../Models/vatModel.php';
require_once __DIR__ . '/../Services/vatService.php';
class ShareCartController extends Controller{
    public function index(){
        $userService = new UserService();
        $shoppingCartService = new ShoppingCartService();
        $shoppingCarts = $shoppingCartService->getAll();
        $users = $userService->getAllUsers();
        $sharedCart = null;
        $sharedCartUser = null;

        foreach($users as $user){
            if(password_verify($user->getUserId(), $_GET['user_id'])){
                $sharedCartUser = $userService->getByID($user->getUserId());
                break;
            }
        }

        foreach($shoppingCarts as $shoppingCart){
            if(password_verify($shoppingCart->getUserId(), $_GET['user_id'])){
                $sharedCart = $shoppingCartService->getCartOfUser($shoppingCart->getUserId());
                break;
            }
        }
        $this->displayCart($sharedCart, $sharedCartUser);
    }

    private function displayCart($cart, $sharedCartUser){

        $productService = new ProductService();
        $vatService = new VatService();
        $vat = $vatService->getVat();

        $products = [];
        foreach($cart->getProducts() as $product_id){
            array_push($products, $productService->getById($product_id));
        }

        $merged_products = array_merge($products);
        
        $information = [];
        foreach($cart->getInfo() as $info){
            array_push($information, $info);
        }

        $amounts = [];
        foreach($cart->getAmount() as $amount){
            array_push($amounts, $amount);
        }

        $totalPrice = 0;

        for($i = 0; $i < count($merged_products); $i++){
            $totalPrice += ($merged_products[$i]->getPrice() * $amounts[$i]); 
        }

        $additionalVat = $totalPrice * ($vat->getAmount() / 100);

        $totalPrice += $additionalVat;
        
        require __DIR__ . '/../views/sharedCart.php';
    }
}