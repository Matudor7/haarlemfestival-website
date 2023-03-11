<?php
require __DIR__ . '/../../Services/eventService.php';
require_once __DIR__ . '/../../Models/eventModel.php';

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

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $eventJsonString = file_get_contents('php://input');

            $eventData = json_decode($eventJsonString, true);

            $event = new Event();

            //TODO: complete the POST by filling all event variables in
            $event->setName($eventData["event_name"]);
        }
    }
}
?>