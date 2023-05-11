<?php
require __DIR__ . '/../../Services/productService.php';
require __DIR__ . '/../../Services/shoppingCartService.php';
require_once __DIR__ . '/../../Models/productModel.php';

class buyticketformController{

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

    public function addToCart(){

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $data = json_decode(file_get_contents("php://input"), true);

            if(isset($data['productId'])&isset($data['userId'])){
                $productId = $data['productId'];
                $userId = $data['userId'];
                $amount = $data['amount'];
                $eventType = $data['eventType'];
                $note = $data['note'];
                $product = $this->productService->getById($productId);

                if ($this->checkAvailability($amount, $productId)) {
                    if($this->checkExistingCart($userId, $productId)) {
                        $shoppingCartId = $this->shoppingCartService->existingCart($userId, $productId)[0];
                        $this->shoppingCartService->updateProductAmount($shoppingCartId, $amount);}
                    else{
                        $this->shoppingCartService->addProducts($userId, $productId, $amount, $eventType, $note);}

                    $result = "Great! we have added ".$amount." ticket(s) for ".$product->getName()." to the shopping cart";
                } else{
                    $availability = $product->getAvailableSeats();
                    $result = "Oh No! we only have ".$availability." tickets for ".$product->getName()." available";
                }
                header('Content-Type: application/json;');
                echo json_encode($result);

            }  else {echo json_encode("No ticket Selected!");}
        }
    }

    private function checkAvailability(int $amount, int $productId){
        $product = $this->productService->getById($productId);
        if ($amount <= $product->getAvailableSeats()){
            return true;
        }
        return false;
    }

    private function checkExistingCart(int $userId, int $productId){

        $shoppingCartId = $this->shoppingCartService->existingCart($userId, $productId);
        if ($shoppingCartId != NULL ){
            return true;
        }

        return false;
    }
}