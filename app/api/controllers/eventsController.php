<?php
require __DIR__ . '/../../Models/eventModel.php';
require __DIR__ . '/../../Services/eventService.php';

class EventsController{
    private $eventService;

    function __construct(){
        $this -> eventService = new EventService();
    }

    function index(){
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($this -> eventService -> getAll());
        }
    }
}
?>