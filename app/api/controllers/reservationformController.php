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

    public function selectTicket(){

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $data = json_decode(file_get_contents("php://input"), true);

            if(isset($data['productId'])){
                $productId = $data['productId'];

                $result = $this->productService->getById($productId);

                header('Content-Type: application/json;');
                echo json_encode($result);
            }  else {echo json_encode("does not work yet");}
        }
    }
}