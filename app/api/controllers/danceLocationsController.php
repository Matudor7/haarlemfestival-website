<?php
require __DIR__ . '/../../Services/danceService.php';
require_once __DIR__ . '/../../Models/DanceLocation.php';

class DanceLocationsController{
    private $danceService;

    function __construct(){
        $this -> danceService = new DanceService();
    }

    function index(){
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($this -> danceService -> getAllDanceLocations());     
        }

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $eventJsonString = file_get_contents('php://input');

            $danceLocationData = json_decode($eventJsonString, true);

            $danceLocation = new DanceLocation();
            
            try{
            
            //Get image URL from POST request, then download that image into /media/dancePics
            $imageUrl = $_FILES['danceLocationImageInput']['tmp_name'];
            
            $imageName = strtolower(htmlspecialchars(preg_replace('/[^a-zA-Z0-9]/s', '', $danceLocationData['dance_location_name'])));;

            $downloadPath ='/media/dancePics/' . $imageName . '.png'; // /media/dancePics/locationName.png

            //Put the file from the image path to the download path
            move_uploaded_file($imageUrl, SITE_ROOT . $downloadPath);
            }catch(Exception $e){
                echo $e->getMessage();
            }

            //TODO: complete the POST by filling all location variables in
            $danceLocation->setDanceLocationName($danceLocationData['dance_location_name']);
            $danceLocation->setDanceLocationStreet($danceLocationData['dance_location_street']);
            $danceLocation->setDanceLocationNumber($danceLocationData['dance_location_number']);
            $danceLocation->setDanceLocationPostcode($danceLocationData['dance_location_postcode']);
            $danceLocation->setDanceLocationCity($danceLocationData['dance_location_city']);
            $danceLocation->setDanceLocationUrlToTheirSite($danceLocationData['dance_location_urlToTheirSite']);
            $danceLocation->setDanceLocationImageUrl($downloadPath);
            
            $this->danceService->insertDanceLocation($danceLocation);
        }
    }
}
?>