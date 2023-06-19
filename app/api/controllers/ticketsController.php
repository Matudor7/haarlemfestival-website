<?php
require __DIR__ . '/../../Services/TicketService.php';
require_once __DIR__ . '/../../Models/Ticket.php';
class TicketsController{
    private $ticketService;

    function __construct(){
        $this->ticketService = new TicketService();
    }

    function scan(){
        if($_SERVER["REQUEST_METHOD"] == "GET"){

            if(isset($_GET['id'])){
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($this->ticketService->getByID($_GET['id']));
            }
        }
    }

    function updateAvailability(){
        //this is only for testing, I'll delete later on
        require_once __DIR__ . '/../../Services/productService.php';
        $productSer = new ProductService();

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $data = json_decode(file_get_contents("php://input"), true);

            if(isset($data['userId'])){

                $userId  = $data['userId'];
                $shoppingCart = $this->shoppingCartService->getCartOfUser($userId);
                $products = $shoppingCart->getProducts();
                $amounts = $shoppingCart->getAmount();

                for ($i = 0; $i < count($products); $i++){
                    $productSer->updateProductAvailability($products[$i], $amounts[$i]);
                }


                header('Content-Type: application/json;');
                echo json_encode($products[0].' '.$amounts[0]);
            }  else {echo json_encode("does not work yet");}
        }
    }
}
?>