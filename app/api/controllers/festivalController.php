<?php
session_start();
require __DIR__ . '/../../Services/festivalService.php';
require_once __DIR__ . '/../../Models/festivalModel.php';
require __DIR__ . '/../../Services/eventService.php';
require_once __DIR__ . '/../../Models/eventModel.php';

class FestivalController{
    private $festivalService;
    private $eventService;

    function __construct(){
        $this->festivalService = new FestivalService();
        $this->eventService = new EventService();
    }

    function index(){
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($this->festivalService->getFestival());
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