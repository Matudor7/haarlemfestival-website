<?php
require __DIR__ . '/../../Services/productService.php';
require __DIR__ . '/../../Services/shoppingCartService.php';
require_once __DIR__ . '/../../Models/productModel.php';
class reservationformController
{
    private $productService;
    private $shoppingCartService;
    function __construct(){
        $this->productService = new ProductService();
        $this->shoppingCartService = new ShoppingCartService();
    }


}