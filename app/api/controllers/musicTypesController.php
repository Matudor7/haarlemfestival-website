<?php
require __DIR__ . '/../../Services/danceService.php';
require_once __DIR__ . '/../../Models/MusicType.php';

class MusicTypesController{
    private $danceService;

    function __construct(){
        $this -> danceService = new DanceService();
    }

    function index(){
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($this -> danceService -> getAllMusicTypes());     
        }
    
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $musicTypeJsonString = file_get_contents('php://input');
    
            $musicTypeData = json_decode($musicTypeJsonString, true);
    
            $musicType = new MusicType();    
                
            // Set the music type name using the correct key
            $musicType->setMusicTypeName($musicTypeData['dance_musicType_name']);
    
            $this->danceService->insertMusicType($musicType);
        }
    }
    
}
?>