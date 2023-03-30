<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../services/productService.php';
require __DIR__ . '/../services/shoppingCartService.php';

class CheckoutController extends Controller{
    function index(){
        require __DIR__ . '/../views/checkout/index.php';
    }
}
?>