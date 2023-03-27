<?php
require __DIR__ . '/../../Services/productService.php';
require_once __DIR__ . '/../../Models/productModel.php';

class ProductsController{
    private $productService;

    function __construct(){
        $this->productService = new ProductService();
    }

    function index(){
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($this->productService->getAll());
        }
    }
}
?>