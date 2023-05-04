<?php
session_start();
require __DIR__ . '/../../Services/OrderService.php';
require_once __DIR__ . '/../../Models/Order.php';

class OrdersController{
    private $orderService;
    private $eventService;

    function __construct(){
        $this->orderService = new OrderService();
    }

    function index(){
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($this->orderService->getAll());
        }

        if($_SERVER["REQUEST_METHOD"] == "PATCH"){
            if(isset($_GET['id'])){

                $festivalJsonString = file_get_contents('php://input');

                $festivalData = json_decode($festivalJsonString, true);
    
                $festival = $this->festivalService->getById($_GET['id']);
                $newEvent = $this->eventService->getByName($festivalData['event_name']);

                $this->festivalService->changeEvent($festival->getId(), $newEvent->getName(), $newEvent->getId(), $newEvent->getStartTime(), $newEvent->getEndTime());
            }
        }
    }
}
?>