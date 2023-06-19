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
}
?>