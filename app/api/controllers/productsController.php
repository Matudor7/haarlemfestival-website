<?php
require __DIR__ . '/../../Services/productService.php';
require_once __DIR__ . '/../../Models/productModel.php';

class ProductsController{
    private $productService;

    function __construct(){
        $this->productService = new ProductService();
    }

    function index(){
        header('Content-Type: application/json; charset=utf-8');
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            if(isset($_GET['product_id'])){
            echo json_encode($this->productService->getById($_GET['product_id']));
            }else{
                echo json_encode($this->productService->getAll());
            }
        }
    }
}
?>